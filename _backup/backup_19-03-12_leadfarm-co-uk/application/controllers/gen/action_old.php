<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {

	/**
	 * This class deals with any actions that the app needs to perform
         * 
         * E.g. the redir() method will redirect visitors to a link, but also
         * start a sequence if needs be
	 * 
	 */

    
    //methods:
        //check_for_tasks .....yes
        //apply tag......................YES
        //send email (from template) ......yes
        //send text
        //redirect............YES
        //send tweet
        //_set next step .................YES
        //_record_comm
        //_record_audit
    
    
        protected $dID = '';    //set by $this->_set_DATAOWNER();
        var $contact_id = '';    //set by $this->_set_DATAOWNER();
        var $assocYN = FALSE;   //Do we want to return results as assoc array?
        var $input = array();   //this is the info we are sending to database 
        var $cols = array();    //This is the array of fields we are rtreiving 
        var $where = array();    //where('fieldname <', 'value')
        var $model_name = '';    //What table are we CRUDing?
        var $id = FALSE;    //What's the record ID we want to retrieve?
    
    
    public function __construct()    {
         parent::__construct();
         $this->output->enable_profiler(TRUE);
    }
    
    function index() {
        $this->load->view('default/redir/v_oops.php'); //Go away, this is private.
    }
    
       
    /************ THESE ARE *D*O*I*N*G* METHODS *************************/
    function redir($dID, $ContactId = NULL, $LinkId, $Step = 1) { 
                //NOTE> if step=-1 then stop the sequence
        $this->_set_DATAOWNER($dID);
        $this->contact_id = $ContactId;
        
        //Set up & perform the query
        $this->model_name = 'links';
        $this->cols = array
        (
            '__LinkName',
            '__SequenceId',
            '__DestinationURL',            
        );        
        $this->id = $LinkId;
        $results = $this->_crud('retrieve');
        
        //redirect them if the link exists..
        if ($results)
        {           
            extract($results);
            if (is_numeric($__SequenceId) && $this->contact_id ) $this->_get_real_campaign_step($__SequenceId, $Step);   //Start/advance a sequence (if data set)
            
            //now redirect to the new link
            //redirect($__DestinationURL, 'location');
        }
        else $this->load->view('default/redir/v_oops.php');
    }
    
    function apply_tag($dID, $ContactId, $TagId) {
        $this->_set_DATAOWNER($dID);
        $this->contact_id = $ContactId;
        
        //set up & insert new tag record
        $this->model_name = 'tagjoin';
        $this->input = array
        (
            '__ContactId' => $ContactId,
            '__TagId' => $TagId,
            '__DateApplied' => date("d-m-Y")            
        );
        return $this->_crud('create'); //can we record if this fails???????????????
    }
    
    function send_test_mail ($dID, $ContactId = NULL, $TemplateId) {
        //is contact ID valid?
        //now get the people for the email
        $this->load->library('email');

        $this->email->from('al@dallas.com', 'Al');
        $this->email->to('altest@example.com'); 

        $this->email->subject('sequenced email');
        $this->email->message("This is an email: did=$dID, contactid=$ContactId, templateid=$TemplateId");	

        $this->email->send();
        
    }
    function send_mail_DONOTUSE($dID, $ContactId = NULL, $TemplateId) {
        $this->_set_DATAOWNER($dID);
        $this->contact_id = $ContactId;
        $results = array();

        //Set up & perform the query to get template info
        $this->model_name = 'template';        
        $this->id = $TemplateId;
        $results['template'] = $this->_crud('retrieve');
        if( !is_array($results['template']) ) return FALSE;
        
        //Load the PostageApp library & set up template
        $this->load->library('PostageApp/PostageApp');     
        $results['template'] = $this->postageapp->prepare_template($results['template']);
        $query_fields = $results['template']['postageapp_merge_fields'];
        
        //now get the people for the email
        $this->model_name = 'contact';        
        $this->id = $this->contact_id;
        $this->cols = $query_fields['Contact'];
        $results['contacts'] = $this->_crud('retrieve');
        $results['contacts'] = $this->_make_assoc($results['contacts'], 'Email');
        if( !is_array($results['contacts']) ) return FALSE;
        
        //Finally, are there any links to get for this email?
        if ( isset($query_fields['Link']) )
        {            
            //Get the link details
            $this->model_name = 'links';        
            $this->id = $query_fields['Link'];
            $results['links'] = $this->_crud('retrieve');
            $results['links'] = $this->_make_assoc($results['links'], '__Id');
        }
        
        //create the merge_array of recipients
        foreach ($results['contacts'] as $email => $array)
        {
            foreach ($query_fields['Contact'] as $var => $col_name)
            {
                $results['merge_array'][$email][$var] = $array[$col_name];
            }
            foreach ($query_fields['Link'] as $var => $link_id)
            {
                $link = 'gen/redir/url/' . DATAOWNER_ID . "/";
                $link .= $array['Id'] . '/' . $link_id;
                $link = '<a href="' . site_url($link) . '">';
                $link .= $results['links'][$link_id]['__LinkName'] . '</a>';
                    //feed back into the merge array
                $results['merge_array'][$email][$var] = $link ;
            }
            
        }
        extract($results['template']);
        $results = $results['merge_array']; //get rid of what we don't need
        
        //print_array($results, 1, 'this si results');
          
        //Now prepare the email
        $this->postageapp->from($__FromEmail);
        $this->postageapp->subject($__Subject); 
        $this->postageapp->template($__TemplateName);
        
        //add unsubscribe to both HTML and plaintext templates
        $__Content = $this->postageapp->add_unsubscribe($__Content);
        $__ContentPlaintext = $this->postageapp->add_unsubscribe($__ContentPlaintext);
        
        //Define the message
        $this->postageapp->message(array
        (
            'text/html'   => $__Content, 
            'text/plain'  => $__ContentPlaintext
        ));
        
        //Add the people
        $this->postageapp->to($results);
        
        //now send it!
        $result = $this->postageapp->send();
        
        print_array($result);
        return TRUE;
    }
    
    function send_tweet(){
        
    }
    
    function send_letter(){
        
    }
    
    function send_sms(){
        
    }
    
    
    
    /************ THESE ARE *A*U*T*O*M*A*T*I*O*N* METHODS *************************/
    //this method is run periodically. Checks for outstanding tasks,does them then schedules the next task, if it exists
    function start_campaign($dID, $ContactId, $CampaignId, $StepNo = 1){
        $this->_set_DATAOWNER($dID);
        
        //insert into nextstep
        $this->model_name = 'nextsteps';
        $this->input = array
        (
            '__ContactId' => $ContactId,
            '__CampaignId' => $CampaignId,
            '__StepNumber' => $StepNo,
            '__TaskDue' => time(),
            '__CompletedYN' => 0            
        );
        //return $this->_crud('create'); //can we record if this fails???????????????
        echo $this->_crud('create'); //can we record if this fails???????????????
        
    }
    
    function check_for_tasks($dID) {
         $this->_set_DATAOWNER($dID);
        
        //get all outstanding tasks
        $this->model_name = 'nextsteps';
        $this->cols = array('__ContactId', '__CampaignId', '__StepNumber');
        $this->where = array
        (
            '__TaskDue <=' => time(),
            '__CompletedYN !=' => TRUE
        );
        $results = $this->_crud('retrieve');
                
        //remove duplicates
        $results = array_map("unserialize", array_unique(array_map("serialize", $results)));
        $campaign_ids = array_keys($this->_make_assoc($results, '__CampaignId'));
        print_array($campaign_ids, 0, 'these are the cmapagins');
        
//Get all steps, from all relevant campaigns for outstanding tasks
        $this->model_name = 'steps';
        //$this->db->where_in('__CampaignId',$campaign_ids);     
        $camp_steps = $this->_crud('retrieve');
        //print_array($camp_steps,0,'these are all the steps required');

        //Now sort them so we have an array of camps & associated steps
        $campaign_array = array();
        foreach ($camp_steps as $k => $array)
        {
            $camp_id = $array['__CampaignId'];
            $step_no = $array['__StepNo'];
            $campaign_array[$camp_id][$step_no] = $array; 
        }
        unset($camp_steps);
        
        print_array($results, 0, 'these are the results (the tasks we have to do)');
        print_array($campaign_array, 0, 'these are the the steps for all the tasks');
        return;
        //print_array($campaign_array, 0);
        //Now cycle through the tasks and feed to our actioner
        foreach ($results as $k => $array)
        {            
            //print_array($array, 0, 'this si the array form results');
            extract($array);
            
            //Make sure that the step is valid
            if ( isset($campaign_array[$__CampaignId][$__StepNumber]) && is_numeric($__ContactId )) 
            {
 echo "<p>Ok, we're doing step $__StepNumber, of sequence $__CampaignId, with contactid $__ContactId</p>";
                //do the step
                $success = $this->do_campaign_step(
                        $campaign_array[$__CampaignId][$__StepNumber],
                        $__ContactId
                        );
                echo "<p>success = $success</p>";
                if ($success) $results['update'][$k]['__CompletedYN'] = 1;
                
                //get next step
                $next_step = $this->_get_next_campaign_step(
                        $campaign_array[$__CampaignId], 
                        $__StepNumber
                        );
                echo "<br/>next step is " . $next_step['step_no'];
                
                if ($next_step)
                {
                    $results['insert'] = array
                    (
                        '__ContactId' => $__ContactId,
                        '__CampaignId' => $__CampaignId,
                        '__StepNumber' => $next_step['step_no'],
                        '__TaskDue' => $next_step['delay'],
                        '__CompletedYN' => 0
                    );
                }
            }
            else $results['update'][$k]['__CompletedYN'] = 1;

            
            
            
        }
        
    }
    
    
    protected function _get_next_campaign_step($sequence_id, $step_no) {       
        //get all steps in the sequence        
        if( is_array($sequence_id) ) $results = $sequence_id;   //we can pass the array 
        else 
        {
            $this->model_name = 'steps';
            $this->where = array('__CampaignId' => $sequence_id);        
            $results = $this->_crud('retrieve');
        }
        
        //alows us to use this method to cancel the sequence if we want to 
        if( $step_no < 1 ) 
        {
            //stop the sequence <<<<********<********<<********<<<***}
        }
        
        //now turn the array keys into the step numbers
        $results = $this->_make_assoc($results, '__StepNo');
        
        //now determine what the next step is
        $step_no = $step_no + 1;
        $retval = FALSE;
        $tmp = end($results);
        $last_step_no = $tmp['__StepNo'];   //this gives us the last step
        
        if ( isset($results[$step_no]) ) 
        {
            $retval['step_no'] = $step_no;
            $retval['delay'] = $results[$step_no]['__Delay'];
            
        }               
        elseif ( $step_no < $last_step_no )
        {            //No step number matches? Cycle through all possible steps...
            $count = $step_no;
            while ($count <= $last_step_no)
            {               
                if (isset($results[$count])) //...until a step is found, OR...
                {
                   $step_no = $count;
                   $retval['step_no'] = $step_no;
                   $retval['delay'] = $results[$step_no]['__Delay'];
                   break;
                }
                else $count++;
            }
        } //... No step is found. (Its the end of sequence - kick back with a beer)
        
        return $retval;
    }
    
    function do_campaign_step ($array, $ContactId) {
        $this->contact_id = $ContactId;
        $retval = FALSE;
        
        //array is the row from the Steps database
   print_array($array, 0, 'this is the step info');
        
        extract($array);
        switch ($__ActionType)
        {
            case 'EMAIL':
                //do email
                $this->send_mail($this->dID, $this->contact_id, $__TemplateId);
                echo "<p>Hapily sending mail (tempid=$__TemplateId) for </p>". $this->contact_id;
                break;
            case 'TAG':
                //apply tag
                $this->apply_tag($this->dID, $this->contact_id, $__TagId);
                echo "<p>Hapily applying tag (tagid=$__TagId) for </p>". $this->contact_id;
                break;
            case 'SMS':
                //do SMS
                echo "<p>Hapily applying tag (tagid=$__TagId) for </p>". $this->contact_id;
                break;
            case 'TWEET':
                //do email
                break;
            case 'LETTER':
                //do email
                break;
            case 'SKIP':    //????????????????????????
                //do email
                break;
            default:
                //Do nothing
                break;
        }
        
        //now schedule the next step in the __nextsteps table
        /*$this->model_name = 'nextsteps';
        $this->input = array
        (
            '__ContactId' => $this->contact_id,
            '__CampaignId' => $__CampaignId,
            '__StepNumber' => $__StepNo + 1,        
            '__TaskDue' => time() + $__Delay,     
        );
        print_array($this->input, 0, 'this is what we\'re senidng to nextsteps. time = '.time());
        $this->_crud('create'); //can we record if this fails???????????????
         * 
         */
        
    }
    
    
    /************ THESE ARE *D*A*T*A*B*A*S*E* METHODS *************************/    
    protected function _set_up_db_conn($model_name) {
        $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');
        $dbConn = $this->config->item('database');     //these are different for each dID           
        //Load DB & Model
        $this->load->database($dbConn, FALSE, TRUE); 
        $model_name = $model_name . '_model';
        $this->load->model($model_name);
        
        return $model_name;
    }
    
    protected function _set_DATAOWNER($dID) {
        $this->dID = $dID; 
        if ( ! defined('DATAOWNER_ID') ) define('DATAOWNER_ID', $this->dID);
    }
    
    protected function _crud($type) {
        $model = $this->_set_up_db_conn($this->model_name);
        $this->db->select($this->cols);
        $this->db->where($this->where);
        switch($type)
        {
            case 'create':
                $results = $this->$model->save($this->input);
                break;
            case 'retrieve':       
                if ($this->id) $results = $this->$model->get($this->id);
                else $results = $this->$model->get();
                break;
            case 'update':
                //do update
                break;
            case 'delete':
                //do update
                break;            
        }
        
        //turn into an assoc array?
        if($this->assocYN) $results = $this->$model->to_assoc($results);
            
        //reset default value
        $this->assocYN = FALSE; 
        $this->input = array(); 
        $this->cols = array();
        $this->where = array();
        $this->model_name = ''; 
        $this->id = FALSE;
        
        //maybe some error reporting? what happens if this tag is not set?
        return $results;
    }  
    
    protected function _make_assoc($array, $field) {
        //rewrites array where $field is the key for each dimension
        $tmp = array();
        //Check and see if its an assoc array already
        if ( array_key_exists($field, $array) ) $array = array_chunk($array, count($array), TRUE);
        foreach ($array as $k => $a) $tmp[$a[$field]] = $a;
        return $tmp;
    }
    
    
    
    
    
    
          
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    function set_campaign_step_old($dID, $ContactId, $CampaignId, $Step = 1) {
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
    
    /*function check_for_tasks($dID) {
        $this->dID = $dID;
        
        //get all outstanding tasks
        $time = time();
        $model = $this->_set_up_db_conn('nextsteps');        
        $results = $this->$model->get_outstanding_tasks($time);
        
        //If there are outstanding task, then do them
        if ($results) $this->_actioner($results);
        
        $this->view_tasks($dID);
    }*/
    
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
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    //==============delete me - debug only============================================
    
    function view_steps($dID, $ModelName = 'steps') { 
        echo "lets look at all steps ";
        $this->_set_DATAOWNER($dID);

        //get the steps records
        $Model = $this->_set_up_db_conn($ModelName);        
        $results = $this->$Model->get();

        print_array($results);

    }
    function view_tasks($dID, $ModelName = 'nextsteps') { 
        $this->dID = $dID;
        echo "lets look at all scheduled tasks";
        $this->_set_DATAOWNER($dID);

        //get the steps records
        $Model = $this->_set_up_db_conn($ModelName);        
        $results = $this->$Model->get_scheduled_tasks(time());

        print_array($results, 0, 'current time is ' . time());

    }
    
    function test_lib($dID, $ContactId, $TagId) {
        $param = array('dID' => $dID);
        $this->load->library('Automation/Automation', $param);
        
        $this->automation->apply_tag($ContactId, $TagId);
    }
    
   
   
}
   