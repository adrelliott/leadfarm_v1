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

  
class Login extends CI_Controller {
    
    public $controller_name = 'login';
    
    public function __construct()    {
         parent::__construct();
         
         
    }

    public function index($message = NULL) {      
        if ($this->session->userdata('is_logged_in'))       //show friendly 404 page
        {
            $this->load->view('default/login/friendly_404');            
        }
        else
        {
            if ($message == NULL)
            {
                $message = '<span class="notification information">Please log in below</span>';
            }
            $this->data['page_setup']['message'] = $message;  
            $this->load->view('default/login/login', $this->data);
        }
    }

   
    public function validate($dID)
    {
        //first, test and see if there is config file for this dID exists
        if(! file_exists(APPPATH . '/config/bespoke_configs/' . $dID . '_config.php'))
        {
            show_error ('Have you got the right URL?');
        }
        
        //Load the settings to do the query
        define('DATAOWNER_ID', $dID);        
        $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_database');
        $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');
        $this->load->model('login_model');    
        
        //do the query
        $query = $this->login_model->validate_user(); 
        //print_array($query, 1);
        if ($query['result']) //Tests returned array(TRUE if result is found)
        {
            extract($query['data']);
            if ( $_SuspendedReason == '' || $_SuspendedReason == NULL )
            {
                //No suspension! Yeah!
                $sessionData = array
                  (
                      'Username' => $Username,
                      'is_logged_in' => TRUE,
                      'FirstName' => $FirstName,
                      'LastName' => $LastName,
                      'Nickname' => $Nickname,
                      'Email' => $Email,
                      'Phone1' => $Phone1,
                      'Company' => $Company,
                      'UserId' => $Id,
                      '_dID' => DATAOWNER_ID
                  );
                $this->session->set_userdata($sessionData);
                redirect( DATAOWNER_ID . '/dashboard');
                //echo "success!";                
            }
            else
            {
                //Naughty boy. Been suspended....
                $message = '<span class="notification undone"><h4>I\'m sorry. There\'s a problem with your account.</h4><br/> Please call 0161 375 4444 and quote: ' . $_SuspendedReason . ' (Id = ' . $Id . ')</span>';
                $this->force_log_out($message );
                //echo "Suspension!";
            }
        }
        else
        {
            $message = '<span class="notification undone"><h4>I\'m sorry - username/password not recognised.</h4></span>';
            $this->index($message);
            //echo "username/pass not recognised!";
        }
    }

    function log_out()
    {
        $this->session->sess_destroy();
        $message = '<span class="notification warning">You\'ve been logged out.</span>';
        //redirect( DATAOWNER_ID . '/login/index');
        $this->index($message);
        //echo "logged out";
        //print_array($this->session->all_userdata());
    }

    function force_log_out($message = NULL)
    {
        $this->session->sess_destroy();
         if ($message == NULL)
        {
            $message = '<span class="notification information">You\'ve been logged out. (Maximum login time is 2 hours)</span>';
        }
        $this->index($message);
    }
}