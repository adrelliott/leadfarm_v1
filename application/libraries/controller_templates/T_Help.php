<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Help extends MY_Controller {

    public $controller_name = 'help';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
       //never calling this with an index. Unless... do we need an error page?
    }
   
    public function view($view_file, $rID = 'new') {    
        $this->data['view_setup']['view_file'] = 'v_help_' . $view_file;
        $this->data['controller_setup']['method_name'] = 'view';
        $this->data['view_setup']['modal'] = TRUE;
        $this->data['view_setup']['header_file'] = 'header_modal'; 
        $this->data['view_setup']['footer_file'] = 'footer_modal'; 
        
        //Grab the url of the page with the problem
        if ($view_file == 'edit')
        {
            $url = explode('___', $this->uri->uri_string());
            $this->data['view_setup']['temp']['lastpage'] = site_url($url[1]);
        }
        
        $this->_load_view_data($rID);    //retrieves and process all data for view    
    }
   
   
    public function add($view_file) {     
        //print_array($this->input->post(), 1);

        //compile email
        $to = 'support.4097.de31af2e7f810054@helpscout.net';
        $from = $this->input->post('from');
        $name = $this->input->post('name');
        $subject = '[SUPPORT] ' . $this->input->post('problem') . ' (' . date("m-d-y") . ')';
        $message = '**ORIGINAL MESSAGE: ' . $this->input->post('indepth') . '**';
        $message .= '[INFO: This user was on this page:' . $this->input->post('url') . ' and ' . $this->input->post('problem') . '. They have asked us to reply via ' . $this->input->post('response') . ' (Tel no is ' . $this->input->post('phone') . ' if we need it.]';
        
        //send email
        $this->load->library('email');
        $this->email->from($from, $name);
        $this->email->to($to); 
        $this->email->subject($subject);
        $this->email->message($message);	

        $this->email->send();   //do some testing to make sure it was sent?
        
        //refresh page
        redirect(DATAOWNER_ID . '/' . $this->controller_name . '/view/' . $view_file );
       
    }
   
}
   