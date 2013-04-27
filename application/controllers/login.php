<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* This is the Login controller for all users.
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
       if ($query['result']) redirect ( site_url('dashboard') );   //Yay!
       else $this->log_out( $query['message'] );
       
   }
   
    function log_out($message = '<span class="notification warning">You\'ve been logged out.</span>') {
        $this->session->sess_destroy();
        session_destroy();  //destroys PHP session too
        $this->index($message);
        
    }
    
    
    
    
   
   public function validate_old() {
       $this->load->model('login_model'); 
       $query = $this->login_model->validate_user();
       
       //print_array($this->session->all_userdata(), 0, 'session');
       //print_array($query, 0, 'line 28');
       //
       //what's been returned?
       if ($query['result']) redirect ( site_url('dashboard') );   //Yay!
       else $this->log_out( $query['message'] );
       //if ( isset($query['results']) ) redirect ( site_url('dashboard') );   //Yay!
       //elseif ( isset($query['message']) ) $this->log_out( $query['message'] ); //Oh no!
       
   }
    
   

}