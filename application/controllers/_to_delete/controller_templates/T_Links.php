<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Links extends MY_Controller {

    public $controller_name = 'links';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
        parent::index($view_file);       
        //never calling this with an index. Unless... do we need an error page?
    }
   
    public function view($view_file = 'edit', $rID) {    //$rID=new => create new record
        $this->data['view_setup']['modal'] = TRUE;
        parent::view($view_file);        
        $this->data['view_setup']['rID'] = $rID;
        
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
   