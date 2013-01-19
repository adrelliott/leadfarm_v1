<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends T_Contact {

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
        $this->data['view_setup']['view_file'] = '????filename?????';
       parent::index();
   }
   
  public function view($view_file, $rID = 'new', $ContactId = FALSE) {     
        $this->data['view_setup']['view_file'] = '????filename?????';
       parent::view($view_file, $rID, $ContactId);
   }

   
}
   