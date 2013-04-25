<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test130 extends CI_Controller {

    public function __construct()    {
        parent::__construct();
        define( 'DATAOWNER_ID', $this->session->userdata('_dID')); 
    }


    public function index() {          
        echo "<h1>This is the index of test</h1>";
    }
    public function testing() {          
        echo "<h1>This is method 'testing' of controller 'test'</h1>";
    }
    public function error() {          
        echo "<h1>This is method 'error' of controller 'test'</h1>";
    }
    
    public function test_delete($id) {
        echo "Dtarting the delete... (id = $id)<br/>";
        $this->load->model('contact_model', 'contact');
        
        if ( ! $this->contact->make_inactive($id) ) echo "Delete Failed";
        else echo "delete successful!";
        
        print_array($this->contact->make_inactive($id));
    }
    

   


}