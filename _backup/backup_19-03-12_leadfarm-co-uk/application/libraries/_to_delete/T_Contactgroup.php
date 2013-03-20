<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Contactgroup extends MY_Controller {

    public $controller_name = 'contactgroup';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
       //never calling this with an index. Unless... do we need an error page?
    }
   
    public function view($view_file, $rID) {    //$rID=new => create new record
        $this->data['view_setup']['view_file'] = 'v_contactgroup_' . $view_file;
        $this->data['controller_setup']['method_name'] = 'view';
        $this->data['view_setup']['modal'] = TRUE;
        $this->data['view_setup']['header_file'] = 'header_modal'; 
        $this->data['view_setup']['footer_file'] = 'footer_modal'; 
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['display_none'] = '';
        
        $this->_load_view_data($rID);    //retrieves and process all data for view    
    }
   
   
    public function add($view_file, $rID) {       
        //clean input
        $input = clean_data($this->input->post());
        
        //save record
        $rID = $this->add_record($input, $rID);
        //refresh page
        redirect(DATAOWNER_ID . '/' . $this->controller_name . '/view/' . $view_file . '/' . $rID );
       
    }
   
}
   