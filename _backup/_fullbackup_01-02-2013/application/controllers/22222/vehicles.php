<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicles extends T_Vehicles {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */
    
    public function __construct()    {
        parent::__construct();
        
    }
    
    public function index($view_file = 'index') {     
        parent::index();
        $this->data['view_setup']['view_file'] = 'v_vehicles_' . $view_file;
          // Generate the view!
        $this->generate_view($this->data);
    }
   
    public function view($view_file = 'view', $rID = 'new', $ContactId = FALSE) {     
        $this->data['view_setup']['view_file'] = 'v_vehicles_' . $view_file;  
        parent::view($rID, $ContactId);
        
        
            //check for expirations of MOT & service
        $this->load->library('garages/garage');
        $this->data['view_setup']['notifications'] = array();
        if (isset($this->data['view_setup']['tables']['vehicles']['table_data'][0]))
        {
            $this->data['view_setup']['notifications'] = 
                    $this->garage->check_vehicle_expiry 
                    (
                    $this->data['view_setup']['tables']['vehicles'],
                    $this->data['view_setup']['ContactId']
                    );
        }
            // Generate the view!
        $this->generate_view($this->data);
        }
    
}
   