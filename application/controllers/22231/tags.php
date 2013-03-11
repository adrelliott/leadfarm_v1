<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends T_Tags {

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
    
   
  public function view($view_file = 'view', $rID = 'new') {          
        parent::view($view_file, $rID);
            // Generate the view!
        $this->_generate_view($this->data);
    }
    
        
    
}
   