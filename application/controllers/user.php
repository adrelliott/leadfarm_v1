<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('User') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
  
    class User extends CRM_Controller {
        
        public $controller_name = 'user';
        

        public function __construct()    {
            parent::__construct();
            $this->data['view_setup']['correct_password'] = NULL;
            $this->data['view_setup']['message'] = '';
            $this->output->enable_profiler(TRUE);
        }

        public function index($view_file = 'index') { 
            parent::index($view_file);
        
            $this->_load_view_data();   //retrieves and process all data for view     
        }

        public function  view($view_file = 'edit', $rID = 'new', $ContactId = FALSE, $pull = '') {   
            $this->data['view_setup']['modal'] = TRUE;
            parent::view($view_file, $rID, $ContactId);

            $this->_load_view_data($rID);    //retrieves and process all data for view    
                // Generate the view!
            $this->load_view($pull);
        }
        
        public function password_challenge($view_file = 'edit', $rID = 'new') {
            //check password
            $this->load->model('login_model'); 
            $this->data['view_setup']['correct_password'] = $this->login_model->verify_password();
            $this->view($view_file, $rID);
         
        }
        
        public function edit_login($view_file, $rID, $ContactId) {
            $this->load->library('form_validation');
            if ($rID == 'new') 
                $this->form_validation->set_rules('Username', 'Username', 'trim|required|min_length[6]|max_length[12]|is_unique[contact.Username]|xss_clean');
            $this->form_validation->set_rules('Password', 'New Password', 'trim|required|matches[___Passconf]|xss_clean|md5');
            $this->form_validation->set_rules('___Passconf', 'Password Confirmation', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE)
            {
                $this->data['view_setup']['correct_password'] = 1;
                $this->data['view_setup']['message'] = '<span class="notification warning"><h4>Ooops.</h4>' . validation_errors() . '</p></span>';
                $this->view($view_file, $rID, $ContactId);
                return;
            }
            $this->data['view_setup']['message'] = '<span class="notification done"><h4>Woo Hoo!</h4>Password Updated successfully.</p></span>';
            $this->add($view_file, $rID, $ContactId);
        }

        public function add($view_file, $rID, $ContactId) {
            //clean input
            $input = clean_data($this->input->post());
            
            //save record
            $rID = $this->add_record($input, $rID);
            
            //return to page
            if ( empty ($this->data['view_setup']['message']) )
                $this->data['view_setup']['message'] = '<span class="notification done">Record Updated!</span>';
            $this->data['view_setup']['correct_password'] = 1;
            $this->view($view_file, $rID, $ContactId);
        }
        
        public function delete_record($id) {
              parent::delete_record($id, 'Id');
              $url = 'settings';
              redirect ( $url );
          }
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        /*
        public function view_old($view_file = 'edit', $rID) {  
            parent::view($view_file, $rID);   

            //Do we show all users? Depends on admin level        
            if( $this->session->userdata('_AdminLevel') >= ADMIN_LEVEL_SUPERVISOR )
                $this->data['view_setup']['show_user_table'] = TRUE;
        
            $this->_load_view_data($rID);    //retrieves and process all data for view      

                // Generate the view!
            $this->_generate_view($this->data);
        }

      public function view_modal($view_file = 'edit', $rID) {  
            $this->data['view_setup']['modal'] = TRUE;
            parent::view($view_file);
            $this->data['view_setup']['rID'] = $rID;
            $this->data['view_setup']['ContactId'] = $rID;   //in this context, $rID == ContactId
            $this->data['view_setup']['display_none'] = '';

            //print_array($this->data, 1);
            $this->_load_view_data($rID); 

            // Generate the view!
            $this->_generate_view($this->data);
        }
        
        public function add_old($view_file, $rID) {  
            //clean input
            $input = clean_data($this->input->post());

            //save record
            $rID = $this->add_record($input, $rID);

            //refresh page
            redirect( $this->controller_name . '/view/' . $view_file . '/' . $rID );

        }

        public function add_new_user($view_file, $rID) {       
             //validate the form
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Title', 'Title', '');
            $this->form_validation->set_rules('FirstName', 'First name', '');
            $this->form_validation->set_rules('LastName', 'Last name', '');
            $this->form_validation->set_rules('Email', 'User\'s Email', 'trim|required|xss_clean');
            $this->form_validation->set_rules('Username', 'Choose a Username', 'trim|required|min_length[4]|max_length[12]|is_unique[contact.Username]|xss_clean');
            $this->form_validation->set_rules('Password', 'New Password', 'trim|required|matches[___passconf]|xss_clean|md5');
            $this->form_validation->set_rules('___passconf', 'Password Confirmation', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE)
            {
                $this->view_modal($view_file, $rID);
                return;
            }
            else
            {                  
                //clean input
                $input = clean_data($this->input->post());

                //save record
                $rID = $this->add_record($input, $rID);

                //refresh page
                $this->data['view_setup']['success'] = TRUE;
                $this->view_modal($view_file, $rID);
            }

        }


        public function change_password($view_file, $rID) {  
            //Set up vars
            $message = '';

            //clean input & get existing values
            $input = clean_data($this->input->post());
            $result = $this->get_record($rID);

            //check that passwords match
            if (md5($input['Password']) != $result['Password'])
            {
                $message = "Oops. The password you gave us doesn't match our records.";
                $input = FALSE;
            }
            elseif ($input['New_Password'] != $input['New_Password_2']) 
            {
                $message = "Oops. Passwords Don't match";
                $input = FALSE;
            }
            elseif ($input['New_Password'] == '' || strlen($input['New_Password']) < 6) 
            {
                $message = "Oops. Password was blank or less than 6 characters";
                $input = FALSE;
            }
            else
            {
                $input['Password'] = md5 ($input['New_Password']);
                unset($input['New_Password']);
                unset($input['New_Password_2']);
            }

            if ($input) $result = $this->add_record($input, $rID);
            if ($result == $rID ) $message = "Woo hoo! Password changed successfully";

            $this->data['view_setup']['message'] = '<span class="notification undone">' . $message . '</span>';

            //refresh page
            redirect( $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $rID );


        }
         * 
         * */



    }
}
   