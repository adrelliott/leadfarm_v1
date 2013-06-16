<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Campaign') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
  
    class Broadcast extends CRM_Controller {
        
        public $controller_name = 'broadcast';
        private $step_progress = array (
            1 => ' style="display:none" ',
            2 => ' style="display:none" ',
            3 => ' style="display:none" ',
        );
        

        public function __construct()    {
             parent::__construct();
             $this->output->enable_profiler();
        }

      public function index($view_file = 'index') {   
            redirect(site_url('campaign'));
       }

        public function view($view_file, $rID = 'new', $pull = '') {  
            if ($rID === 'new') $this->_step_progress(1);
            
            parent::view($view_file, $rID);   

            $this->_load_view_data($rID);    //retrieves and process all data for view            

            $this->load_view($pull);
        }
        
         public function add($view_file, $rID) {

        //clean input
        $input = clean_data($this->input->post());
        
        //save record
        $Id = $this->add_record($input, $rID);
        $url = site_url ($this->controller_name . '/view/' . $view_file . '/' . $Id . '?s2' );

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
    
    function load_saved_search() {
        print_array($this->input->post());
        
        $this->load->model('search_criteria_model');
        $results = $this->search_criteria_model->get_by(array('SearchId' => $this->input->post('saved_search_id')));
        
        //now do the searches
        
        print_array($results);
    }
    
    function do_saved_search($saved_search_id) {
        //Perform the searches to get the contact details
        $this->load->model('saved_search_model');
        $recipients = $this->saved_search_model->search($saved_search_id);
        
        print_array($recipients);
    }
    
    function search() {
        $this->load->model('search_model');
        $results = $this->search_model->search();
        //print_array($results, 1);
        $this->data['datasets']['search_results'] = $results;
        //what step are we on?
        
        $this->view('edit/new');
       
       
    }
    
    private function _step_progress($step_no) {
        $this->step_progress[$step_no] = '';
        $this->session->set_userdata(array('step' => $this->step_progress));
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
   