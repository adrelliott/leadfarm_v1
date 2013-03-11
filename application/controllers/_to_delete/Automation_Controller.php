<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Automation_Controller extends CI_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */
    
    public $data = array
            (
                'config' => array   //store all the congif items here
                    (
                    
                    ),
                'model_setup' => array  //store all vars for queries
                    (
                    
                    ),
                'controller_setup' => array    //store all vars for controlle
                    (
                    
                    ),
                'view_setup' => array   //store all vars for view  
                    (
                        'header_file' => 'header', //turned into modal in T_Controller
                        'footer_file' => 'footer', //turned into modal in T_Controller
                    ),              
            );
    
    public function __construct($controller_name) {
        parent::__construct();
       }
       
       function testing() {
           echo "this is a test fro  the automation controller";
       }
}
/* End of file MY_Controller.php */
/* Location: ./application/core */
