<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

     function __construct()    {
        parent::__construct();
$this->output->enable_profiler(TRUE);
        
            echo "<h1>This si the SPECIFIC controller</h1>";
    }
    
     function index($view_file = 'index') {   
        parent::index($view_file);
      //$this->output->enable_profiler(TRUE);
         // Generate the view!
        $this->_generate_view($this->data);       
        
        
       
    }
   
     function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE, $pull = '') { 
        parent::view($view_file, $rID, $ContactId);
       
        $this->load_view($pull);
        
    }
    
     function get_booking_array() {
       //this generates the data for the non-workshop view
       $this->load->model('booking_model');
       $results = $this->booking_model->get_all_bookings();
        header ('Content-Type: text/json');
        echo json_encode ($results);
        exit;
   }
   
   function test_spec() {
       echo 'hello - I am in the 22222 folder';
   }
      