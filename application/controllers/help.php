<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Help') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then  
    
    class Help extends CRM_Controller {
        public $controller_name = 'help';

        public function __construct()    {
            parent::__construct();
        }


      public function view($view_file = 'edit', $rID = 'new') {          
            $this->data['view_setup']['modal'] = TRUE;
            parent::view($view_file, $rID);   

            //Grab the url of the page with the problem
            if ($view_file == 'edit')
            {
                $url = explode('___', $this->uri->uri_string());
                $this->data['view_setup']['temp']['lastpage'] = site_url($url[1]);
            }

            $this->_load_view_data($rID);    //retrieves and process all data for view    
                // Generate the view!
            $this->_generate_view($this->data);
        }

        public function add($view_file) {     
            //print_array($this->input->post(), 1);

            //compile email
            $to = 'support.4097.de31af2e7f810054@helpscout.net';
            $from = $this->input->post('from');
            $name = $this->input->post('name');
            $subject = '[SUPPORT] ' . $this->input->post('problem') . ' (' . date("m-d-y") . ')';
            $message = $this->input->post('indepth') . "\n\n";
            $message .= '[INFO: This user was on this page: ' . $this->input->post('url') . "\n and " . $this->input->post('problem') . '. They have asked us to reply via ' . $this->input->post('response') . ' (Tel no is ' . $this->input->post('phone') . ' if we need it).]';

            //send email
            $this->load->library('email');
            $this->email->from($from, $name);
            $this->email->to($to); 
            $this->email->subject($subject);
            $this->email->message($message);	

            $this->email->send();   //do some testing to make sure it was sent?

            //refresh page
            redirect($this->controller_name . '/view/' . $view_file );

        }   

    }
   
}
   