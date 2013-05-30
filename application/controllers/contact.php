<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contact') ) get_bespoke_controller();  //yup = go get it.
else
{   //nope? Use this default class then
    
    class Contact extends CRM_Controller {
        
        public $controller_name = 'contact';

        public function __construct()    {
             parent::__construct();
        }

        public function index() {   
            parent::index();
            $this->_load_view_data();
            $this->_generate_view($this->data);
        }
        
        public function view($view_file, $rID, $ContactId = FALSE, $fieldset = 0, $pull = '') {
            if( ! $ContactId ) //Allows us just to pass contact ID
            {
                redirect( site_url ("contact/view/$view_file/$rID/$rID/$fieldset") ); 
                return;
            }
            
            parent::view($view_file, $rID, $ContactId);   
            
            //What record fieldset do we show? Org, ind or unknown?
            $this->data['view_setup']['fieldset'] = $fieldset;
        
            $this->_load_view_data($rID);
            
            //check for expirations of MOT & service
            $this->load->library('garages/garage');
            
            $this->data['view_setup']['notifications'] = array();
            if (isset($this->data['view_setup']['tables']['vehicles']['table_data'][0]))
            {
                $this->data['view_setup']['notifications'] = 
                        $this->garage->check_vehicle_expiry 
                        (
                        $this->data['view_setup']['tables']['vehicles'],
                        $this->data['view_setup']['ContactId']
                        );
            }

            
            $this->load_view($pull);
        }
        
        public function add($view_file, $rID, $ContactId, $fieldset) {
            //clean input
            $input = clean_data($this->input->post());
            
            //save record
            $rID = $this->add_record($input, $rID);
            
             //Have we set nay client-specific methods to run?
            $method_name = 'add_' . DATAOWNER_ID;
            if (method_exists($this, $method_name)) $this->$method_name($input, $rID);
            
            $url = site_url ($this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $rID . '/' . $input['_IsOrganisationYN']);

            if ($this->input->is_ajax_request ()) {
                $response = array (
                    'success' => true,
                );

                if ($ContactId === 'new') {
                   $response['redirect'] = $url;
                }

                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($response));
                return;
            }

            //refresh page
            redirect($url);

        }
        
        //Post process data for the view? put it here:
        /*public function post_process_contact() {
            
        }*/
        
        public function append_note($view_file, $rID, $ContactId, $fieldset) {
            //Concatenate the new note ready for updating
            $input = clean_data($this->input->post()); 
            $input['ContactNotes'] .= "\n:::: On " . date('d-m-Y H:i') . ', ' . 
                    $this->session->userdata('FirstName') . ' ' . 
                    $this->session->userdata('LastName') . " wrote:::: \n" . 
                    $input['add_a_note'];  //add the new note details
            unset($input['add_a_note']); //tidy up        

            //save record
            $this->add_record($input, $rID);

            if ($this->input->is_ajax_request()) {
                $response = array(
                    'success' => true,
                    'data' => array ('ContactNotes' => $input['ContactNotes'])
                );
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($response));
                return;
            }

            //refresh page
            redirect( $this->controller_name . '/view/edit/' . $rID . '/' . $ContactId . '/' . $fieldset );

        }
        
        public function delete_record($id = FALSE) {
            //$this->load->model($method_name . '_model', 'contact');
            parent::delete_record($id);
            
            redirect( site_url( '/contact' ));          
        }
        
        /*public function add_22232($input, $rID) {
            //if memberhsip number is blank, then
            if ( $input['_LegacyMembershipNo'] == NULL )
            {
                $input['_LegacyMembershipNo'] = $rID + 50000;
            }
            $this->add_record($input, $rID);
        }*/
        
        function test1($ContactId) {
            //get maximum memberhsip number 
            $this->load->model('contact_model');
            $max_memb_no = $this->contact_model->get_max('_LegacyMembershipNo');
          
            //Now get this contact\s memberhsip number
            $contact_record = $this->contact_model->get($ContactId);
            $current_memb_no = $contact_record['_LegacyMembershipNo'];
            if (  is_null($current_memb_no) || $current_memb_no < 1 )
            {
                $new_member_no = array('_LegacyMembershipNo' => $max_memb_no + 1);
                $r = $this->contact_model->save($new_member_no, $ContactId);
            }
            
        }
        
        
        public function ajax_feed  () {
            //load the model & run the method
            $this->load->model('contact_model');
            $output = $this->contact_model->get_data_via_ajax_non_codeigniter();
            //$output = $this->contact_model->get_data_via_ajax_codeigniter();
            
            //output the results as JSON
            echo json_encode( $output );
        }
        
        public function dropdown_ajax_feed() {
            $r = array
                (
                    "al Elliott","lea Elliott","charlie Elliott"
                );
            
            echo json_encode($r);
        }
        
        
        
        
        
        
        
        public function ajax_feed_old($method_name = 'index', $dataset_name = 'contacts') {
            //what fields do we need?
            $config = $this->data['config']['datasets'][$method_name][$dataset_name];
            $fields = $this->_generate_table_headings($config['fields']);
            
            //Whats database settings?
            $this->load->database();
            $conn = array
            (
                'user' => $this->db->username,
                'password' => $this->db->password,
                'db' => $this->db->database,
                'server' => $this->db->hostname,
            );
            
            //Output
            echo generate_ajax_results(array_keys($fields), $conn);
            
        }
        
        public function search($post_process = NULL) {
            $this->load->model('search_model');
            $this->data['tables']['search_results']['table_headers'] = array();
            parent::search();
            
            if ($this->input->post('_::_submit'))
            {
                
            //print_array($this->input->post(), 1);
                //if ($this->input->post('_::_export') == 1) $export = TRUE;
                    //print_array( $this->data['tables']['search_results']['csv_file'] , 1, 'normal search results');
                if ($post_process === 'export')
                {
                    $this->load->helper('download');
                    //$csv = $this->data['tables']['search_results']['csv_file'];
                    $csv = $this->search_model->do_search(TRUE);
                    $name = "csv_export.csv";
                    //print_array( $this->data['tables']['search_results']['csv_file'] , 1);
                    force_download($name, $csv);
                    //return;
                }
                else $this->data['tables']['search_results'] = $this->search_model->do_search();
                
                $this->data['tables']['search_results']['post_data'] = $this->input->post();
            }
            //else
            {
            
            $this->_load_view_data();
            $this->_generate_view($this->data);
            }
            //Make sure we store the query somewhere ready to save as a saved search
            
        }
    }
}   