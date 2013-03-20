<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testing extends CI_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */

    protected $dID = '';
    
    public function __construct()    {
         parent::__construct();
         //$this->load->library('Automation/Automation_1');
         $this->output->enable_profiler(TRUE);
         echo "<p>this is the testing controller talking</p>";
    }
   
}
   