<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Comms') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
  
    class Comms extends MY_Controller {

        public $controller_name = 'comms';

        public function __construct()    {
            parent::__construct();
        }

        public function index() {     
            //parent::index();
            //$this->_load_view_data();
            //$this->_generate_view($this->data);
        }

        public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE, $pull = '') {
            $this->data['view_setup']['modal'] = TRUE;      
            parent::view($view_file, $rID, $ContactId);

            $this->_load_view_data($rID);     //retrieves and process all data for view 

            $this->load_view($pull);
        }

        public function add($view_file, $rID, $ContactId) {       
            //clean input
            $input = clean_data($this->input->post());
            $input['__ContactId'] = $ContactId;

            //save record
            $rID = $this->add_record($input, $rID);
            $url = site_url ($this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId);

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
            
            
            /*if(strpos($view_file, '_modal') === FALSE)
            {
                redirect($url);
            }
            else
            {
                $this->view_modal($view_file, $rID, $ContactId);
            }*/

        }


    }
}
   