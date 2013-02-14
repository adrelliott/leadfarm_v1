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
    }
    
    public function index() {  
        echo "this is index";
    }
    
    function view() {
        echo "this is view ";
    }
   
    //a cron job runsd and queries the campaignee table for all records that have duedate of now or past du that have a status of FALSE (as in not run)
    
    //this creates a list of all campagin steps that are due to be run
    
    //then we cycle through each of those campaginee records and run the step, marking it as done, and then creating a rtecord with the next step
    
    function action($array) {
        //this is sent the entire row of the next camapgin step due
        $array = //this si the result from 
        (
                'Id' => 1,
                'Status' => FALSE,   //TRUE = done, FALSE = UNDONE
                'ContactId' => 23548,   //TRUE = done, FALSE = UNDONE
                'CampaignId' => 4,   //
                //'DateDue' => '2013/08/02 12:01:00',   //dont need this
                'CampaignStep' => 4
        );
        
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
        )
        
        
        
        echo "action id is $ActionId";
        
        $array = array
        (
            'TemplateId' => '',
            'TagId' => '',
            'TemplateId' => '',
        );
        
    }
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
   