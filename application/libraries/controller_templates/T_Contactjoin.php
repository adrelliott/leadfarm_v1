<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Contactjoin extends MY_Controller {
	
    public $controller_name = 'contactjoin';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
       //never calling this with an index. Unless... do we need an error page?
    }

   
    public function view($view_file, $rID, $ContactId) {       //$rID=new => create new record        
        $this->data['view_setup']['view_file'] = 'v_contactjoin_' . $view_file;  
        $this->data['controller_setup']['method_name'] = 'view';
        $this->data['view_setup']['modal'] = TRUE;
        $this->data['view_setup']['header_file'] = 'header_modal'; 
        $this->data['view_setup']['footer_file'] = 'footer_modal'; 
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['ContactId'] = $ContactId;   //in this context, $rID == ContactId
        $this->data['view_setup']['display_none'] = '';
        
        $this->_load_view_data($rID); 
        
     }
   
    public function add($view_file, $rID, $ContactId) {       
        //clean input
        $input = clean_data($this->input->post());
        $input['__ContactId'] = $ContactId;
        
        //save record
        $rID = $this->add_record($input, $rID);
        
        //refresh page
        redirect(DATAOWNER_ID . '/' . $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId );
       
    }
    
     /*public function add_OLDVERSION($rID, $ContactId, $view_file) { 
        //clean the input
       $input = clean_data($this->input->post()); 
       $input['__ContactId'] = $ContactId;
       
       $this->load->model('contactjoin_model');
       $rID = $this->contactjoin_model->add($input, $rID);
       $this->view($view_file, $rID, $ContactId);
       
   }*/
   
}
   