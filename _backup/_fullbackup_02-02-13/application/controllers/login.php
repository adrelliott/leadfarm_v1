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

    public function index($message = NULL)
    {      
        $dID = $this->session->userdata('dID');
        //if (isset($dID)) redirect ();
        $dID = $this->uri->segment(2);
        if ($message == NULL)
        {
            $message = '<span class="notification information">Please log in below</span>';
        }
        $this->data['page_setup']['message'] = $message;  
        $this->data['page_setup']['dID'] = $dID;  
        $this->load->view('default/login/login', $this->data);
    }

   
    public function validate($dID)
    {
       
        
        if (isset($dID) AND is_numeric($dID))
        {
            define('DATAOWNER_ID', $dID);
        }
        else
        {
            $this->index('No dID defined');die('46');
            exit;
        }
        
        if (! $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_database'))
        {
            echo "failed ot load ";die('52');
        }
        //Load the bespoke config
        $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_database');
        $this->load->model('login_model');    
        $query = $this->login_model->validate_user(); 
       print_array($query);
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
                      'Company' => $Company,
                      'UserId' => $Id,
                      '_dID' => DATAOWNER_ID
                      //add more info using the format $row->NAME, where NAME = database col name
                  );
                $this->session->set_userdata($sessionData);
                redirect( DATAOWNER_ID . '/dashboard');
                //echo "success!";
                
            }
            else
            {
                //Naughty boy. Been suspended....
                $message = '<span class="notification undone"><h4>I\'m sorry. There\'s a problem with your account.</h4><br/> Please call 0161 375 4444 and quote: ' . $_SuspendedReason . '(Id = ' . $Id . ')</span>';
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
            
            
            /*
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
        }*/
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