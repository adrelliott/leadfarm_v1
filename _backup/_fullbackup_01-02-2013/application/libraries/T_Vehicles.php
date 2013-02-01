<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Vehicles extends MY_Controller {
    
    public $controller_name = 'vehicles';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index() {
        $this->data['controller_setup']['method_name'] = 'index';
        parent::index();
     }

    public function view($rID, $ContactId) {    //$rID=new => create new record
        $this->data['controller_setup']['method_name'] = 'view';
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['ContactId'] = $ContactId;   
        parent::view($rID);
     }

     public function add($rID, $ContactId, $view_file = 'view') {    //false = create new record
         //clean the input
         $input = clean_data($this->input->post()); 
         $input['__ContactId'] = $ContactId;

         $this->load->model('vehicle_model');
         $rID = $this->vehicle_model->add($input, $rID);
         //redirect(DATAOWNER_ID . "/contactaction/$view_file/$rID/$ContactId" );
         $this->view($view_file, $rID, $ContactId);

     }
   
}
   