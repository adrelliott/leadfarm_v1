<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Dashboard extends MY_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */
    public $controller_name = 'dashboard';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
        $this->data['controller_setup']['method_name'] = 'index'; 
        $this->data['view_setup']['view_file'] = 'v_dashboard_' . $view_file;
        
        $this->_load_view_data();   //retrieves and process all data for view
    }
   
}
   