<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contactjoin') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then  

    class Contactjoin extends MY_Controller {
        
        public $controller_name = 'contactjoin';
        
        public function __construct()    {
            parent::__construct();
        }

      public function index() {     
           //parent::index();

            // Generate the view!        
           //$this->_generate_view($this->data);
       }

      public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE) {    
            $this->data['view_setup']['modal'] = TRUE;
            parent::view($view_file);
            $this->data['view_setup']['rID'] = $rID;
            $this->data['view_setup']['ContactId'] = $ContactId;   //in this context, $rID == ContactId
            $this->data['view_setup']['display_none'] = '';

            $this->_load_view_data($rID); 

            // Generate the view!        
           $this->_generate_view($this->data);

      }
      
       public function add($view_file, $rID, $ContactId) {       
            //clean input
            $input = clean_data($this->input->post());
            $input['__ContactId'] = $ContactId;

            //print_array($input, 1, 'iunput');

            //save record
            $rID = $this->add_record($input, $rID);

            //refresh page
            redirect( $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId );

        }


    }
}
   