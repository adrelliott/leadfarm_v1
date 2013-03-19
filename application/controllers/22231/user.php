<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends T_User {

    public function __construct()    {
         parent::__construct();
    }
    
  public function index($view_file = 'index') {   
   }
   
  public function view($view_file = 'edit', $rID) {  
        parent::view($view_file, $rID, $rID);   
                //standard method expects ($view_file, $rID, $ContactId) but 
                //$rID is the same as $CobtactId
        
          // Generate the view!
        $this->_generate_view($this->data);
    }
    
  public function view_modal($view_file = 'edit', $rID) {  
        parent::view_modal($view_file, $rID);   
        
          // Generate the view!
        $this->_generate_view($this->data);
    }
    
    
  
   
}
   