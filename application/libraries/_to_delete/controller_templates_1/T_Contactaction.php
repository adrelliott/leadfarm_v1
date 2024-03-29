<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Contactaction extends MY_Controller {

    public $controller_name = 'contactaction';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
       //never calling this with an index. Unless... do we need an error page?
    }
   
    public function view($view_file, $rID, $ContactId) {    //$rID=new => create new record
        $this->data['view_setup']['modal'] = TRUE;
        parent::view($view_file);
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['ContactId'] = $ContactId;  
        $this->data['view_setup']['display_none'] = '';
        
        $this->_load_view_data($rID);    //retrieves and process all data for view    
    }
   
   
    public function add($view_file, $rID, $ContactId) {       
        //clean input
        $input = clean_data($this->input->post());
        $input['ContactId'] = $ContactId;
        
        //save record
        $rID = $this->add_record($input, $rID);
        //refresh page
        redirect(DATAOWNER_ID . '/' . $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId );
       
    }
   
}
   