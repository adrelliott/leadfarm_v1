<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Vehicles') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
  
    class Vehicles extends CRM_Controller {
        
        public $controller_name = 'vehicles';
        
        public function __construct()    {
            parent::__construct();
        }

        public function index($view_file = 'index') {     
            parent::index($view_file);
            
            $this->_load_view_data();    //retrieves and process all data for view
            
            $this->_generate_view($this->data);
        }

        public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE, $pull = '') {
            parent::view($view_file, $rID, $ContactId); 

            $this->_load_view_data($rID);     //retrieves and process all data for view    

                //check for expirations of MOT & service
            $this->load->library('garages/garage');
            $this->data['view_setup']['notifications'] = array();
            if (isset($this->data['view_setup']['tables']['vehicles']['table_data'][0]))
            {
                $this->data['view_setup']['notifications'] = 
                        $this->garage->check_vehicle_expiry 
                        (
                        $this->data['view_setup']['tables']['vehicles'],
                        $this->data['view_setup']['ContactId']
                        );
            }

            $this->load_view($pull);


        }

        public function view_modal($view_file = 'view', $rID = 'new', $ContactId = NULL, $pull = '') {    
            $this->data['view_setup']['modal'] = TRUE;
           parent::view($view_file, $rID, $ContactId); 
           
            //print_array($this->data, 1);
            $this->_load_view_data($rID);    //retrieves and process all data for view    
       
                // Generate the view!
            $this->load_view($pull);
        }
        
         public function add($view_file, $rID, $ContactId) {       
            //clean input
            $input = clean_data($this->input->post());
            $input['__ContactId'] = $ContactId;

            //save record
            $rID = $this->add_record($input, $rID);
            $url = site_url ( $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId );

            if ($this->input->is_ajax_request ()) {
                $response = array (
                    'success' => true,
                    'updateDatatable' => 'dataTable-container-vehicles'
                );

                if ($rID === 'new') {
                    $response['redirect'] = $url;
                }

                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($response));
                return;
            }

            if(strpos($view_file, '_modal') === FALSE)
            {
                redirect($url);
            }
            else
            {
                $this->view_modal($view_file, $rID, $ContactId);
            }

        }
    
        public function append_note($view_file, $rID, $ContactId) {
           //Concatenate the new note ready for updating
           $input = clean_data($this->input->post()); 
           $input['__VehicleNotes'] .= "\n:::: On " . date('d-m-Y H:i') . ', ' . 
                   $this->session->userdata('FirstName') . ' ' . 
                   $this->session->userdata('LastName') . " wrote:::: \n" . 
                   $input['add_a_note'];  //add the new note details
           unset($input['add_a_note']); //tidy up        

           //save record
           $this->add_record($input, $rID);

           if ($this->input->is_ajax_request()) {
               $response = array(
                   'success' => true,
                   'data' => array ('__VehicleNotes' => $input['__VehicleNotes'])
               );
               $this->output->set_content_type('application/json');
               $this->output->set_output(json_encode($response));
               return;
           }

           //refresh page
           redirect( $this->controller_name . '/view/edit/' . $rID . '/' . $ContactId );

       }
        



    }
}
   