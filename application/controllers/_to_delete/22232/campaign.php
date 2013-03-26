<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends T_Campaign {
    
    public function __construct()    {
         parent::__construct();
    }
    
  public function index($view_file = 'index') {   
        parent::index($view_file);
        $this->_generate_view($this->data);
   }
   
    public function view($view_file, $rID, $pull = '') {  
        parent::view($view_file, $rID);

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
   
   /*
  public function view($view_file = 'edit', $rID) {  
        parent::view($view_file, $rID);
        
          // Generate the view!
        $this->_generate_view($this->data);
    }
    */
    
  
   
}
   