<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactjoin extends T_Contactjoin {

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
    
  public function index() {     
       //parent::index();
            
        // Generate the view!        
       //$this->_generate_view($this->data);
   }
   
  public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE) {    
       parent::view($view_file, $rID, $ContactId);   
            
        // Generate the view!        
       $this->_generate_view($this->data);

  }

   
}
   