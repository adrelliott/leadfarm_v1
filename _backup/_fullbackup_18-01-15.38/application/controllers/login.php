<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* This is the Login controller for all users.
 * 
 * USER = any page that a logged in client will see, e.g. the CRM part
 * 
 * Put any methods or vars in this file that you want available fort he login module
 * 
 * 
 * 
 */

  
class Login extends MY_Controller {
    public function __construct()    {
         parent::__construct();
         
    }

    public function index($message = NULL)
    {      
        if ($message == NULL)
        {
            $message = '<span class="notification information">Please log in below</span>';
        }
        $this->data['page_setup']['message'] = $message;  
        $this->load->view('default/login/login');
    }

   
    public function validate()
    {
        $this->load->model('login_model');    
        $query = $this->login_model->validate_user(); 
        if ($query['result']) //Tests to see if anything was returned (TRUE if result is found)
        {
            $row = $query['data']->row(); //allows access to the results          
            if ($row->_suspendedReason == '' || $row->_suspendedReason == NULL )
            {
                $sessionData = array
                  (
                      'Username' => $this->input->post('username'),
                      'is_logged_in' => TRUE,
                      'FirstName' => $row->FirstName,
                      'LastName' => $row->LastName,
                      'Company' => $row->Company,
                      'UserId' => $row->UserId,
                      '_dID' => $row->_dID
                      //add more info using the format $row->NAME, where NAME = database col name
                  );
                $this->session->set_userdata($sessionData);
                redirect($sessionData['_dID'] . '/dashboard');
            }
            else
            {
                $message = '<span class="notification undone"><h4>I\'m sorry. There\'s a problem with your account.</h4><br/> Please call 0161 375 4444 and quote code ' . $row->_suspendedReason . '</span>';
                $this->force_log_out($message );
            }          
        }
         else
        {
            $message = '<span class="notification undone"><h4>I\'m sorry - username/password not recognised.</h4></span>';
            $this->index($message);
        }
    }

    function log_out()
    {
        $this->session->sess_destroy();
        $message = '<span class="notification warning">You\'ve been logged out.</span>';
        $this->index($message);
    }

    function force_log_out($message = NULL)
    {
        $this->session->sess_destroy();
        session_destroy();
         if ($message == NULL)
        {
            $message = '<span class="notification information">You\'ve been logged out. (Maximum login time is 2 hours)</span>';
        }
        $this->index($message);
    }
}