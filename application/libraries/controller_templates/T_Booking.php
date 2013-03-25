<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Booking extends MY_Controller {
	
    public $controller_name = 'booking';
    var $workshop = FALSE;
    var $current_day = NULL;
    
    public function __construct()    {
         parent::__construct($this->controller_name);
         if ($this->session->userdata('_JobCategory') == 'Workshop' & ! isset($_GET['full_cal'])) $this->workshop=TRUE;
    }
    
    public function index($view_file) {
        $method_name = 'index';
        if ($this->workshop)
        {
            $view_file = 'index_workshop';
            $method_name = 'index_workshop';
            $this->setup_dates();
        }
            
        parent::index($view_file, $method_name);
        $this->_load_view_data();    //retrieves and process all data for view  
        
    }
    
   
    public function view($view_file, $rID, $ContactId = NULL) { 
        //if ($this->workshop) $view_file = 'workshop/edit_workshop'; 
        parent::view($view_file);     
        $this->data['view_setup']['rID'] = $rID;        
        $this->data['view_setup']['ContactId'] = $rID;   //in this context, $rID == ContactId
        $this->data['view_setup']['display_none'] = '';
        
        $this->_load_view_data($rID);    //retrieves and process all data for view    
        
    }
    
    public function add($view_file, $rID, $ContactId = FALSE) {       
        //clean input
        $input = clean_data($this->input->post());
        if ($ContactId) $input['ContactId'] = $ContactId;
        
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
    
    public function mechanic_amend_booking($rID, $param = NULL) {       
        //clean input
        $input = clean_data($this->input->post());
        
        //save record
        $this->add_record($input, $rID);
        
        if ($param) $param = "?current_day=$param";
        
        //refresh page
        //redirect( site_url (DATAOWNER_ID . '/' . $this->controller_name . $param) );
        $url = site_url (DATAOWNER_ID . '/' . $this->controller_name . $param);
        
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
    
    public function post_process_booking() {
        if ($this->workshop)
        {
             $this->setup_dropdown($this->data['view_setup']['tables']['users']['table_data'], 'users');
             $this->data['view_setup']['fields'] = $this->data['config']['record']['view']['fields'];;
             
        }
           
            
        
        return;
    }
    
    function setup_dropdown($data, $type) {
        $dropdowns = array();
        foreach ($data as $k => $v)
        {
            switch ($type)
            {
                case 'users':
                    $dropdowns[$v['FirstName'] . ' ' . substr($v['LastName'],0,1)] = $v['Id'];
                    break;
                case 'job_status':
                    if ($v != 0) $dropdowns[$k] = $v;
                    break;
                //add in other dropdownsd here
            }
            
        }
        
        //add all this dat back to the array available in the view
        $this->data['view_setup']['dropdowns'][$type] = $dropdowns;
        return;
    }
    
     function setup_dates() { 
        //Work out the dates for the nvigation on the page 
        if (isset($_GET['current_day']))    //We can pass current day via URL param
                $this->current_day = strtotime($_GET['current_day'] . ' 00:00:00');
        else $this->current_day = strtotime(date('Y-m-d 00:00:00'));
        
        //Now set up the rest of the dates for the page
        $this->data['view_setup']['dates'] = array
        (
            'yesterday' => date('Y-m-d', $this->current_day - (24*60*60)),
            'today' => date('Y-m-d'),
            'current_day' => date('Y-m-d', $this->current_day),
            'current_day_nice' => date('dS F, Y', $this->current_day),
            'tomorrow' => date('Y-m-d', $this->current_day + (24*60*60)),
        );
        
        return;
    }
    
    
    
    
    
   
   
}
   