<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Do we have bespoke controller set up?
$controller = 'Dashboard';
include('controller_setup/init.php');

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
        parent::index($view_file);
        
        $this->_load_view_data();   //retrieves and process all data for view
    }
   
}
   