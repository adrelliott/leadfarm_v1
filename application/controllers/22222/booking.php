<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends T_Booking {
	
    public function __construct()    {
        parent::__construct();
$this->output->enable_profiler(TRUE);
    }
    
    public function index($view_file = 'index') {   
        parent::index($view_file);
      
         // Generate the view!
        $this->_generate_view($this->data);       
       
    }
   
    public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE, $pull = '') { 
        parent::view($view_file, $rID, $ContactId);
       
        $this->load_view($pull);
        
    }
    
    public function get_booking_array() {
       //this generates the data for the non-workshop view
       $this->load->model('booking_model');
       $results = $this->booking_model->get_all_bookings();
        header ('Content-Type: text/json');
        echo json_encode ($results);
        exit;
   }
   
   
    
    
       
}
   