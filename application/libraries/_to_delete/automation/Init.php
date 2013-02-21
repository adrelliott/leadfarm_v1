<?php    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );
 /* Striclty speaking this should probably be a model, but we'll treat it as a Libarary
 * 
 * It loads the iSDK for infusionsoft and allows us to access infusionsoft 
  * 
  * 
  * Then the model inf_model extends this - this allows us to create a layer
  * between the actual infusionsoft commands and the controller.
  * 
  * If we ever decide to move to another CRM, all we need to do is load a new library
  * and amend the functions in inf_model, without having to touch the code itself
  * 
  * 
  */

class Init 
{
    
    public $dID = '';
    public $lib_name = '';
    
    public function __construct() {
        //load this lib name too
        $this->CI =& get_instance(); //allow CI funcitonality here
        $this->CI->output->enable_profiler(TRUE);
    }
    
    function _set_step($dID, $ContactId, $CampaignId, $Step) {
        $this->dID = $dID;
        
        //find the $Step in the sequence
        $Args = array
        (
            '__CampaignId' => $CampaignId,
            '__StepNo' => $Step
        );        
        
        $results = $this->_get_results('Steps', 'get_by', $Args);  
        //print_array($results, 1, 'this is line 35 - results)');

        //send it to NextSteps table
        if ($results)
        {
            $newTime = time() + $results[0]['__Delay'];
            $input = array
            (
                '__ContactId' => $ContactId,
                '__CampaignId' => $CampaignId,
                '__StepNumber' => $Step,
                '__TaskDue' => $newTime,
                '__CompletedYN' => FALSE
            );

            $results = $this->_get_results('NextSteps', 'save'); 
            $model = $this->_set_up_db_conn('NextSteps');        
            $result = $this->$model->save($input);
        }
    }
    
    protected function _get_results($ModelName, $ModelMethod, $Args = array()) {
        $this->_set_DATAOWNER();
        $this->CI->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');
        
        //Set up db
        $dbConn = $this->CI->config->item('database');     //these are different for each dID      
        $this->CI->load->database($dbConn, FALSE, TRUE); //load this dID's database 
        
        //get the next steps records
        //print_array($Args, 1);
        $ModelName = $ModelName . '_model';
        $this->CI->load->model($ModelName);        
        $Results = $this->CI->$ModelName->$ModelMethod($Args);
                
        return $Results;
    }
    
    /*protected function _set_up_db_conn($ModelName) {
        $CI =& get_instance();  //allow CI funcitonality here
        $this->_set_DATAOWNER();
        $this->CI->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');
        $dbConn = $this->CI->config->item('database');     //these are different for each dID       
        $this->CI->load->database($dbConn, FALSE, TRUE); //load this dID's database 
        
        //get the next steps records
        $ModelName = $ModelName . '_model';
        $this->CI->load->model($ModelName);
        
        return $ModelName;
    }*/
    
    private function _set_DATAOWNER() {
        if ( ! defined('DATAOWNER_ID')) define('DATAOWNER_ID', $this->dID);
    }
    

}