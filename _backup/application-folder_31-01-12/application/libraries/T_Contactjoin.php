<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Contactjoin extends MY_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */
    public $controller_name = 'contactjoin';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index() {
        $this->data['controller_setup']['method_name'] = 'index';
        parent::index();

     }
   
    public function view($rID, $ContactId) {       //$rID=new => create new record
        $this->data['controller_setup']['method_name'] = 'view';
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['ContactId'] = $ContactId;   //in this context, $rID == ContactId
        
        parent::view($rID);
        
     }
   
    public function add($rID, $ContactId, $view_file = 'view') {    //false = create new record
       //print_array($this->input->post(), 1);
        //clean the input
       $input = clean_data($this->input->post()); 
       $input['__ContactId'] = $ContactId;
       
       $this->load->model('contactjoin_model');
       $rID = $this->contactjoin_model->add($input, $rID);
       //redirect(DATAOWNER_ID . "/contactaction/$view_file/$rID/$ContactId" );
       $this->view($view_file, $rID, $ContactId);
       
   }
   
}
   