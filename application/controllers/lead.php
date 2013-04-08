<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contactaction') ) get_bespoke_controller();  //yup = go get it.
else
{   //nope? Use this default class then
    class Lead extends CRM_Controller {

        public $controller_name = 'lead';

        public function __construct()    {
            parent::__construct();
        }

        public function index($view_file = 'index',  $pull = '') {   
            parent::index($view_file);
            $this->_load_view_data();
            
            $this->sort_leads();

              // Generate the view!
            $this->load_view($pull);
            
        }

        public function  view($view_file = 'edit', $rID = 'new', $ContactId, $pull = '') {   
            $this->data['view_setup']['modal'] = TRUE;
            parent::view($view_file, $rID, $ContactId);   

            $this->_load_view_data($rID);    //retrieves and process all data for view    
                // Generate the view!
            $this->load_view($pull);
            }

        public function add($view_file, $rID, $ContactId) {       
            //clean input
            $input = clean_data($this->input->post());
            //$input['ContactID'] = $ContactId; //GOTCHA: the ID is capitalised

            //save record
            $rID = $this->add_record($input, $rID);

            $url = $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId;

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

              //refresh page
              //redirect($this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId );

          }

          public function delete_record($ContactId, $id) {
              parent::delete_record($id);
              $url = 'contact/view/edit/' . $ContactId . '/' . $ContactId . '/0';
              redirect ( $url );
          }
          
          
          public function sort_leads () {
                $retval = array();
                foreach ($this->data['view_setup']['tables']['leads']['table_data'] as $key => $array)
                {            
                    if ($array['__LeadType']) $retval[$array['__LeadType']][] = $array;
                }
                
                $this->data['view_setup']['tables']['leads_by_type'] = $retval;
          }
          
          
      /*public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE) {          
            parent::view($view_file, $rID, $ContactId);
                // Generate the view!
            $this->_generate_view($this->data);
        }*/

    }
}
