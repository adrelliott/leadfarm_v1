<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redir extends CI_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */
    
    protected $dID = '';
    
    public function __construct()    {
         parent::__construct();
    }
    
    public function index() {  
        
    }
    
    function url($dID = FALSE, $linkId = FALSE, $ContactId = FALSE, $Step = 1) {
        $this->dID = $dID;
        
        //query the __Links table for url and campaign ID
        $model = $this->_set_up_db_conn('links');        
        $results = $this->$model->get($linkId);
        //print_array($results, 0, 'link found:');
                
        if ($results)
        {
            extract($results);
            //start the sequence
            if ($__SequenceId != 0  && $ContactId) $this->set_campaign_step($dID, $ContactId, $__DestinationURL, $Step);
            
            //now redirect to the new link
            redirect($__DestinationURL, 'location');
        }
        else $this->load->view('default/redir/v_oops.php');
        
    }
    
    function set_campaign_step($dID, $ContactId, $CampaignId, $Step = 1) {
        $this->dID = $dID;
         //find the $Step in the sequence
        $arg = array
        (
            '__CampaignId' => $CampaignId,
            '__StepNo' => $Step
        );        
        $model = $this->_set_up_db_conn('steps');        
        $results = $this->$model->get_by($arg);
        
        //send it to NextSteps table
        $newTime = time() + $results[0]['__Delay'];
        $input = array
        (
            '__ContactId' => $ContactId,
            '__CampaignId' => $CampaignId,
            '__StepNumber' => $Step,
            '__TaskDue' => $newTime,
            '__CompletedYN' => FALSE
        );
        
        $model = $this->_set_up_db_conn('nextsteps');        
        $result = $this->$model->save($input);
    }
    
    
     protected function _set_up_db_conn($ModelName) {
        $this->_set_DATAOWNER();
        $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');
        $dbConn = $this->config->item('database');     //these are different for each dID       
        $this->load->database($dbConn, FALSE, TRUE); //load this dID's database 
        
        //get the next steps records
        $ModelName = $ModelName . '_model';
        $this->load->model($ModelName);
        
        return $ModelName;
    }
    
    private function _set_DATAOWNER() {
        if ( ! defined('DATAOWNER_ID')) define('DATAOWNER_ID', $this->dID);
    }
    
    
   
}
   