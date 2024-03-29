<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Campaign') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
  
    class Campaign extends CRM_Controller {
        
        public $controller_name = 'campaign';

        public function __construct()    {
             parent::__construct();
        }

      public function index($view_file = 'index') {   
            parent::index($view_file);
        
            $this->_load_view_data();   //retrieves and process all data for view        
            $this->_generate_view($this->data);
       }

        public function view($view_file, $rID, $pull = '') {  
            parent::view($view_file, $rID);   

            $this->_load_view_data($rID);    //retrieves and process all data for view            

            $this->load_view($pull);
        }
        
         public function add($view_file, $rID) {

        //clean input
        $input = clean_data($this->input->post());
        
        //save record
        $campId = $this->add_record($input, $rID);
        $url = site_url ($this->controller_name . '/view/edit/' . $campId );

        if ($this->input->is_ajax_request ()) {
            $response = array (
                'success' => true,
            );

            if ($rID === 'new') {
                $response['redirect'] = $url;
            }

            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($response));
            return;
        }

        //refresh page
        redirect($url);
       
    }


       /*
      public function view($view_file = 'edit', $rID) {  
            parent::view($view_file, $rID);

              // Generate the view!
            $this->_generate_view($this->data);
        }
        */



    }
}
   