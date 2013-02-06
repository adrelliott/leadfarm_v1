<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Vehicles extends MY_Controller {
    
    public $controller_name = 'vehicles';
    
    public function __construct()    {
         parent::__construct($this->controller_name);         
    }
    
    public function index($view_file) {
        $this->data['controller_setup']['method_name'] = 'index';
        $this->data['view_setup']['view_file'] = 'v_vehicles_' . $view_file;
        
        $this->_load_view_data();    //retrieves and process all data for view
     }

    public function view($view_file, $rID, $ContactId) {    //$rID=new => create new record
        $this->data['view_setup']['view_file'] = 'v_vehicles_' . $view_file;
        $this->data['controller_setup']['method_name'] = 'view'; 
        $this->data['view_setup']['modal'] = FALSE; 
        $this->data['view_setup']['header_file'] .= '';  //add '_modal' for modal
        $this->data['view_setup']['footer_file'] .= '';  //add '_modal' for modal       
        $this->data['view_setup']['rID'] = $rID;        
        $this->data['view_setup']['ContactId'] = $ContactId; ;   
        $this->data['view_setup']['display_none'] = '';
        
        $this->_load_view_data($rID);     //retrieves and process all data for view    
     }
     
      public function view_modal($view_file, $rID, $ContactId = NULL) {    
        $this->data['view_setup']['view_file'] = 'v_vehicles_' . $view_file;  
        $this->data['controller_setup']['method_name'] = 'view';        
        $this->data['view_setup']['modal'] = TRUE;
        $this->data['view_setup']['header_file'] .= '_modal';  
        $this->data['view_setup']['footer_file'] .= '_modal';  
        $this->data['view_setup']['rID'] = $rID;        
        $this->data['view_setup']['ContactId'] = $rID;   //in this context, $rID == ContactId
        $this->data['view_setup']['display_none'] = '';
        //print_array($this->data, 1);
        $this->_load_view_data($rID);    //retrieves and process all data for view    
       
       
    }

     public function add($rID, $ContactId, $view_file = 'view') {    //false = create new record
         //clean the input
         $input = clean_data($this->input->post()); 
         $input['__ContactId'] = $ContactId;

         $this->load->model('vehicles_model');
         $rID = $this->vehicles_model->add($input, $rID);
         redirect(DATAOWNER_ID . "/vehicles/view/$view_file/$rID/$ContactId" );
         //$this->view($view_file, $rID, $ContactId);

     }
     
      public function append_note($rID, $ContactId) {
        $input = clean_data($this->input->post()); 

        //Concatenate the new note ready for updating
        $input['__VehicleNotes'] .= "\n:::: On " . date('d-m-Y H:i') . ', ';
        $input['__VehicleNotes'] .= $this->session->userdata('FirstName') . ' ' . $this->session->userdata('LastName');
        $input['__VehicleNotes'] .= " wrote:::: \n";
        $input['__VehicleNotes'] .= $input['add_a_note'];  //add the new note details
        unset($input['add_a_note']); //tidy up        

        //Now update the record
        $this->load->model('vehicles_model');
        $this->db->from('__Vehicles');
        $rID = $this->vehicles_model->save($input, $rID);

        //Refresh view       
        redirect(DATAOWNER_ID . '/vehicles/view/edit/' . $rID . '/' . $ContactId );

        //Can this method be made prettier? or moving some of it back to the 'add' method?
    }
     
     /*
     public function add_modal($rID, $ContactId, $view_file = 'view') {    //false = create new record
         //clean the input
         $input = clean_data($this->input->post()); 
         $input['__ContactId'] = $ContactId;

         $this->load->model('vehicles_model');
         $rID = $this->vehicles_model->add($input, $rID);
         //redirect(DATAOWNER_ID . "/contactaction/$view_file/$rID/$ContactId" );
         $this->add_new($view_file, $rID, $ContactId);

     }*/
   
}
   