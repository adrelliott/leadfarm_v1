<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Template extends MY_Controller {

    public $controller_name = 'template';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
       //never calling this with an index. Unless... do we need an error page?
    }
   
    public function view($view_file, $rID) {    //$rID=new => create new record
        $this->data['view_setup']['view_file'] = 'v_template_' . $view_file;
        $this->data['controller_setup']['method_name'] = 'view';
        $this->data['view_setup']['modal'] = TRUE;
        $this->data['view_setup']['header_file'] = 'header_modal'; 
        $this->data['view_setup']['footer_file'] = 'footer_modal'; 
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['display_none'] = '';
        
        $this->_load_view_data($rID);    //retrieves and process all data for view    
    }
   
   
    public function add($view_file, $rID) {   
        //clean input
        $input = clean_data($this->input->post());    
        
        //save record
        $rID = $this->add_record($input, $rID);
        
        //send test email
        if ($this->input->post('submit') == 'Send Test Email') $this->_test_send($rID);
       
        //refresh page
         else redirect(DATAOWNER_ID . '/' . $this->controller_name . '/view/' . $view_file . '/' . $rID );
       
    }
    
    private function _test_send($rID) {        
        //Load the PostageApp library
        $this->load->library('PostageApp/postageapp');
        
        //now get the template info required
        $this->load->model('template_model', 'template');
        $results = $this->template->get($rID);
        print_array($results, 0, 'template');
        extract($results);  //we can use the array as $vars
        
        //Prepare the query based on the fields in the subject and body
        $content_fields = array();
        $subject_fields = array();
        $query = array();
        preg_match_all('/\{{([^}]+)\}}/', $__Content, $content_fields);
        preg_match_all('/\{{([^}]+)\}}/', $__Subject, $subject_fields);
        $content_fields = $content_fields[1];
        $subject_fields = $subject_fields[1];
        
        //print_array($content_fields, 0, 'content');
        //print_array($subject_fields, 0, '$subject_fields');

//remove all caps in each of these
        foreach ($content_fields as $k => $field) $content_fields[$k] = strtolower($field);
        foreach ($subject_fields as $k => $field) $subject_fields[$k] = strtolower($field);
        
        print_array($content_fields, 0, 'content LOWER');
        print_array($subject_fields, 0, '$subject_fields LOWER');
        
        //Now create an array of sorted queries for the query
        foreach ($subject_fields as $k => $v) { if ( ! in_array($v, $content_fields)) $content_fields[] = $v; }
        
        //De-dup
        $content_fields = array_unique($content_fields);
        
        //sort into assoc array of fields
        foreach ($content_fields as $k => $v)
        {
            $temp = explode('.', trim($v));
            $query[$temp[0]][] = $temp[1];
        }
        
        //Make sure we are getting the email/twitter/letter field (required to send)
        if ( !isset($query['Contact']) )
        {
            $query['Contact'][] = 'Email';
        }
        elseif ( !in_array('Email', $query['Contact']) )
        {
            $query['Contact'][] = 'Email';
        }
        
        //now get the people to send this too
        $recipients = array();
        if (is_array($this->input->post('_:_contactId'))) $recipients = $this->input->post('_:_contactId');        
        else $recipients = array($this->session->userdata('UserId'));
            
        //Now get these fields from the contactId's passed in the $_POST
        $results = Array();
        foreach ($query as $table => $cols)
        {
            $this->load->model($table . '_model', $table);
            $results[$table] = $this->$table->get_email_fields($recipients, $cols); 
        }
        
        print_array($results, 0, 'this is after query');
        
        $this->output->enable_profiler(TRUE);        
        
        //Now prepare the email
        $this->postageapp->from($__FromEmail);
        $this->postageapp->subject($__Subject . ' - '. time());
        $this->postageapp->message($__Content);
        $this->postageapp->template($__TemplateName);
        
        //Add the people
        $this->postageapp->to($results['contact']);
        //now send it!
        $result = $this->postageapp->send();
        
        print_array($result);
        
    }
   
}
   