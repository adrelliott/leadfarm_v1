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
    
  public function index() {
       $this->data['controller_setup']['method_name'] = 'index'; 
       
       parent::index();
       
       
       
      // print_array($this->data);
   }
   
}
   