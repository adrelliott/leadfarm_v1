<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Contact extends MY_Controller { 

    public $controller_name = 'contact';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
        $this->data['controller_setup']['method_name'] = 'index';
        $this->data['view_setup']['view_file'] = 'v_contact_' . $view_file;
        
        $this->_load_view_data();   //retrieves and process all data for view        
    }
   
    public function view($view_file, $rID, $ContactId, $fieldset) {    //false = create new record
        $this->data['view_setup']['view_file'] = 'v_contact_' . $view_file;        
        $this->data['controller_setup']['method_name'] = 'view';        
        $this->data['view_setup']['modal'] = FALSE;
        $this->data['view_setup']['header_file'] .= '';  //add '_modal' for modal
        $this->data['view_setup']['footer_file'] .= '';  //add '_modal' for modal       
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['ContactId'] = $ContactId;   //in this context, $rID == ContactId
        $this->data['view_setup']['display_none'] = ''; 
        
        //What record fieldset do we show? Org, ind or unknonw?
        $this->data['view_setup']['fieldset'] = $fieldset;
        
        $this->_load_view_data($rID);    //retrieves and process all data for view              
    }    
     
    public function add($rID, $input = NULL, $action = 'contact') {    //false = create new record
        //clean the input
        $input = clean_data($this->input->post()); 

        $this->load->model('contact_model');
        $rID = $this->contact_model->add($input, $rID);  

        $fieldset = $input['_IsOrganisationYN'];
        $result = $this->start_action($action);   //sstarts any follow ups/ and applies tags
        
        redirect(DATAOWNER_ID . '/' . $action . '/view/edit/' . $rID . '/' . $fieldset );
       
    }
    
    function start_action($view) {
        switch ($view)
        {
            case 'contact':
                break;
            case 'booking':
                break;
        }
    }
    
    public function append_note($rID, $fieldset) {
        $input = clean_data($this->input->post()); 

        //Concatenate the new note ready for updating
        $input['ContactNotes'] .= "\n:::: On " . date('d-m-Y H:i') . ', ';
        $input['ContactNotes'] .= $this->session->userdata('FirstName') . ' ' . $this->session->userdata('LastName');
        $input['ContactNotes'] .= " wrote:::: \n";
        $input['ContactNotes'] .= $input['add_a_note'];  //add the new note details
        unset($input['add_a_note']); //tidy up        

        //Now update the record
        $this->load->model('contact_model');
        $this->db->from('Contact');
        $rID = $this->contact_model->save($input, $rID);

        //Refresh view       
        redirect(DATAOWNER_ID . '/contact/view/edit/' . $rID . '/' . $fieldset );

        //Can this method be made prettier? or moving some of it back to the 'add' method?
    }
   
   //create a remove method
   // does it actually delete or does it just add a tag/switch to say its deleted?
   
}
   