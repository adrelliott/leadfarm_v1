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
            $this->output->enable_profiler(TRUE);
        }

        public function index($view_file = 'index') { 
            parent::index($view_file);
        
            $this->_load_view_data();   //retrieves and process all data for view     
        }

        public function  view($view_file = 'edit', $rID = 'new', $ContactId = FALSE, $pull = '') {   
            echo "got here";die;
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

        public function add($view_file, $rID, $ContactId) {
            
            
            //clean input
            $input = clean_data($this->input->post());
            
            //save record
            $rID = $this->add_record($input, $rID);
            $this->data['view_setup']['correct_password'] = 1;
            
            $this->view($view_file, $rID, $ContactId);
            

        }
        
        public function change_password($view_file, $rID, $ContactId) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('Password', 'New Password', 'trim|required|matches[___passconf]|xss_clean|md5');
        }
        
        
        public function add_1($view_file, $rID, $ContactId) {
            //clean input
            $input = clean_data($this->input->post());
            
            //save record
            $rID = $this->add_record($input, $rID);
            
             //Have we set nay client-specific methods to run?
            //$method_name = 'add_' . DATAOWNER_ID;
            //if (method_exists($this, $method_name)) $this->$method_name($input, $rID);
            
            $url = site_url ($this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $rID . '/0');

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
        
        function change_login_details($username, $password, $password_confirm, $new_user = TRUE) {
            //if its a new user, then check given password's match
            //else look up the user's record and check that the password matches with the one on record
            //now do the validation:
            $this->form_validation->set_rules('Username', 'Choose a Username', 'trim|required|min_length[6]|max_length[12]|is_unique[contact.Username]|xss_clean');
            $this->form_validation->set_rules('Password', 'New Password', 'trim|required|matches[___passconf]|xss_clean|md5');
            $this->form_validation->set_rules('___passconf', 'Password Confirmation', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE)
            {
                $this->view_modal($view_file, $rID);
                return;
            }
//            
//check passwords match
            
            //now 
        }
        
        
        
        
        
        
        
        
        
        
        
        
        
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




    }
}
   