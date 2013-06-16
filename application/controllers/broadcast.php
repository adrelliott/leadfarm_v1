<?php

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Campaign') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller - broadcast
 * @author Al Elliott
 * 
 * 
 * 
 */
class Broadcast extends CRM_Controller {

    public $controller_name = 'broadcast';

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler();
        $this->load->helper('step');
    }

    public function index($view_file = 'index') {
        redirect(site_url('campaign'));
    }

    public function view($view_file, $rID = 'new', $pull = '') {
        parent::view($view_file, $rID);

        $this->_load_view_data($rID);    //retrieves and process all data for view            

        //print_array($this->data, 1);
        $sql = element('value', $this->data['view_setup']['fields']['Sql'], FALSE);
        if ($rID !== 'new' && $sql)
        {
            $this->search($sql);
        }
        //else $_SESSION['step_include'] = 1;
        $this->load_view($pull);
    }
    
    public function add($view_file, $rID = 'new') {

        //clean input
        $input = clean_data($this->input->post());
        
        //save record
        $Id = $this->add_record($input, $rID);
        $url = site_url ($this->controller_name . '/view/' . $view_file . '/' . $Id );

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
    
    function advance_step($step_number, $view_file, $rID) {
        $_SESSION['step_include'] = $step_number;
        redirect(site_url("broadcast/view/$view_file/$rID"));
    }
    
    function search($sql = FALSE) {
        $this->load->model('search_model');
        $results = $this->search_model->search($sql);
        $this->data['view_setup']['tables']['recipients'] = $results;
        if ($sql) return;
        $this->view('edit');
    }
    
}



}


/* End of file broadcast.php */
/* Location: ./application/controllers/XXXXXXXXXXXXXXXXXXXX/broadcast.php */