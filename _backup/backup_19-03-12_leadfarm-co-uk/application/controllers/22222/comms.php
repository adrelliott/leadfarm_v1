<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comms extends T_Comms {
    
    public function __construct()    {
        parent::__construct();
    }
    
    public function index($view_file = 'index') {     
        parent::index($view_file);
        $this->_generate_view($this->data);
    }
   
    public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE) {
        parent::view($view_file, $rID, $ContactId);
       
            // Generate the view!
        $this->_generate_view($this->data);
    }
    
}
   