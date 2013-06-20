<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contactaction') ) get_bespoke_controller();  //yup = go get it.
else
{   //nope? Use this default class then
    
    class Contactaction extends CRM_Controller {

        public $controller_name = 'contactaction';
        
        public function __construct()    {
            parent::__construct();
        }

        public function index($view_file = 'index') {   
             parent::index($view_file);

               // Generate the view!
             $this->_generate_view($this->data);
         }

        public function  view($view_file = 'edit', $rID = 'new', $ContactId = FALSE, $pull = '') {   
          $this->data['view_setup']['modal'] = TRUE;
          parent::view($view_file, $rID, $ContactId);   

          $this->_load_view_data($rID);    //retrieves and process all data for view    
              // Generate the view!
          $this->load_view($pull);
        }

        public function add($view_file, $rID, $ContactId = FALSE) {       
          //clean input
          $input = clean_data($this->input->post());
           if ($rID === 'new') { 
               $input['ContactId'] = $ContactId;
           }

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
              parent::delete_record($id, 'Id');
              $url = 'contact/view/edit/' . $ContactId . '/' . $ContactId . '/0';
              redirect ( $url );
          }
       


        //function add_booking ($rID, $ContactId, $view_file = 'edit_booking') {
         //   $this->add($rID, $ContactId, $view_file);
       // }



    }
}
   