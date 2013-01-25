<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Booking extends MY_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */
    public $controller_name = 'booking';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index() {
        $this->data['controller_setup']['method_name'] = 'index';
        $this->data['view_setup']['header_file'] .= '_modal';  //add '_modal' for modal
        parent::index();
       
          // Generate the view!
        $this->generate_view($this->data);
    }
   
    public function view($rID, $ContactId = NULL) {    //false = create new record
        $this->data['controller_setup']['method_name'] = 'view';
        $this->data['view_setup']['header_file'] .= '_modal';  //add '_modal' for modal
        $this->data['view_setup']['footer_file'] .= '';  //add '_modal' for modal       
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['ContactId'] = $rID;   //in this context, $rID == ContactId
        parent::view($rID);
        
          // Generate the view!
        $this->generate_view($this->data);
    }
   
}
   