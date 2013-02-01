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
    
    public function index() {  
        $this->data['view_setup']['view_file'] = 'v_dashboard';
        $this->table_list = array('contacts', 'organisations');   //these are names of the datasets
        parent::index();
          // Generate the view!
        $this->generate_view($this->data);
    }
   
   
}
   