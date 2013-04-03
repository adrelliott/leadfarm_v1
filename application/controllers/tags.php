<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Tags') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
  
    class Tags extends CRM_Controller {

        public $controller_name = 'tags';

        public function __construct()    {
            parent::__construct();
        }


        public function view($view_file = 'view', $rID = 'new') {          
            $this->data['view_setup']['modal'] = TRUE;
           parent::view($view_file, $rID);   

            $this->_load_view_data($rID);    //retrieves and process all data for view    
                // Generate the view!
            $this->_generate_view($this->data);
        }

        public function add($view_file, $rID) {       
            //clean input
            $input = clean_data($this->input->post());

            //save record
            $rID = $this->add_record($input, $rID);
            //refresh page
            redirect( $this->controller_name . '/view/' . $view_file . '/' . $rID );

        }
        
        
    }
}
   