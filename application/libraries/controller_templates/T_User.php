<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_User extends MY_Controller { 

    public $controller_name = 'user';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
         parent::index($view_file);
        
        $this->_load_view_data();   //retrieves and process all data for view        
    }
   
    public function view($view_file, $rID, $ContactId=NULL){
        parent::view($view_file);    
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['ContactId'] = $ContactId;   //in this context, $rID == ContactId
        $this->data['view_setup']['display_none'] = ''; 
                
        $this->_load_view_data($rID);    //retrieves and process all data for view              
    }    
     
    public function add($view_file, $rID) {       
        //clean input
        $input = clean_data($this->input->post());
        if (isset($input['Email'])) $input['Email'] = md5 ($input['Email']);
        
        //save record
        $rID = $this->add_record($input, $rID);
        
        //refresh page
        redirect(DATAOWNER_ID . '/' . $this->controller_name . '/view/' . $view_file . '/' . $rID );
       
    }
    
    public function change_password($rID, $ContactId) {       
        //clean input
        $input = clean_data($this->input->post());
        //print_array($input, 1);
        
        //Do some checks
        if ($input['PasswordCheck'] != $input['Password'])
        {
            //$this->session->set_flashdata('message', 'Ooops. Passwords do not match');
            //print_array($this->data);
            
        }
        
        else{
        
        //Does the original password match the new password?
        
        //if its all good, then change the password
        
        //save record
        $rID = $this->add_record($input, $rID);
        
        //refresh page
        redirect(DATAOWNER_ID . '/' . $this->controller_name . '/view/edit/' . $rID . '/' . $ContactId);
        }
       
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
        
        //refresh page
        redirect(DATAOWNER_ID . '/' . $this->controller_name . '/view/edit/' . $rID . '/' . $ContactId . '/' . $fieldset );

    }
   
    public function append_note_ajax() {
        //Concatenate the new note ready for updating
        //echo "<h1>hello</h1>";die;
        
        $input = clean_data($this->input->post()); 
        $input['ContactNotes'] .= "\n:::: On " . date('d-m-Y H:i') . ', ' . 
                $this->session->userdata('FirstName') . ' ' . 
                $this->session->userdata('LastName') . " wrote:::: \n" . 
                $input['add_a_note'];  //add the new note details
        unset($input['add_a_note']); //tidy up        
        
        //save record
        $this->add_record($input, $rID);
        
        $this->view($view_file, $rID, $ContactId);
        //print_array($input);
        

    }
   
   //create a remove method
   // does it actually delete or does it just add a tag/switch to say its deleted?
   
}
   