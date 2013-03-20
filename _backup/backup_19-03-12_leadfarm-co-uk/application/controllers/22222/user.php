<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends T_User {

	

    public function __construct()    {
         parent::__construct();
    }
    
  public function index($view_file = 'index') {   
   }
   
  public function view($view_file = 'edit', $rID, $ContactId) {  
        parent::view($view_file, $rID, $ContactId);
        
          // Generate the view!
        $this->_generate_view($this->data);
    }
    
    
  
   
}
   