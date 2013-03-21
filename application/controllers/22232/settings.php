<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends T_Settings {

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
   public function index($view_file = 'edit') {
       //if (admin level = 11) view)file = show all users 
       
   } 
   
  public function view($view_file = 'edit', $rID = 'new') {          
        parent::view($view_file, $rID);
            // Generate the view!
        $this->_generate_view($this->data);
    }
    
        
    
}
   