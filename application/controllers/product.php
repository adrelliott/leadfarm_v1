<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Links') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
  
    class Product extends CRM_Controller {

        public $controller_name = 'product';

        public function __construct()    {
            parent::__construct();
        }

 public function ajax_products($param = FALSE) {
                $this->load->model('product_model');
                $results = $this->product_model->get_products($param);
                echo json_encode($results);
                
            }
        public function view($view_file = 'edit', $rID = 'new', $pull = '') {          
            $this->data['view_setup']['modal'] = TRUE;
            parent::view($view_file, $rID);   

            $this->_load_view_data($rID);    //retrieves and process all data for view    
                // Generate the view!
            $this->load_view($pull);
        }

        public function add($view_file, $rID) {       
          //clean input
          $input = clean_data($this->input->post());

          //save record
          $rID = $this->add_record($input, $rID);
          
         
          
          $url = $this->controller_name . '/view/' . $view_file . '/' . $rID;
          
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
        
         public function delete_record($id) {
              parent::delete_record($id, 'Id');
              $url = 'settings';
              redirect ( $url );
          }

    }
}
   