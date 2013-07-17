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
    
    public $fields_to_replace = array(
        'FirstName', 'LastName', 'NickName', 'Email'
    );

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler();
        $this->load->helper('step');
    }

    public function index($view_file = 'index') {
        redirect(site_url('campaign'));
    }

    public function view($view_file, $rID = 'new', $step_no = 1, $pull = '') {
        $_SESSION['step']['current'] = $step_no;
        //if (! element('step', $_SESSION, FALSE)) $_SESSION['step']['current'] = 1;
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
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "650px", //Setting a custom width
                'height' => '400px', //Setting a custom height
                //'toolbar' => "Simple",
                
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
    
    
    public function load_template($view_file, $rID = 'new') {
        //load the template;
        
        $this->view($view_file, $rID);
        
    }
    
   

    

    public function add($view_file, $rID = 'new', $step_no = FALSE) {
        //if ($step_no) $_SESSION['step']['current'] = $step_no;
        //clean input
        $input = clean_data($this->input->post());
        //save record
        $Id = $this->add_record($input, $rID);
        $url = site_url ($this->controller_name . '/view/' . $view_file . '/' . $Id . '/' . $step_no);

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
    
    public function send($action, $view_file, $rID) {
        $this->load->library('postageapp');
        $this->load->model('broadcast_model');
        $retval = array();
        
        //Retrive template Id details
        $template_data = $this->broadcast_model->get($rID);
        //print_array($template_data);
        
        //Set up basic PA configs
        $this->postageapp->from($template_data['From_email']);
        $this->postageapp->subject($template_data['Subject']);
        $this->postageapp->template($template_data['PA_TemplateName']);
        $this->postageapp->message($template_data['Content']);
        
        
        //now find all merge fields and remove if they;re not approved merge fields
         $message = preg_replace_callback(
                 '/\{\{(.*)\}\}/', //find words with double curly brackets
                 array($this, 'replace_placeholders'), 
                 $template_data['Content']
                 );
         
         //echo "<hr/>" . $message . "<Hr/>";die();
         $this->postageapp->message($message);
        
        //Now set up recipients
        switch ($action) 
        {
            case 'test':
                $recipients = clean_data($this->input->post());
                $recipients = array (
                    $recipients['Email'] => array ('firstname' => $recipients['FirstName'])
                );
                //print_array($recipients);
                $this->postageapp->to($recipients);
                
                
                break;
            case 'actual':
                //get reciptions
                $this->load->model('Saved_search_model', 'recipients');
                $saved_search = $this->recipients->get_by('Id', $template_data['SavedSearchId']);
                $recip = $this->db->query($saved_search[0]['Query']);
                
                if ($recip->num_rows() > 0)
                {
                   $arr = array();
                    foreach ($recip->result() as $row)
                   {
                      if ($row->Email)
                      {
                          $arr[$row->Email] = array(
                                'firstname' => $row->FirstName,
                                'lastname' => $row->LastName,
                                    );
                      }
                            
                   }
                }
                
         //uncomment me to test!
                //$this->postageapp->to($arr);
                
                print_array($arr, 1);
                $this->postageapp->to(array(
                    'al@dallasmatthews.co.uk' => array('firstname' => 'Al1',
                                                      'lastname' => 'Elliott1'),
                    'al2@dallasmatthews.co.uk' => array('firstname' => 'Al2',
                                                      'lastname' => 'Elliott2'),
                    //'al3@dallasmatthews.co.uk' => array('FirstName' => 'Al3',
                     //                                 'LastName' => 'Elliott3'),
                  ));
                //prepare the array for PostageApp
                
                //
                //$input = $this->_prepare_postageapp($rID);
                

            default:
                break;
        }
        $this->data['postageapp'] = $this->postageapp->send();
        //print_array($this->postageapp);
        
        /*if ($this->data['postageapp']['response']['status'] === 'ok' )
        {
            $this->data['view_setup']['message'] = '<span class="notification done">Emails sent!</span>';
        }
        elseif ($this->data['postageapp']['response']['status'] === 'bad_request')
        {
            $response =  $this->data['postageapp']['response']['message'];
            $this->data['view_setup']['message'] = '<span class="notification undone">There was a problem sending your email: <br/><code>' . $response . '</code></span>';
        }*/
        
        $url = site_url ($this->controller_name . '/view/' . $view_file . '/' . $rID . '/2');
        redirect($url);
    }
    
    function replace_placeholders($match){
        $merge_fields = array('firstname', 'lastname', 'nickname');
        if (in_array(strtolower($match[1]), $merge_fields)) return strtolower($match[0]);
        else return '';
    }
    
    function get_recipients($saved_search_id) {
        //Get the data
        $this->load->model('saved_search_model');
        $data = $this->saved_search_model->do_search($saved_search_id);
        
        //turninot a PostageApp data array
        foreach ($data as $id => $array)
        {
            $retval[$data['Email']] = $array;
        }
        
        
        
        
    }
    
    
    function prep_recipients($data) {
        $this->load->model('saved_search_model');
        return $this->saved_search_model->do_search($saved_search_id);
    }
    
   /* function prep_recip_data($recip_data, $fields) {
        //set the fields we can use
        
       
        //now find any woird that fist this pattern and remove the curly brackets {{word}}
        $content = preg_replace_callback('/\{\{(.*)\}\}/', $this->replace_placeholders, $content);
        
        //now cycle through and create a Postage App friendly array
        
        //fubally return the array
    }
    
    function replace_placeholders($match) {
       
        $field_list = array(
            'FirstName', 'LastName', 'Email'
        );
        
        if (isset($data[$match[1]])) {  
        // return the replacement string  
        return $match[1];  
        } else {  
            return 'NOTFOUND';  
        }  
    }
    */
    
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

function replace_placeholders($match){
        $merge_fields = array('FirstName', 'LastName', 'Nickname');
        if (in_array($match[1], $merge_fields)) return $match[0];
        else return '';
    }


}


/* End of file broadcast.php */
/* Location: ./application/controllers/XXXXXXXXXXXXXXXXXXXX/broadcast.php */