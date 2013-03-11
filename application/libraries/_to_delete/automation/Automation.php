<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Automation Class
 *
 * Manages all automation steps
 *
 * @author Al Elliott.
 */

class Automation {
  
    var $dID  = '';
    var $input = array();
    var $variables = array();
    var $_arguments = array();
    var $contacts = array();
 
    function __construct($param) {
        $this->dID = $param['dID'];
        $CI =& get_instance();  //we can now use CI functionality
        $this->_set_DATAOWNER($this->dID);        
    }
    
    function apply_tag($ContactId, $TagId) {        
        $this->input = array
        (
            '__ContactId' => $ContactId,
            '__TagId' => $TagId,
            '__DateApplied' => date("Y-m-d")            
        );
        
        echo "this is apply tag method";
        $model = $this->_set_up_db_conn('contactgroupjoin');        
        $results = $this->$model->save($input);
    }
    
    function _crud ($type = 'create') {
        switch ($type)
        {
            case 'create':
                //create
                break;
            case 'update':
                //update
                break;
            case 'retrieve':
                break;
        }
    }
    
     protected function _set_up_db_conn($ModelName) {
        $this->_set_DATAOWNER();
        $CI->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');
        $dbConn = $CI->config->item('database');     //these are different for each dID       
        $CI->load->database($dbConn, FALSE, TRUE); //load this dID's database 
        
        //get the next steps records
        $ModelName = $ModelName . '_model';
        $CI->load->model($ModelName);
        
        return $ModelName;
    }
    
    private function _set_DATAOWNER($dID) {
        if ( ! defined('DATAOWNER_ID')) define('DATAOWNER_ID', $this->dID);
    }
}

/* End of file Automation.php */