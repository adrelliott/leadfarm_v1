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
    
  public function index($view_file = 'index') {   
        $this->data['view_setup']['view_file'] = 'v_contact_' . $view_file;
        $this->table_list = array('contacts', 'organisations');   //these are names of the datasets required for this view
        parent::index();
   }
   
  public function view($view_file = 'view', $rID, $fieldset = NULL) {     
        $this->data['view_setup']['view_file'] = 'v_contact_' . $view_file;        
        parent::view($rID, $fieldset);
    }
    
  /*public function add($rID, $fieldset = NULL) {     
        //$this->data['view_setup']['view_file'] = 'v_contact_' . $view_file;        
        parent::add($rID, $fieldset);
    }*/

   
}
   