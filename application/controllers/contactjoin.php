<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contactjoin') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then  

    class Contactjoin extends CRM_Controller {
        
        public $controller_name = 'contactjoin';
        
        public function __construct()    {
            parent::__construct();
        }

      public function index() {     
           //parent::index();

            // Generate the view!        
           //$this->_generate_view($this->data);
       }

      public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE, $pull = '') {    
            $this->data['view_setup']['modal'] = TRUE;
            parent::view($view_file, $rID, $ContactId);   

            $this->_load_view_data($rID); 

            // Generate the view!        
           $this->load_view($pull);

      }
      
       public function add($view_file, $rID, $ContactId) {       
            //clean input
            $input = clean_data($this->input->post());
            $input['__ContactId'] = $ContactId;
            
            //save record
            $rID = $this->add_record($input, $rID);
            
            $url = $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId;
            
            if ($this->input->is_ajax_request ()) {
                $response = array (
                    'success' => true,
                );

                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($response));
                return;
            }

            //refresh page
            redirect($url);

        }
        
        public function delete_record($ContactId, $id) {
              parent::delete_record($id, '__Id');
              $url = 'contact/view/edit/' . $ContactId . '/' . $ContactId . '/0';
              redirect ( $url );
          }


          public function ajax_feed  () {
            //load the model & run the method
            $this->load->model('contact_model');
            $output = $this->contact_model->get_data_via_ajax_non_codeigniter();
            //$output = $this->contact_model->get_data_via_ajax_codeigniter();
            
            //output the results as JSON
            echo json_encode( $output );
        }
    }
}
   