<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Booking extends MY_Controller {
	
    public $controller_name = 'booking';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
        $this->data['controller_setup']['method_name'] = 'index'; 
        $this->data['view_setup']['view_file'] = 'v_booking_' . $view_file;
       
        $this->_load_view_data();    //retrieves and process all data for view       
    }
   
    public function view($view_file, $rID, $ContactId = NULL) { 
        $this->data['view_setup']['view_file'] = 'v_booking_' . $view_file;  
        $this->data['controller_setup']['method_name'] = 'view';        
        $this->data['view_setup']['modal'] = FALSE;
        $this->data['view_setup']['header_file'] .= '';  //add '_modal' for modal
        $this->data['view_setup']['footer_file'] .= '';  //add '_modal' for modal       
        $this->data['view_setup']['rID'] = $rID;        
        $this->data['view_setup']['ContactId'] = $rID;   //in this context, $rID == ContactId
        $this->data['view_setup']['display_none'] = '';
        
        $this->_load_view_data($rID);    //retrieves and process all data for view    
        
    }
    
    public function add($view_file, $rID, $ContactId) {       
        //clean input
        $input = clean_data($this->input->post());
        $input['ContactId'] = $ContactId;
        
        //save record
        $this->add_record($input, $rID);
        $url = site_url (DATAOWNER_ID . '/' . $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId);

        if ($this->input->is_ajax_request()) {
          $response = array (
            'success' => true,
          );

          $this->output->set_content_type('application/json');
          $this->output->set_output(json_encode($response));
          return;

        }

        //refresh page
        redirect($url);
       
    }
    
   
   
}
   