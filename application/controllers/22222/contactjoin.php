<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contactjoin extends T_Contactjoin {

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
        $this->data['view_setup']['view_file'] = '????filename?????';
       parent::index();
   }
   
  public function view($view_file = 'view', $rID = 'new', $ContactId = FALSE) {     
       $this->data['view_setup']['view_file'] = 'v_contactjoin_' . $view_file;
       parent::view($rID, $ContactId);

  }

   
}
   