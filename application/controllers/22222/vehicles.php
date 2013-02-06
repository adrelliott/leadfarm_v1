<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicles extends T_Vehicles {
    
    public function __construct()    {
        parent::__construct();
    }
    
    public function index($view_file = 'index') {     
        parent::index($view_file);
        $this->_generate_view($this->data);
    }
   
    public function view($view_file = 'view', $rID = 'new', $ContactId = FALSE) {     
        parent::view($view_file, $rID, $ContactId);
        
            //check for expirations of MOT & service
        $this->load->library('garages/garage');
        $this->data['view_setup']['notifications'] = array();
        if (isset($this->data['view_setup']['tables']['vehicles']['table_data'][0]))
        {
            $this->data['view_setup']['notifications'] = 
                    $this->garage->check_vehicle_expiry 
                    (
                    $this->data['view_setup']['tables']['vehicles'],
                    $this->data['view_setup']['ContactId']
                    );
        }
            // Generate the view!
        $this->_generate_view($this->data);
    }
    
    public function view_modal($view_file = 'view', $rID = 'new', $ContactId = FALSE) {    
        parent::view_modal($view_file, $rID, $ContactId);
            // Generate the view!
        $this->_generate_view($this->data);
    }
    
    public function create_new($view_file = 'view', $rID = 'new', $ContactId = FALSE) {     
        $this->data['view_setup']['view_file'] = 'v_vehicles_' . $view_file; 
        
        $this->data['view_setup']['modal'] = TRUE;
        $this->data['view_setup']['header_file'] = 'header_modal'; 
        $this->data['view_setup']['footer_file'] = 'footer_modal'; 
        parent::view($rID, $ContactId);
        
             // Generate the view!
        $this->_generate_view($this->data);
    }
    
    public function add_new($rID, $ContactId, $view_file = 'view') {    //false = create new record
         //clean the input
         $input = clean_data($this->input->post()); 
         $input['__ContactId'] = $ContactId;

         $this->load->model('vehicles_model');
         $rID = $this->vehicles_model->add($input, $rID);
         redirect(DATAOWNER_ID . "/vehicles/create_new/edit_modal/$rID/$ContactId" );
         
         //$this->create_new($view_file, $rID, $ContactId);

     }
    
}
   