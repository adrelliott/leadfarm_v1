<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lead extends T_Help {

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
    
    function index () {
        echo "indexpage";
    }
    
    function view () {
        echo "viewpage";
    }
    
   
 
        
    
}
   