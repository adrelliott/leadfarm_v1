<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends T_Contact {

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
        parent::index($view_file);
        $this->_generate_view($this->data);
   }
   
  public function view($view_file = 'view', $rID, $fieldset = NULL) {  
        parent::view($view_file, $rID, $fieldset);
        
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
        $this->_generate_view($this->data);
    }
    
  
   
}
   