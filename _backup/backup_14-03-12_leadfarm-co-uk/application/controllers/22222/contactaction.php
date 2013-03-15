<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactaction extends T_Contactaction {

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
      
          // Generate the view!
        $this->_generate_view($this->data);
    }
   
  public function view($view_file = 'view', $rID = 'new', $ContactId = FALSE) {          
        parent::view($view_file, $rID, $ContactId);
            // Generate the view!
        $this->_generate_view($this->data);
    }
    
  
    
    //function add_booking ($rID, $ContactId, $view_file = 'edit_booking') {
     //   $this->add($rID, $ContactId, $view_file);
   // }
    
        
    
}
   