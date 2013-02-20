<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */

    public function __construct()    {
         parent::__construct();
         $this->output->enable_profiler(TRUE);
    }
    
    public function index() {  
        echo "this is index";
    }
    
     
    
                        
    
    function set_campaign_step($dID, $ContactId, $CampaignId, $Step = 1) {       
        $this->_set_DATAOWNER($dID);
        
         //find the $Step in the sequence
        $arg = array
        (
            '__CampaignId' => $CampaignId,
            '__StepNo' => $Step
        );        
        $model = $this->_set_up_db_conn('Steps');        
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
        
        $model = $this->_set_up_db_conn('NextSteps');        
        $result = $this->$model->save($input);
    }
    
    function check_for_tasks($dID) {
        $this->_set_DATAOWNER($dID);
        
        //get all outstanding tasks
        $time = time();
        $model = $this->_set_up_db_conn('NextSteps');        
        $results = $this->$model->get_outstanding_tasks($time);
        
        //If there are outstanding task, then do them
        if ($results) $this->_actioner($results);
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
                $model = $this->_set_up_db_conn('Steps');        
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
                        $model = $this->_set_up_db_conn('NextSteps'); 
                        $input = array('__CompletedYN' => TRUE);
                        $result = $this->$model->save($input, $__Id);
                        //echo "<p>the task has been marked as complete: " . $result;

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
        
        /*
        $this->load->library('email');

        $this->email->from('noreply@leadfarm.co.uk', 'Al');
        $this->email->to('al@dallasmatthews.co.uk'); 
        //$this->email->cc('another@another-example.com'); 
        //$this->email->bcc('them@their-example.com'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');	

        $this->email->send();

        echo $this->email->print_debugger();
        */
        
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
        
        $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');
        $dbConn = $this->config->item('database');     //these are different for each dID       
        $this->load->database($dbConn, FALSE, TRUE); //load this dID's database 
        
        //get the next steps records
        $ModelName = $ModelName . '_model';
        $this->load->model($ModelName);
        
        return $ModelName;
    }
    
    private function _set_DATAOWNER($dID) {
        if ( ! defined('DATAOWNER_ID')) define('DATAOWNER_ID', $dID);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //==========================================================
    
    function view_steps($dID, $ModelName = 'Steps') { 
        echo "lets look at all steps ";
        $this->_set_DATAOWNER($dID);

        //get the steps records
        $Model = $this->_set_up_db_conn($ModelName);        
        $results = $this->$Model->get();

        print_array($results);

    }
                        
                        
   
    //a cron job runsd and queries the campaignee table for all records that have duedate of now or past du that have a status of FALSE (as in not run)
    
    //this creates a list of all campagin steps that are due to be run
    
    //then we cycle through each of those campaginee records and run the step, marking it as done, and then creating a rtecord with the next step
    
    function action($array) {
        //this is sent the entire row of the next camapgin step due
        
        
        //First, run the step identified above
            //look up the campaign step
            //now run $this->$Action_Type($array);
            //the mthod is defined here ($action_type can be email, text, directmail, tag)
                
        //Next mark the status as done
        
        //now, look up the next step from CampaignStep(need Id and delay)
        $next_step = array 
        (
            'f',
        );
        
        //now work out when the next step is due (check direction of countdown)
        
        //now write a new record to Campaignee like:
        $new_record = array 
        (
            //'Id' => , //autogen
            'Status' => FALSE,   //TRUE = done, FALSE = UNDONE
            'ContactId' => 23548,   //TRUE = done, FALSE = UNDONE
            'CampaignId' => 4,   //
            'DateDue' => $dateDue,   //dont need this
            'CampaignStep' => 4
        );
        
        
        
        echo "action id is $ActionId";
        
        $array = array
        (
            'TemplateId' => '',
            'TagId' => '',
            'TemplateId' => '',
        );
        
    }
    
    
    var $Campaign_Step = array
    (
        'Id' => 1,
        'Type' => '1',    //type of action, either email(1), tag(2), SMS(3), letter(4) etc
        'Step' => 1,    //sequence step number
        'TemplateId' => 1,  //Id of template if its an email/SMS/letter
        'TagId' => 1,  //Id(s) of tags
        'Delay' => 1,  //No of seconds delay between sequences
        'TriggerTimestamp' => '2013/08/02 12:01:00',  //timestamp working from or to
        'CountdownDirection' => 1,  //1 for countdown *FROM* trigger date, 0 = countdown *TO*
        'ActiveYN' => TRUE,
        
    );
   
   
}
   