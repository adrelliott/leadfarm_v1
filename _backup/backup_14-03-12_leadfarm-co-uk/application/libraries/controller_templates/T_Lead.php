<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Lead extends MY_Controller { 

    public $controller_name = 'lead';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
        $this->data['controller_setup']['method_name'] = 'index';
        $this->data['view_setup']['view_file'] = 'v_lead_' . $view_file;        
        
        $this->_load_view_data();   //retrieves and process all data for view        
    }
   
    public function view($view_file='view', $rID){
        $this->data['view_setup']['view_file'] = 'v_lead_' . $view_file;        
        $this->data['controller_setup']['method_name'] = 'view';        
        $this->data['view_setup']['modal'] = FALSE;
        $this->data['view_setup']['header_file'] .= '';  //add '_modal' for modal
        $this->data['view_setup']['footer_file'] .= '';  //add '_modal' for modal       
        $this->data['view_setup']['rID'] = $rID;
        //$this->data['view_setup']['ContactId'] = $ContactId;   //in this context, $rID == ContactId
        $this->data['view_setup']['display_none'] = ''; 
        
        
        $this->_load_view_data($rID);    //retrieves and process all data for view              
    }    
     
    public function add($view_file, $rID) {

        //clean input
        $input = clean_data($this->input->post());
         $input['ContactID'] = $ContactId;   //Gotcha: watch for capitised 'ID'
        
        //save record
        $rID = $this->add_record($input, $rID);
        
        //refresh page
        redirect(DATAOWNER_ID . '/' . $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId );
       
    }
    public function post_process_lead($data) {
        //do some post processing
        //print_array($data['view_setup']['tables']);
        
        //sort the leads into lead types
        $retval = array();
        foreach ($data['view_setup']['tables']['leads']['table_data'] as $key => $array)
        {            
            if ($array['__LeadType']) $retval[$array['__LeadType']][] = $array;
        }
        $this->data['view_setup']['tables']['leads_by_type'] = $retval;
    }
    
    
   
}
   