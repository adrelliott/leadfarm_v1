<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Campaign extends T_Campaign {

	

    public function __construct()    {
         parent::__construct();
    }
    
  public function index($view_file = 'index') {   
        parent::index($view_file);
        $this->_generate_view($this->data);
   }
   
  public function view($view_file = 'edit', $rID) {  
        parent::view($view_file, $rID);
        
          // Generate the view!
        $this->_generate_view($this->data);
    }
    
    
  
   
}
   