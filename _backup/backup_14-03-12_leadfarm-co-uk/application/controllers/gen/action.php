<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {

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
         $this->output->enable_profiler(TRUE);
    }
    
    public function index() {  
        echo "this is index";
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
        //print_array($results, 0, 'this is line 35 - results)');
        
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

            $model = $this->_set_up_db_conn('nextsteps');        
            $result = $this->$model->save($input);
        }
        
    }
    
    function check_for_tasks($dID) {
        $this->dID = $dID;
        
        //get all outstanding tasks
        $time = time();
        $model = $this->_set_up_db_conn('nextsteps');        
        $results = $this->$model->get_outstanding_tasks($time);
        
        //If there are outstanding task, then do them
        if ($results) $this->_actioner($results);
        
        $this->view_tasks($dID);
    }
    
    protected function _actioner($data) {
        echo "<h1>OK, there are tasks to do: " . time() . "</h1>";
        print_array($data);
        
        if (is_array($data))    //prevents us trying to act on error messages
        {
            foreach ($data as $task => $taskdata)
            {
                print_array($taskdata, 0, 'this is data for task no ' . $task);
                extract($taskdata);
                
                //get the step details
                $model = $this->_set_up_db_conn('steps');        
                $taskdetails = $this->$model->get_steps($__CampaignId, $__StepNumber);
                
                //print_array($taskdetails, 0, 'These are the details for this step:' . $__StepNumber);
                
                //Perform the step
                if ($taskdetails)
                {
                    $actiontype = $taskdetails[$__StepNumber]['__ActionType'];
                    $templateId = $taskdetails[$__StepNumber]['__TemplateId'];
                    $result = FALSE;
                    switch($actiontype)
                    {
                        case 'email':
                            //$result = $this->send_email($__ContactId, $templateId);   //return bool
                            echo "<p>email sent</p>";
                            $result = TRUE;
                            break;
                        case 'text':
                            break;
                        case 'letter':
                            break;
                        case 'tag':
                            break;
                        default:
                            show_error('No __ActionType set.');
                    }

                    if ($result != FALSE)
                    {
                        //mark this task as done
                        $model = $this->_set_up_db_conn('nextsteps'); 
                        $input = array('__CompletedYN' => TRUE);
                        $result = $this->$model->save($input, $__Id);

                        //now create the next task (if there is a next step)
                        $nextstep = $__StepNumber + 1;
                        if (isset($taskdetails[$nextstep]))
                        {
                            $this->set_campaign_step(DATAOWNER_ID, $__ContactId, $__CampaignId, $nextstep);
                        }
                    }
                }                
            }
        }
        
    }
    
    function send_email($ContactId, $TemplateId) {
        //send $templateId as an email to Contact Id
        
        
        $this->load->library('email');

        $this->email->from('noreply@leadfarm.co.uk', 'Al');
        $this->email->to('al@dallasmatthews.co.uk'); 
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');	

        $this->email->send();

        //echo $this->email->print_debugger();
        
        return $result;
    }
    
    function send_text($ContactId, $TemplateId) {
        //send $templateId as a SMS text to Contact Id
    }
    
    function send_letter($ContactId, $TemplateId) {
        //send $templateId as a letter via docmail to Contact Id
    }
    
    function send_postcard($ContactId, $TemplateId) {
        //send $templateId as a postcard via docmail to Contact Id
    }
    
    function add_tag($ContactId, $TagId) {
        //apply $tagId to $ContactId
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //==============delete me - debug only============================================
    
    function view_steps($dID, $ModelName = 'Steps') { 
        echo "lets look at all steps ";
        $this->_set_DATAOWNER($dID);

        //get the steps records
        $Model = $this->_set_up_db_conn($ModelName);        
        $results = $this->$Model->get();

        print_array($results);

    }
    function view_tasks($dID, $ModelName = 'NextSteps') { 
        echo "lets look at all scheduled tasks";
        $this->_set_DATAOWNER($dID);

        //get the steps records
        $Model = $this->_set_up_db_conn($ModelName);        
        $results = $this->$Model->get_scheduled_tasks(time());

        print_array($results, 0, 'current time is ' . time());

    }
    
   
   
}
   