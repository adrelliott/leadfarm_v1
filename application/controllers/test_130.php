<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* This is the Login controller for all users.
 *  
 */

class Test_130 extends CI_Controller {
    
    public $controller_name = 'login';
    
    public function __construct()    {
         parent::__construct();
    }

    public function index() {      
        echo "index of test_130";
    }
    
    function get_id() {
        $this->load->model('contact_model'); 
        $query = $this->contact_model->bespoke_contact_22232();
        //print $this->contact_model->bespoke_contact_22232();
        print_r($query);
    }

}