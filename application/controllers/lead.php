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
            
            $this->gen_product_list();
                // Generate the view!
            $this->load_view($pull);
            }

        public function add($view_file, $rID, $ContactId) { 
            //clean input
            $input = clean_data($this->input->post());
            //$input['ContactID'] = $ContactId; //GOTCHA: the ID is capitalised

            //save record
            $rID = $this->add_record($input, $rID);
            
           
            //do some error reporting
           

            $url = $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId;

            /*if ($this->input->is_ajax_request ()) {
                  $response = array (
                      'success' => true,
                  );

                  if ($rID === 'new') {
                      $response['redirect'] = $url;
                  }

                  $this->output->set_content_type('application/json');
                  $this->output->set_output(json_encode($response));
                  return;
              }*/

              //refresh page
              redirect($url);

              //refresh page
              //redirect($this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId );

          }
          
          public function upload_file($view_file, $rID, $ContactId) {
            //do the upload if it exists
            //print_array($this->input->post('_:_userfile'), 1);
            //if (is_empty)
              $retval = array();
            $config['upload_path'] = APPPATH . '/uploads/' . DATAOWNER_ID;
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|csv|txt|rtf|';
            $config['max_size']	= '0';
            $config['max_width']  = '0';
            $config['max_height']  = '0';
            $config['remove_spaces']  = TRUE;

            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('_:_userfile'))
            {
                    $retval['error'] = $this->upload->display_errors();

            }
            else
            {
                    $retval['success'] = $this->upload->data();
                    //now save in the filebox table
                $upload_data = $this->upload->data();
                $data = array
                    (
                        'FileName' => $upload_data['raw_name'],
                        'Extension' => $upload_data['file_ext'],
                        'FileSize' => $upload_data['file_size'],
                        'ContactId' => $ContactId,
                        'LeadId' => $rID,
                        '_dID' => DATAOWNER_ID,

                    );
                $this->load->model('filebox_model');
                $this->filebox_model->save($data);

            }
            $this->session->set_flashdata($retval);
            
            $url = $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId. '#tab-2';
            
            redirect($url);

            
            
          }
          
          public function save_productjoin($view_file, $rID, $ContactId) {
              //print_array($this->input->post(), 0, 'post');
              $url = $this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $ContactId;
              $input = array();
              
                foreach ( $this->input->post() as $k => $v )
                    {
                          if ( strpos($k, '_') )
                          {
                              $explode = explode('_', $k);
                              $input = array
                                    ( 
                                          'ContactId' => $ContactId,
                                          'ProductId' => $explode[0],
                                          'InterestLevel' => $v,
                                          'LeadId' => $rID
                                    );
                            //print_array($input, 0, 'rid = ' . $explode[1]);
                            //save record
                            $this->load->model('productjoin_model', 'pj');
                            $pj_Id = $this->pj->add($input, $explode[1]); 
                          }
      
                    }
              
              redirect($url);
              // return;
              
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
          
          public function gen_product_list () {
              $products = $this->data['view_setup']['tables']['products']['table_data'];
                $dropdown = array();
              //create the dropdown
              foreach ($products as $product => $attr)
              {
                  //$label = $attr['ProductName'] . ' (' . $attr['ProductPrice'] . ')';
                  $dropdown[$attr['ProductName']] = $attr['Id'];
              }
              //now get it ready for the view
              $this->data['view_setup']['product_list'] = $dropdown;
          }
          
          
          public function gen_product_list_old () {
              $products = $this->data['view_setup']['tables']['products']['table_data'];
              //Do we have any records in productjoin for this contact?
              if ( ! empty ( $this->data['view_setup']['tables']['productjoin']['table_data'] ) )
              {
                    $productjoin = $this->data['view_setup']['tables']['productjoin']['table_data'];
                    $tmp = array();
                    //turn it into an assoc array
                    foreach ($productjoin as $k => $a) $tmp[$a['ProductId']] = $a;
                    $productjoin = $tmp;
              }
              else $productjoin = array();
              
              //Generate the radio buttons
              $product_array = array();
              foreach ( $products as $k => $array )
              {            
                    $product_array[$k] = $array;
                    $product_array[$k]['checked'] = array(1 => ' ', 2 => ' ', 3 => ' ');
                    //$fieldname = $array['Id'] . '_';
                    
                    //Does this exist in the productjoin array?
                    if ( array_key_exists($array['Id'], $productjoin) ) 
                    {
                        $key = $array['Id'];
                        $product_array[$k] = array_merge($product_array[$k], $productjoin[$key]);  
                        $value = $productjoin[$key]['InterestLevel'];
                        $product_array[$k]['checked'][$value] = ' checked="checked" ';  
                        $fieldname = $array['Id'] . '_' . $productjoin[$key]['Id'];  
                    }
                    else $fieldname = $array['Id'] . '_new';
                    
                    //now geneate the html for the radio buttons
                    $product_array[$k]['html'] = '<input class="" type="radio" name="' . $fieldname . '" value="1" ' . $product_array[$k]['checked'][1] . ' >Not Interested';
                    $product_array[$k]['html'] .= '<input class="" type="radio" name="' . $fieldname . '" value="2" ' . $product_array[$k]['checked'][2] . '  >Interested';
                    $product_array[$k]['html'] .= '<input class="" type="radio" name="' . $fieldname . '" value="3" ' . $product_array[$k]['checked'][3] . '  >Bought';
              }
              
              //now get it ready for the view
              $this->data['view_setup']['product_list'] = $product_array;
          }
          
          
          
      /*public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE) {          
            parent::view($view_file, $rID, $ContactId);
                // Generate the view!
            $this->_generate_view($this->data);
        }*/

        /*  public function gen_product_list_older () {
              $products = $this->data['view_setup']['tables']['products']['table_data'];
              $html = '';
              
              //Do we have any records in productjoin for this contact?
              if ( ! empty ( $this->data['view_setup']['tables']['productjoin']['table_data'] ) )
              {
                    $productjoin = $this->data['view_setup']['tables']['productjoin']['table_data'];
                    $tmp = array();
                    //turn it into an assoc array
                    foreach ($productjoin as $k => $a) $tmp[$a['ProductId']] = $a;
                    $productjoin = $tmp;
              }
              else $productjoin = array();
              
              //Generate the checkboxes
              $product_array = array();
              $html = array();
              foreach ( $products as $k => $array )
              {            
                    $product_array[$k] = $array;
                    $product_array[$k]['checked'] = array(1 => ' ', 2 => ' ', 3 => ' ');
                    //$html[$k] =  '<div class="clearfix" id=""><label class="" id="">' . $array['ProductName'] . '</label><div class="input " id="">';
                    
                    //Does this exist in the productjoin array?
                    if ( array_key_exists($array['Id'], $productjoin) ) 
                    {
                        $key = $array['Id'];
                        $product_array[$k] = array_merge($product_array[$k], $productjoin[$key]);  
                        $value = $productjoin[$key]['InterestLevel'];
                        $product_array[$k]['checked'][$value] = ' checked="checked" ';  
                    }
                    $product_array[$k]['html'] = '<input class="" type="radio" name="ProductName" value="' . $array['Id'] . '[1]" ' . $product_array[$k]['checked'][1] . ' >Not Interested';
                    $product_array[$k]['html'] .= '<input class="" type="radio" name="ProductName" value="' . $array['Id'] . '[2]" ' . $product_array[$k]['checked'][2] . '  >Interested';
                    $product_array[$k]['html'] .= '<input class="" type="radio" name="ProductName" value="' . $array['Id'] . '[3]" ' . $product_array[$k]['checked'][3] . '  >Bought';
                    $html .= '<input class="" type="radio" name="[' . $array['Id'] . ']" value="1" ' . $product_array[$k]['checked'][1] . ' checked="checked" >Not Interested';
                    $html .= '<input class="" type="radio" name="[' . $array['Id'] . ']" value="2" ' . $product_array[$k]['checked'][2] . '  >Interested';
                    $html .= '<input class="" type="radio" name="[' . $array['Id'] . ']" value="3" ' . $product_array[$k]['checked'][3] . '  >Bought';
                    //$html[$k] .= '<input class="" type="radio" name="prod_'.$k.'" value="1" ' . $product_array[$k]['checked'][1] . ' checked="checked" >Not Interested';
                    //$html[$k] .= '<input class="" type="radio" name="prod_'.$k.'" value="2" ' . $product_array[$k]['checked'][2] . '  >Interested';
                    //[$k] .= '<input class="" type="radio" name="prod_'.$k.'" value="3" ' . $product_array[$k]['checked'][3] . '  >Bought';
                    //$html[$k] .= '</div></div>';
              }
              //print_array($product_array, 0, 'product array');
              //print_array($html, 0, 'html array');
              
              //echo "<br/>hereis html". $html;
              //echo 'more html: <div class="clearfix" id=""><label class="" id="">Record Type</label><div class="input " id=""><input class="" type="radio" name="_IsOrganisationYN" value="0" checked="checked">Individual<input class="" type="radio" name="_IsOrganisationYN" value="1">Organisation</div></div>';
              $this->data['view_setup']['product_list'] = $product_array;
          }
          */
          
    }
    
    
}
