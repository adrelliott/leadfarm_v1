<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quickaction extends T_Quickaction {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */

    public function __construct()    {
         parent::__construct();
    }
    
    public function index() {  
       exit;
    }
    
    function view($view_file = 'edit', $rID) {
        parent::view($view_file, $rID);
        
         // Generate the view!        
       $this->_generate_view($this->data);
    }
   
    function action($view, $rID, $ContactId, $ActionId) {
        echo "action id is $ActionId";
        
        //retrieve the details from ther Quickaction table
            //get the record
            //set up the view
        //get the template required
            //apply a tag
            //send an email (choose_template($templateID) { load->view etc)
            
        
        $this->data['view_setup']['action_template'] = '';  //EMAIL
        
        
    }
    
    /*function send_email($view, $rID, $ContactId)
    
        //Load the PostageApp library
        $this->load->library('PostageApp/postageapp');        
        
        //now get the template info required
        $this->load->model('template_model', 'template');
        $template = $this->template->get($rID);
        $template = $this->postageapp->prepare_template($template);  
                
        //now get the people for the email
        $recipients = array();
        if (is_array($this->input->post('_:_contactId'))) $recipients = $this->input->post('_:_contactId');        
        else $recipients = array($this->session->userdata('UserId'));
        
        $query = $template['postageapp_merge_fields'];  //this is the fields list
        $this->load->model('contact_model', 'contact');
        $results = $this->contact->get_email_fields($recipients, $query['Contact']);
        
        //Now prepare the email
        extract($template);
        $this->postageapp->from($__FromEmail);
        $this->postageapp->subject($__Subject); 
        $this->postageapp->template($__TemplateName);
        
        //add unsubscribe to both HTML and plaintext templates
        $__Content = $this->postageapp->add_unsubscribe($__Content);
        $__ContentPlaintext = $this->postageapp->add_unsubscribe($__ContentPlaintext);
        
        //Define the message
        $this->postageapp->message(array
        (
            'text/html'   => $__Content, 
            'text/plain'  => $__ContentPlaintext
        ));
        
        //Add the people
        $this->postageapp->to($results);
        
        //now send it!
        $result = $this->postageapp->send();
   */
   
}
   