<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Campaign extends MY_Controller { 

    public $controller_name = 'campaign';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
        $this->data['controller_setup']['method_name'] = 'index';
        $this->data['view_setup']['view_file'] = 'v_campaign_' . $view_file;
        
        $this->_load_view_data();   //retrieves and process all data for view        
    }
   
    public function view($view_file='view', $rID){
        $this->data['view_setup']['view_file'] = 'v_campaign_' . $view_file;        
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
        
        //save record
        $campId = $this->add_record($input, $rID);
        $url = site_url (DATAOWNER_ID . '/' . $this->controller_name . '/view/edit/' . $campId );

        if ($this->input->is_ajax_request ()) {
            $response = array (
                'success' => true,
            );

            if ($rID === 'new') {
                $response['redirect'] = $url;
            }

            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($response));
            return;
        }

        //refresh page
        redirect($url);
       
    }
    
    
   
}
   