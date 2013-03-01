<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lead extends T_Lead {

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
   
  public function view($view_file, $rID) {  
        parent::view($view_file, $rID);
        
          // Generate the view!
        $this->_generate_view($this->data);
    }
    
   
 
        
    
}
   