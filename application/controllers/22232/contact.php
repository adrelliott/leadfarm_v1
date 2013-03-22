<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends T_Contact {

	

    public function __construct()    {
         parent::__construct();
    }
    
  public function index($view_file = 'index') { 
        $this->load->model ('contactsearch_model'); //Load model for 'searches'
        parent::index($view_file);
        $this->_generate_view($this->data);
   }
   
  public function view($view_file, $rID, $ContactId, $fieldset, $pull = '') {
        parent::view($view_file, $rID, $ContactId, $fieldset);
        
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

        if ($pull && array_key_exists ($pull, $this->data['view_setup']['tables']))
        {
          // Generate the dataset for this single table and return the HTML as JSON

          $data = $this->_generate_dataset($this->data['view_setup']['tables'][$pull]);
          $view_uri = $this->_custom_or_default_file($this->data['view_setup']['controller_name'], $this->data['view_setup']['view_file']);
          $view_uri = substr ($view_uri, 0, strlen ($view_uri) - strlen ('.php')) . '/' . $pull;
          $content = $this->load->view($view_uri, $this->data['view_setup'], true);

          $this->output->set_content_type("application/json");
          $this->output->set_output(json_encode($content));
          return;

        }

          // Generate the view!
        $this->_generate_view($this->data);
    }
    
    
  
   
}
   