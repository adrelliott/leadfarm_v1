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
        
        $this->_instantiate_ckeditor();

        $this->_load_view_data($rID);    //retrieves and process all data for view            

        //print_array($this->data, 1);
        $sql = element('value', $this->data['view_setup']['fields']['Sql'], FALSE);
        if ($rID === 'new')
        {
            $_SESSION['step_include'] = 1;
        }
        elseif($sql) $this->search($sql);
        //else $_SESSION['step_include'] = 1;
        $this->load_view($pull);
    }
    
    
    private function _instantiate_ckeditor() {
        $this->load->helper('ckeditor');
        
        //Ckeditor's configuration
        $this->data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'write_email',
            'path' => '',
            //Optional values
            'config' => array(
                //'toolbar' => "Full", //Using the Full toolbar
                'width' => "650px", //Setting a custom width
                'height' => '400px', //Setting a custom height
                'toolbar' => "Simple",
                
            ),
            //Replacing styles from the "Styles tool"
            'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array(
                    'name' => 'Blue Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Blue',
                        'font-weight' => 'bold'
                    )
                ),
                //Creating a new style named "style 2"
                'style 2' => array(
                    'name' => 'Red Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Red',
                        'font-weight' => 'bold',
                        'text-decoration' => 'underline'
                    )
                )
            )
        );
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
    
    public function send($action, $rID) {
        $this->load->library('postageapp');
        $this->load->model('broadcast_model');
        $retval = array();
        
        //Retrive template Id details
        $template_data = $this->broadcast_model->get($rID);
        print_array($template_data);
        //Set up basic PA configs
        $this->postageapp->from($template_data['From_email']);
        $this->postageapp->subject($template_data['Subject']);
        $this->postageapp->template($template_data['PA_TemplateName']);
        $this->postageapp->message($template_data['Content']);
        //$this->postageapp->message(array(
          //  'text/html'   => $template_data['Content'],
            //'text/plain'  => 'text content'
          //));
        
        //Now set up recipients
        switch ($action) 
        {
            case 'test':
                $recipients = clean_data($this->input->post());
                print_array($recipients);
                $this->postageapp->to(array($recipients['Email']));
                
                $retval['reponse'] = $this->postageapp->send();
                break;
            case 'actual':
                //prepare the array for PostageApp
                //$input = $this->_prepare_postageapp($rID);
                $this->postageapp->to(array(
                    $recipients['Email'] => array('variable1' => 'value',
                                                      'variable2' => 'value'),
                    'recipient2@example.com' => array('variable1' => 'value',
                                                      'variable2' => 'value')
                  ));
                //Send it to postageApp

            default:
                break;
        }
        
        print_array($retval);
        
        return;
    }
    
    /* @var $array Broadcast */

    private function _prepare_postageapp($template_id) {
        $retval = array();
        
        //Retrive template Id details
        $this->load->model('broadcast_model');
        $template_data = $this->broadcast_model->get($template_id);
        print_array($template_data);
        
        //do the search for recipients and store the returned array
        $this->load->model('search_model');
        $recipients = $this->search_model->search($template_data['Sql']);
        $recipients = $recipients['table_data'];
        
        $retval['from'] = $template_data['From_name'];
        //$retval['from'] = $template_data['From_email'];
        
        
        print_array($recipients,1);
        //set up the PostageApp array

        return $retval;
    }
    
    
}



}


/* End of file broadcast.php */
/* Location: ./application/controllers/XXXXXXXXXXXXXXXXXXXX/broadcast.php */