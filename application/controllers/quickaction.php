<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Quickaction') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
  
    class Quickaction extends CRM_Controller {

        public $controller_name = 'quickaction';

        public function __construct()    {
             parent::__construct();
        }

        public function index() {  
           exit;
        }

        function view($view_file = 'edit', $rID, $ContactId = NULL) {
            $this->data['view_setup']['modal'] = TRUE;
            parent::view($view_file, $rID, $ContactId);   

            $this->_load_view_data($rID);    //retrieves and process all data for view    

             // Generate the view!        
            $this->_generate_view($this->data);
        }

        function action($view, $rID, $ContactId, $ActionId) {
            echo "action id is $ActionId";

            //retrieve the details from ther Quickaction table
                //get the record
                //set up the view
            //get the template required
                //apply a tag
                //send an email (choose_template($templateID) { load->view etc)


            $this->data['view_setup']['action_template'] = '';  //EMAIL


        }

        public function add($view_file, $rID) {   
            //clean input
            $input = clean_data($this->input->post());    

            //save record
            $rID = $this->add_record($input, $rID);

            //send test email
            if ($this->input->post('submit') == 'Send Test Email') $this->_test_send($rID);
           //else
             //refresh page
            redirect( $this->controller_name . '/view/' . $view_file . '/' . $rID );

        }

        private function _test_send($rID) {  
            //Load the PostageApp library
            $this->load->library('PostageApp/PostageApp');        

            //now get the template info required
            $this->load->model('template_model', 'template');
            $template = $this->template->get($rID);
            $template = $this->postageapp->prepare_template($template);  

            //now get the people for the email
            $recipients = array();
            if (is_array($this->input->post('_:_contactId'))) $recipients = $this->input->post('_:_contactId');        
            else $recipients = array($this->session->userdata('UserId'));

            $query = $template['postageapp_merge_fields'];  //this is the fields list
            //get contacts...
            $this->load->model('contact_model', 'contact');
            $results = $this->contact->get_email_fields($recipients, $query['Contact']);

            //get any links...
            if ( isset($query['Link']) )
            {
                //Get the link details
                $this->load->model('links_model', 'links');
                $link_info = $this->links->get_assoc(array_values($query['Link']));

                //Now create the bespoke link for each contact
                foreach ($query['Link'] as $k => $v)
                {
                    foreach ($results as $email => $array)
                    {
                        $link = "gen/redir/url/$v";
                        $link .= '/' . $array['contact.id'];
                        $link = '<a href="' . site_url($link) . '">';
                        $link .= $link_info[$v]['__LinkName'] . '</a>';                    
                            //put back into the contact's array
                        $results[$email][$k] = $link;                    
                    }
                }
            }


            //Now prepare the email
            extract($template);
            $this->postageapp->from($__FromEmail);
            $this->postageapp->subject($__Subject); 
            $this->postageapp->template($__TemplateName);

            //add unsubscribe to both HTML and plaintext templates
            $__Content = $this->postageapp->add_unsubscribe($__Content);
            $__ContentPlaintext = $this->postageapp->add_unsubscribe($__ContentPlaintext);

            //Define the message
            $this->postageapp->message(array
            (
                'text/html'   => $__Content, 
                'text/plain'  => $__ContentPlaintext
            ));

            //Add the people
            $this->postageapp->to($results);

            //now send it!
            $result = $this->postageapp->send();

            //print_array($result);

        }
        private function _test_send_old($rID) {        
            //Load the PostageApp library
            $this->load->library('PostageApp/postageapp');

            //now get the template info required
            $this->load->model('template_model', 'template');
            $results = $this->template->get($rID);

    print_array($results, 0, '<BR/>template');
            extract($results);  //we can use the array as $vars

            //Prepare the query based on the fields in the subject and body
            $content_fields = array();
            $subject_fields = array();
            $query = array();
            preg_match_all('/\{{([^}]+)\}}/', $__Content, $content_fields);
            preg_match_all('/\{{([^}]+)\}}/', $__Subject, $subject_fields);
            $content_fields = $content_fields[1];
            $subject_fields = $subject_fields[1];

            //print_array($content_fields, 0, 'content');
            //print_array($subject_fields, 0, '$subject_fields');

            //remove all caps in each of these
            foreach ($content_fields as $k => $field)
            {
                $lower_case_field = strtolower($field);
                $content_fields[$k] = $lower_case_field;

                //now replace all uppercase fields in template with lowercase
                $__Content = str_replace($field,$lower_case_field,$__Content);            
            }
            foreach ($subject_fields as $k => $field)
            {
                $lower_case_field = strtolower($field);
                $subject_fields[$k] = $lower_case_field;

                //now replace all uppercase fields in template with lowercase
                $__Subject = str_replace($field,$lower_case_field,$__Subject); 
            }

            //Now create an array of sorted queries for the query
            foreach ($subject_fields as $k => $v) { if ( ! in_array($v, $content_fields)) $content_fields[] = $v; }

            //De-dup
            $content_fields = array_unique($content_fields);

            //sort into assoc array of fields
            foreach ($content_fields as $k => $v)
            {
                $temp = explode('.', trim($v));
                $query[$temp[0]][] = $temp[1];
            }

            //Make sure we are getting the email/twitter/letter field (required to send)
            if ( !isset($query['Contact']) )
            {
                $query['Contact'][] = 'Email';
            }
            elseif ( !in_array('Email', $query['Contact']) )
            {
                $query['Contact'][] = 'Email';
            }

            //now get the Id
            if ( !isset($query['contact']['Id']) ) $query['contact'][] = 'Id';

            //now get the people to send this too (this is sent with the $_POST
            $recipients = array();
            if (is_array($this->input->post('_:_contactId'))) $recipients = $this->input->post('_:_contactId');        
            else $recipients = array($this->session->userdata('UserId'));

            //Now get these fields from the contactId's passed in the $_POST
            $results = Array();
            foreach ($query as $table => $cols)
            {
                $this->load->model($table . '_model', $table);
                $results[$table] = $this->$table->get_email_fields($recipients, $cols); 
            }

    print_array($results['contact'], 0, '<BR/>this is after query');

            $this->output->enable_profiler(TRUE);        

            //Now prepare the email
            $this->postageapp->from($__FromEmail);
            $this->postageapp->subject($__Subject); 
            //$this->postageapp->subject($__Subject . ' - '. time()); 
            $this->postageapp->template($__TemplateName);
            $__Content = str_replace('_:_ContactId_:_', '{{contact.id}}', $__Content . UNSUBSCRIBE);
            $__ContentPlaintext = str_replace('_:_ContactId_:_', '{{contact.id}}', $__ContentPlaintext . UNSUBSCRIBE);
            $this->postageapp->message(array
            (
                'text/html'   => $__Content, 
                'text/plain'  => $__ContentPlaintext
            ));

            //Add the people
            $this->postageapp->to($results['contact']);
            //now send it!
            $result = $this->postageapp->send();

            print_array($result);

        }

    }
}
   