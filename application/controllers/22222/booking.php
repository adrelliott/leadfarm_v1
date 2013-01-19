<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends T_Booking {

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
    
  public function index($view_file = 'index') {   
      $this->data['view_setup']['view_file'] = 'v_booking_' . $view_file;
      parent::index();
   }
   
  public function view($view_file = 'view', $rID = 'new', $ContactId = FALSE) {     
       $this->data['view_setup']['view_file'] = 'v_booking_' . $view_file;
       parent::view($rID, $ContactId);
   }

   
}
   