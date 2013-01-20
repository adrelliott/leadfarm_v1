<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Contact extends MY_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */
    public $controller_name = 'contact';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
  public function index() {
       $this->data['controller_setup']['method_name'] = 'index';
       parent::index();
   }
   
  public function view($rID, $ContactId = NULL) {    //false = create new record
       $this->data['controller_setup']['method_name'] = 'view';
       $this->data['view_setup']['header_file'] .= '';  //add '_modal' for modal
       $this->data['view_setup']['footer_file'] .= '';  //add '_modal' for modal       
       $this->data['view_setup']['rID'] = $rID;
       $this->data['view_setup']['ContactId'] = $rID;   //in this context, $rID == ContactId
       $this->data['view_setup']['display_none'] = '';
       $fieldset = 'v_contact_individual';
       if ($rID == 'org') {$fieldset = 'v_contact_organisation'; }           
       parent::view($rID, $fieldset);
       
  }
       
     
  public function add($rID, $ContactId = NULL) {    //false = create new record
       $this->data['controller_setup']['method_name'] = 'view';
       $this->data['view_setup']['header_file'] .= '';  //add '_modal' for modal
       $this->data['view_setup']['footer_file'] .= '';  //add '_modal' for modal       
       $this->data['view_setup']['rID'] = $rID;
       $this->data['view_setup']['ContactId'] = $rID;   //in this context, $rID == ContactId
       $this->data['view_setup']['display_none'] = '';
       
       //clean the input
       $input = clean_data($this->input->post()); 
       
       $this->load->model('contact_model');
       $rID = $this->contact_model->add($input, $rID);
       $fieldset = 'v_contact_individual';
       if ($rID == 'org') {$fieldset = 'v_contact_organisation'; }           
       //parent::add($rID, $fieldset);
       redirect(DATAOWNER_ID . '/contact/view/edit/' . $rID);
       
   }
  public function append_note($rID, $ContactId = NULL) {    //false = create new record
       $this->data['controller_setup']['method_name'] = 'view';      
       $this->data['view_setup']['rID'] = $rID;
       $this->data['view_setup']['ContactId'] = $rID;   //in this context, $rID == ContactId
       $message = 'Notes Updated!';
       
       //Now clean up the input array
       $input = clean_data($this->input->post()); 
       
       //print_array($input);

       //Concatenate the new note ready for updating
       $input['ContactNotes'] .= "\n:::: On " . date('d-m-Y H:i') . ', ';
       $input['ContactNotes'] .= $this->session->userdata('FirstName') . ' ' . $this->session->userdata('LastName');
       $input['ContactNotes'] .= " wrote:::: \n";
       $input['ContactNotes'] .= $input['add_a_note'];  //add the new note details
       unset($input['add_a_note']);
              
       //Now update the record
       $this->load->model('contact_model');
       $this->db->from('Contact');
       $rID = $this->contact_model->save($input, $rID);
       
       //Refresh view
       $this->session->set_flashdata('message', $message);
       redirect(DATAOWNER_ID . '/contact/view/edit/' . $rID);
       
       //this whole method needs rewriting - its ugly!
       
   }
   
}
   