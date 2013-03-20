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
    
    public function post_process_booking($data) {
        if (! $this->workshop) return;  //only for workshop users
        if ( empty($this->data['view_setup']['tables']['bookings_join']['table_data'])) return; //make sure we have data to play with
        // 
        return;
        


//set up the wokrshop_booking array
        $retval = array();
        $options = $this->data['config']['record']['view']['fields']['_Status']['options'];
        $results  = $this->data['view_setup']['tables']['bookings_join']['table_data'];
        foreach ( $results as $k => $array )
        {            
            echo "<br/>this is the date of the event". strtotime($array['ActionDate']);
            echo "<br/>this todaty". strtotime("now");
            echo "<br/>this si timestampe".time();
            echo "<br/>this tomorow ?". strtotime("+1 day");

            //if( strtotime($array['ActionDate']) <  )
            $retval[$array['_Status']][] = $array;
                //whats the stage? (not checked in, checked in or)
            
        }
        die;
        //print_array($this->data, 1);
        $this->data['view_setup']['tables']['workshop']['table_data'] =  $retval;
        return;
        
    }
    
   
   
}
   