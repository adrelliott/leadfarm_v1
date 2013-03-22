<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Booking extends MY_Controller {
	
    public $controller_name = 'booking';
    var $workshop = FALSE;
    
    public function __construct()    {
         parent::__construct($this->controller_name);
         if ($this->session->userdata('_JobCategory') == 'Workshop') $this->workshop=TRUE;
    }
    
    public function index($view_file) {
        if ($this->workshop) $view_file = 'index_workshop';
        parent::index($view_file);
        
        $this->_load_view_data();    //retrieves and process all data for view  
        
    }
   
    public function view($view_file, $rID, $ContactId = NULL) { 
        if ($this->workshop) $x=1;
        parent::view($view_file);     
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
            'updateCalendar' => true,
          );

          $this->output->set_content_type('application/json');
          $this->output->set_output(json_encode($response));
          return;

        }

        //refresh page
        redirect($url);
       
    }
    
    
    
   
   
}
   