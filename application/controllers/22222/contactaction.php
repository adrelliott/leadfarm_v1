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
        $this->data['view_setup']['modal'] = TRUE; 
         parent::__construct();
    }
    
  public function index() {     
        //$this->data['view_setup']['view_file'] = '????filename?????';
       parent::index();
   }
   
  public function view($view_file, $rID = 'new', $ContactId) {     
        $this->data['view_setup']['view_file'] = '????filename?????';
       parent::view($view_file, $rID, $ContactId);
   }

   
}
   