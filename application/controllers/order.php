<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contactaction') ) get_bespoke_controller();  //yup = go get it.
else
{   //nope? Use this default class then
    class Order extends CRM_Controller {

        public $controller_name = 'order';

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

        //private function _update_memb_number($ContactId) {
         private function _update_memb_number($ContactId) {
            //get maximum memberhsip number 
            $this->load->model('contact_model');
            $max_memb_no = $this->contact_model->get_max('_LegacyMembershipNo');
          
            //Now get this contact\s memberhsip number
            $contact_record = $this->contact_model->get($ContactId);
            $current_memb_no = $contact_record['_LegacyMembershipNo'];
            
            //Now update membership number if contact
            if (  is_null($current_memb_no) || $current_memb_no < 1 )
            {
                $new_member_no = array('_LegacyMembershipNo' => $max_memb_no + 1);
                $r = $this->contact_model->save($new_member_no, $ContactId);
            }
             
        }
        public function add($view_file, $rID, $ContactId) {       
            //clean input
            $input = clean_data($this->input->post());
            $input['ContactId'] = $ContactId;
            $input['DateCreated'] = convert_DATE($input['DateCreated'], 'to_DATE');
            

            //save record
            $rID = $this->add_record($input, $rID);
            
             //Is it dID=22232 && strpos(_ItemBought, Membership)
            
            if( DATAOWNER_ID == 22232 
                    && isset($input['_ItemBought']) 
                    && strpos($input['_ItemBought'], 'Membership')
                    )
            {
                //run the method to updare memberhsip number
                $this->_update_memb_number($ContactId);
            }
            
                   

//get the latest mmeberhsip number
                    
                    //get the current memberhsip number
                    
                    //if there is no currentmeberhsip, then apply the next memb
                    
                    //now apply this to the cotact ID record
             
            

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
      /*public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE) {          
            parent::view($view_file, $rID, $ContactId);
                // Generate the view!
            $this->_generate_view($this->data);
        }*/

    }
}
