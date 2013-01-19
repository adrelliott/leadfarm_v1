<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Contact extends MY_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */
    public $controller_name = 'contact';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
  public function index() {
       $this->data['controller_setup']['method_name'] = 'index';
       parent::index();
   }
   
  public function view($view_file, $rID, $ContactId = NULL) {    //false = create new record
       $this->data['controller_setup']['method_name'] = 'view';
       $this->data['view_setup']['view_file'] = 'viewRecord_' . $view_file;
       $this->data['view_setup']['header_file'] .= '';  //add '_modal' for modal
       $this->data['view_setup']['footer_file'] .= '';  //add '_modal' for modal       
       $this->data['view_setup']['rID'] = $rID;
       $this->data['view_setup']['ContactId'] = $rID;   //in this context, $rID == ContactId
       parent::view($rID);
       //echo "<p>well... here we are looking at the 'view' function</p>";
       //print_array($this->data);
   }
   
}
   