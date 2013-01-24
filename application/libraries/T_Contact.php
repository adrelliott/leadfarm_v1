<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Contact extends MY_Controller { 

    public $controller_name = 'contact';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
  public function index() {
       $this->data['controller_setup']['method_name'] = 'index';
       parent::index();
   }
   
  public function view($rID, $fieldset) {    //false = create new record
       $this->data['controller_setup']['method_name'] = 'view';
       $this->data['view_setup']['header_file'] .= '';  //add '_modal' for modal
       $this->data['view_setup']['footer_file'] .= '';  //add '_modal' for modal       
       $this->data['view_setup']['rID'] = $rID;
       $this->data['view_setup']['ContactId'] = $rID;   //in this context, $rID == ContactId
       $this->data['view_setup']['display_none'] = '';
       $this->data['view_setup']['fieldset'] = $fieldset;
       
       parent::view($rID);
       
  }       
     
  public function add($rID, $input = NULL) {    //false = create new record
       //clean the input
       $input = clean_data($this->input->post()); 
       
       $this->load->model('contact_model');
       $rID = $this->contact_model->add($input, $rID);  
       
       $fieldset = $input['_IsOrganisationYN'];
       redirect(DATAOWNER_ID . '/contact/view/edit/' . $rID . '/' . $fieldset );
       
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
       redirect(DATAOWNER_ID . '/contact/view/edit/' . $rID . '/' . $fieldset .'#tab-2' );
       
       //Can this method be made prettier? or moving some of it back to the 'add' method?
   }
   
   //create a remove method
   // does it actually delete or does it just add a tag/switch to say its deleted?
   
}
   