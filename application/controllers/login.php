<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* This is the Login controller for all users.
 * 
 * 
 * 
 */

  
class Login extends CI_Controller {
    
    public $controller_name = 'login';
    
    public function __construct()    {
         parent::__construct();
         session_start();
    }

    public function index($message = NULL) {      
        if ($this->session->userdata('is_logged_in')) redirect ( site_url('dashboard') );
        elseif ($message == NULL)
            $message = '<span class="notification information">Please log in below</span>';
        
        $this->data['page_setup']['message'] = $message;  
        $this->load->view('default/login/login', $this->data);
    }

   public function validate() {
       $this->load->model('login_model'); 
       $query = $this->login_model->validate_user();
       
       //what's been returned?
       if ( isset($query['results']) ) redirect ( site_url('dashboard') );   //Yay!
       elseif ( isset($query['message']) ) $this->log_out( $query['message'] ); //Oh no!
       
   }
    
    

    function log_out($message = '<span class="notification warning">You\'ve been logged out.</span>') {
        $this->session->sess_destroy();
        session_destroy();  //destroys PHP session too
        $this->index($message);
        
    }

    /*function force_log_out($message = NULL)
    {
        $this->session->sess_destroy();
         if ($message == NULL)
        {
            $message = '<span class="notification information">You\'ve been logged out. (Maximum login time is 2 hours)</span>';
        }
        $this->index($message);
    }*/
    
   /* public function validateOld()
    {
        //load the database
        echo "hello";print_r($this->input->post());
        
        $this->load->model('login_model');    
        //do the query
        $query = $this->login_model->validate_user(); 
        print_array($query, 1);
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
                      '_JobCategory' => $_JobCategory,
                      '_AdminLevel' => $_AdminLevel,
                      '_dID' => $dID
                  );
                $this->session->set_userdata($sessionData);
                //redirect( DATAOWNER_ID . '/dashboard');
                echo "success!";                
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
    }*/
}