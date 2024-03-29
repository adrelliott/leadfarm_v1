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
   
    public function view($view_file='view', $rID, $ContactId=NULL, $fieldset='unknown'){
        $this->data['view_setup']['view_file'] = 'v_contact_' . $view_file;        
        $this->data['controller_setup']['method_name'] = 'view';        
        $this->data['view_setup']['modal'] = FALSE;
        $this->data['view_setup']['header_file'] .= '';  //add '_modal' for modal
        $this->data['view_setup']['footer_file'] .= '';  //add '_modal' for modal       
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['ContactId'] = $ContactId;   //in this context, $rID == ContactId
        $this->data['view_setup']['display_none'] = ''; 
        
        //What record fieldset do we show? Org, ind or unknown?
        $this->data['view_setup']['fieldset'] = $fieldset;
        
        $this->_load_view_data($rID);    //retrieves and process all data for view              
    }    
     
    public function add($view_file, $rID, $ContactId, $fieldset) {

        //clean input
        $input = clean_data($this->input->post());

        //save record
        $rID = $this->add_record($input, $rID);
        $url = site_url (DATAOWNER_ID . '/' . $this->controller_name . '/view/edit/' . $rID . '/' . $rID . '/' . $input['_IsOrganisationYN']);

        if ($this->input->is_ajax_request ()) {
            $response = array (
                'success' => true,
            );

            if ($ContactId === 'new') {
                $response['redirect'] = $url;
            }

            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($response));
            return;
        }

        //refresh page
        redirect($url);
       
    }
    
    public function append_note($view_file, $rID, $ContactId, $fieldset) {
        //Concatenate the new note ready for updating
        $input = clean_data($this->input->post()); 
        $input['ContactNotes'] .= "\n:::: On " . date('d-m-Y H:i') . ', ' . 
                $this->session->userdata('FirstName') . ' ' . 
                $this->session->userdata('LastName') . " wrote:::: \n" . 
                $input['add_a_note'];  //add the new note details
        unset($input['add_a_note']); //tidy up        
        
        //save record
        $this->add_record($input, $rID);

        if ($this->input->is_ajax_request()) {
            $response = array(
                'success' => true,
                'data' => array ('ContactNotes' => $input['ContactNotes'])
            );
            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($response));
            return;
        }

        //refresh page
        redirect(DATAOWNER_ID . '/' . $this->controller_name . '/view/edit/' . $rID . '/' . $ContactId . '/' . $fieldset );

    }
   
   //create a remove method
   // does it actually delete or does it just add a tag/switch to say its deleted?
   
}
   