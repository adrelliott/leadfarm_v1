<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contact') ) get_bespoke_controller();  //yup = go get it.
else
{   //nope? Use this default class then
    
    class Contact extends MY_Controller {
        
        public $controller_name = 'contact';

        public function __construct()    {
             parent::__construct();
        }

        public function index() {   
            parent::index();
            $this->_load_view_data();
            $this->_generate_view($this->data);
        }
        
        public function view($view_file, $rID, $ContactId, $fieldset, $pull = '') {
            parent::view($view_file, $rID, $ContactId);   

            //What record fieldset do we show? Org, ind or unknown?
            $this->data['view_setup']['fieldset'] = $fieldset;
        
            $this->_load_view_data($rID);
            
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
        
        public function add($view_file, $rID, $ContactId, $fieldset) {
            //clean input
            $input = clean_data($this->input->post());

            //save record
            $rID = $this->add_record($input, $rID);
            
            $url = site_url ($this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $rID . '/' . $input['_IsOrganisationYN']);

            if ($this->input->is_ajax_request ()) {
                $response = array (
                    'success' => true,
                );

                if ($ContactId === 'new') {
                    $response['redirect'] = $url;
                }

                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($response));
                return;
            }

            //refresh page
            redirect($url);

        }
        
        //Post process data for the view? put it here:
        /*public function post_process_contact() {
            
        }*/
        
        public function append_note($view_file, $rID, $ContactId, $fieldset) {
            //Concatenate the new note ready for updating
            $input = clean_data($this->input->post()); 
            $input['ContactNotes'] .= "\n:::: On " . date('d-m-Y H:i') . ', ' . 
                    $this->session->userdata('FirstName') . ' ' . 
                    $this->session->userdata('LastName') . " wrote:::: \n" . 
                    $input['add_a_note'];  //add the new note details
            unset($input['add_a_note']); //tidy up        

            //save record
            $this->add_record($input, $rID);

            if ($this->input->is_ajax_request()) {
                $response = array(
                    'success' => true,
                    'data' => array ('ContactNotes' => $input['ContactNotes'])
                );
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($response));
                return;
            }

            //refresh page
            redirect( $this->controller_name . '/view/edit/' . $rID . '/' . $ContactId . '/' . $fieldset );

        }
        
        public function delete_record($id = FALSE) {
            //$this->load->model($method_name . '_model', 'contact');
            parent::delete_record($id);
            
            $this->index();            
        }
    }
}   