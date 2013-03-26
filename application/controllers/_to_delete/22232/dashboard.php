<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends T_Dashboard {

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
        
        //$this->data['view_setup']['stats'] = $this->_generate_stat('contact', 'count');
        
          // Generate the view!
        $this->_generate_view($this->data);
    }
    
   
   
   
}
   