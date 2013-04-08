<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Settings') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
  
    class Settings extends CRM_Controller {

        public $controller_name = 'settings';

        public function __construct()    {
            parent::__construct();
        }
        
        public function index($view_file = 'index') {
            parent::index($view_file);
            $this->_load_view_data();   //retrieves and process all data for view  
            //print_array($this->data, 1);
            $this->_generate_view($this->data);
        } 

        public function view($view_file = 'edit', $rID = 'new') {          
            parent::view($view_file, $rID, $rID);   

            $this->_load_view_data($rID);    //retrieves and process all data for view        
                // Generate the view!
            $this->_generate_view($this->data);
        }
        
        public function add($view_file, $rID, $ContactId) {       
            //clean input
            $input = clean_data($this->input->post());

            //save record
            $rID = $this->add_record($input, $rID);

            //refresh page
            redirect( $this->controller_name . '/view/edit/' . $rID . '/' . $ContactId );
        }

        public function change_password($rID, $ContactId) {       
            //clean input
            $input = clean_data($this->input->post());
            //print_array($input, 1);

            //Do some checks
            if ($input['PasswordCheck'] != $input['Password'])
            {
                //$this->session->set_flashdata('message', 'Ooops. Passwords do not match');
                //print_array($this->data);

            }

            else{

            //Does the original password match the new password?

            //if its all good, then change the password

            //save record
            $rID = $this->add_record($input, $rID);

            //refresh page
            redirect( $this->controller_name . '/view/edit/' . $rID . '/' . $ContactId );
            }

        }

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

            //refresh page
            redirect( $this->controller_name . '/view/edit/' . $rID . '/' . $ContactId . '/' . $fieldset );

        }

        public function append_note_ajax() {
            //Concatenate the new note ready for updating
            //echo "<h1>hello</h1>";die;

            $input = clean_data($this->input->post()); 
            $input['ContactNotes'] .= "\n:::: On " . date('d-m-Y H:i') . ', ' . 
                    $this->session->userdata('FirstName') . ' ' . 
                    $this->session->userdata('LastName') . " wrote:::: \n" . 
                    $input['add_a_note'];  //add the new note details
            unset($input['add_a_note']); //tidy up        

            //save record
            $this->add_record($input, $rID);

            $this->view($view_file, $rID, $ContactId);
            //print_array($input);


        }



    }
}
   