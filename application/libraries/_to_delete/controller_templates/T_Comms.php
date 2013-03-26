<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Comms extends MY_Controller {
    
    
    public $controller_name = 'comms';
    
    public function __construct()    {
         parent::__construct($this->controller_name);         
    }
    
    public function index($view_file) {
        parent::index($view_file);
        echo "here i am";
        $this->_load_view_data();    //retrieves and process all data for view
     }

    public function view($view_file, $rID, $ContactId) {    //$rID=new => create new record
       $this->data['view_setup']['modal'] = TRUE;
       
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['ContactId'] = $ContactId;  
        $this->data['view_setup']['display_none'] = '';
        parent::view($view_file);
        
        $this->_load_view_data($rID);     //retrieves and process all data for view    
     }
    
     public function add($view_file, $rID, $ContactId) {       
        //clean input
        $input = clean_data($this->input->post());
        $input['__ContactId'] = $ContactId;
        
        //save record
        $rID = $this->add_record($input, $rID);
        $url = site_url (DATAOWNER_ID . '/' . $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId);

        if(strpos($view_file, '_modal') === FALSE)
        {
            redirect($url);
        }
        else
        {
            $this->view_modal($view_file, $rID, $ContactId);
        }
       
    }
    
    
     
}
   