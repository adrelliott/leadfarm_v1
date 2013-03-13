<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
    
        protected $dID = '';    //set by $this->_set_DATAOWNER();
        var $tasks = array();   //holds all data on the tasks
        var $data = array();   //Not used at the moment
        var $crud = array();    //holds all data on the query
        var $form = array();    //holds all data from the form
        var $cols = array       //alows us to remove bad fieldnames from $_POST
        (
            'contact' => array
            (
                'FirstName', 'LastName', 'Email', 'Username', 'Password'
            ),
        );
        
        public function __construct()    {
            parent::__construct();
            $this->output->enable_profiler(TRUE);
            $this->load->library('Automation/Crud_lib');
            $this->crud_lib->_reset();    //set up the crud array
        }     
        
        
	function check_for_tasks($dID) {
            $this->crud_lib->_set_DATAOWNER($dID);
            
        # 1. Lets retrive all the data we'll need to do all these tasks
            //retrieve all next steps that are not done, time is expired and belong to dID 
            $this->crud['model_name'] = 'nextsteps';
            $this->crud['select'] = array(
                '__ContactId', '__CampaignId', '__StepNumber', '__Id'
                );
            $this->crud['where'] = array(
                '__TaskDue <=' => time(),
                '__CompletedYN !=' => TRUE
                );
            $this->tasks['to_do'] = $this->crud_lib->_crud('retrieve');
            print_array($this->tasks, 0, "outstanding tasks - time = ".time());
            if( empty($this->tasks['to_do'])){
                echo "no tasks found, time is ".time();
                return;
            }
            
            echo "*got here********";return;
            //remove duplicates
            $this->tasks['to_do'] = array_map(
                    "unserialize", 
                    array_unique(array_map("serialize",$this->tasks['to_do']))
                    );            
            
            //Get all steps for each campaign that is affected
            $this->tasks['campaign_ids'] = array_keys($this->crud_lib->_make_assoc(
                     $this->tasks['to_do'],
                     '__CampaignId')
                     );
            $this->crud['model_name'] = 'steps';              
            $this->crud['where_in']['values'] = $this->tasks['campaign_ids'];            
            $this->crud['where_in']['col'] = '__CampaignId';            
            $this->tasks['all_steps'] = $this->crud_lib->_crud('retrieve');
            
            //Get all templates for each step that is returned
            $this->tasks['template_ids'] = array_keys($this->crud_lib->_make_assoc(
                     $this->tasks['all_steps'],
                     '__TemplateId')
                     );
            $this->crud['model_name'] = 'template';              
            $this->crud['where_in']['values'] = $this->tasks['template_ids'];            
            $this->crud['where_in']['col'] = '__Id';
            $this->tasks['all_templates'] = $this->crud_lib->_make_assoc(
                    $this->crud_lib->_crud('retrieve'),
                    '__Id');
           print_array($this->tasks, 1);
        # 2. Now sort the array into an assoc that contains all data for each step
            //sort these steps into array [campId] => step_array
            $tmp_array = array();
            foreach ($this->tasks['all_steps'] as $k => $array)
            {
                $camp_id = $array['__CampaignId'];
                $step_no = $array['__StepNo'];
                $template_id = $array['__TemplateId'];
                $tmp_array[$camp_id][$step_no] = $array; 
                    //now add in the template details
                if (isset($this->tasks['all_templates'][$template_id]))
                    $template_data = $this->tasks['all_templates'][$template_id];
                else $template_data = FALSE;
                $tmp_array[$camp_id][$step_no]['template_data'] = $template_data;
            }
            $this->tasks['all_data'] = $tmp_array;  //this is a master array for all task!
            
        # 3. Now get the contact details for these tasks
            $this->tasks['contact_ids'] = array_keys($this->crud_lib->_make_assoc(
                     $this->tasks['to_do'],
                     '__ContactId')
                     );
            $this->crud['model_name'] = 'contact';              
                //get the most common fields used in templates
            $this->crud['select'] = array(
                'Email', 'FirstName', 'LastName', 'Id', 'Nickname', 'Phone1', 'StreetAddress1', 'StreetAddress2', 'City', 'Postalcode', 'Country', 'State', 'Title', '_IsOrganisationYN', '_OrganisationName', '_OptinEmailYN', '_OptinSmsYN', '_OptinTwitterYN', '_OptinSurfaceMailYN', '_OptinNewsletterYN', '_OptinPref'
                    );              
            $this->crud['where_in']['values'] = $this->tasks['contact_ids'];            
            $this->crud['where_in']['col'] = 'Id';            
            $this->tasks['all_contacts'] = $this->crud_lib->_make_assoc(  //make 'Id' the key
                     $this->crud_lib->_crud('retrieve'),
                     'Id'
                    );
            
        # 4. Now perform each task    
            foreach ($this->tasks['to_do'] as $k => $task_details)
            {
                $campaign_data = $this->tasks['all_data'][$task_details['__CampaignId']];
                $contact_data = $this->tasks['all_contacts'][$task_details['__ContactId']];
                $current_step = $task_details['__StepNumber'];
                $result = $this->_do_step(
                        $campaign_data, 
                        $contact_data, 
                        $current_step
                        );
                
                //if its successful, mark it as complete...
                if($result)
                {
                    //mark the step done
                    $this->tasks['update_array'][] = array
                        (
                            '__Id' => $task_details['__Id'],
                            '__CompletedYN' => 1,
                        );
                    //is there another step?
                    $next_step = $this->_find_next_step($campaign_data, $current_step);
                   
                    if( $next_step ) $this->tasks['insert_array'][] = array
                        (
                            '__ContactId' => $task_details['__ContactId'],
                            '__CampaignId' => $task_details['__CampaignId'],
                            '__StepNumber' => $next_step['step_no'],
                            '__TaskDue' => time() + $next_step['delay'],
                            '__CompletedYN' => 0,
                        );
                    //if so, write it in the insert array
                }
            }
            
        ## 5. Finally write these to the database
            //update...
            $this->crud['model_name'] = 'nextsteps';  
            $this->crud['update_batch'] = array
                    (
                        'table' => '__nextsteps',
                        'data' => $this->tasks['update_array'],
                        'col' => '__Id',               
                    );            
            $this->crud_lib->_crud('update_batch');   
            
             //insert
            $this->crud['model_name'] = 'nextsteps';  
            $this->crud['insert_batch'] = array
                    (
                        'table' => '__nextsteps',
                        'data' => $this->tasks['insert_array'],             
                    );
            $this->crud_lib->_crud('insert_batch');
            
            //print_array($this->tasks, 0, 'final array');
        }
        
        function redir($dID, $ContactId = NULL, $LinkId, $Step = 1) { 
                    //NOTE> if step=-1 then stop the sequence
            $this->crud_lib->_set_DATAOWNER($dID);
            $this->contact_id = $ContactId;

            //Set up & perform the query
            $this->crud['model_name'] = 'links';
            $this->crud['select'] = array
            (
                '__LinkName',
                '__SequenceId',
                '__DestinationURL',         
            );        
            $this->crud['id'] = $LinkId;
            $results = $this->crud_lib->_crud('retrieve');

            //redirect them if the link exists..
            if ($results)
            {           
                extract($results);
                //if (is_numeric($__SequenceId) && $this->contact_id ) $this->_get_real_campaign_step($__SequenceId, $Step);   //Start/advance a sequence (if data set)

                //now redirect to the new link
                redirect($__DestinationURL, 'location');
            }
            else $this->load->view('default/redir/v_oops.php');
        }
        
        function web_form($dID, $action, $table, $link_id = 'default', $contact_id = FALSE){
            //first, set up the crud environment
            $this->crud_lib->_set_DATAOWNER($dID);
             
            //now look at the input & make safe for databases
            $table = strtolower($table);
            $this->form['input'] = $this->input->post(NULL, TRUE); // returns all POST items with XSS filter 
            foreach ( $this->form['input'] as $key => $value )
            {
                //removes keys that are don't match those in database
                if (substr($key, 0, 2) == '__' OR 
                        !in_array($key, $this->cols[$table])
                        ) unset($this->form['input'][$key]);
            }
            
            //send query
            $this->crud['model_name'] = $table;                     
            $this->crud['input'] = $this->form['input'];  
            switch($action)
            {
                case 'create':
                    $results = $this->crud_lib->_crud('create');
                    if ($table = 'contact') $contact_id = $results;
                    break;
                case 'retrieve':
                    $this->crud['id'] = $contact_id;                 
                    $results = $this->crud_lib->_crud('retrieve');
                    return;
                    break;
                case 'update':
                    $this->crud['id'] = '';                         
                    $this->crud['where_in']['values'] = $this->tasks['campaign_ids'];
                    $this->crud['where_in']['col'] = '__CampaignId';
                    $results = $this->crud_lib->_crud('update');
                    break;               
                default:
                    break;
            }
            $this->form['results'] = $results;
            
            //Now redirect to the link
            if( $link_id != 'default' ) $this->redir($dID, $contact_id, $link_id);
            elseif ( $link_id != 'redir' )  //we need to append results to url
            {
                $url = $this->input->post('url');
                foreach ($this->form['results'] as $k => $v)
                {
                    //
                }
                //redirect(, 'location');
            }
            else $this->load->view('default/redir/v_thanks.php');
            //$this->load->view('default/redir/v_thanks.php');
        }
       
        
        
        
        
        
        
        /*********************Internal Methods **************************/
       
        protected function _do_step($campaign_data, $contact_data, $step_no) {
            $result = FALSE;
            //What type of action we doing here?
            extract($campaign_data[$step_no]);
            switch ($__ActionType)
            {
                case 'EMAIL':
                    //send email
                    $result = $this->_send_email($template_data, $contact_data);
                    break;
                case 'TAG':
                    //apply tag
                    $result = $this->_apply_tag($__TagId, $contact_data['Id']);
                    break;
                //add rest of things like tweet etc here
            }
            
            //perform email/tag etc for this step
            $result = 1;
            return $result;
        }
        
         
        protected function _find_next_step($step_data, $current_step){
            //$current_step = $current_step + 1;
            $retval = FALSE;
            
            //whats the last step?
            $tmp = end($step_data);
            $last_step_no = $tmp['__StepNo']; 
            
            //Is there a step that equals current step + 1?
            $next_step = $current_step + 1;
            if ( isset($step_data[$next_step]) ) 
            {
                $retval['step_no'] = $next_step;
                $retval['delay'] = $step_data[$next_step]['__Delay'];

            }
            //No? Ok, is next_step less than last step?
            elseif ( $next_step < $last_step_no )
            {   //Yes! So cycle through all possible steps till we find it...
                $count = $next_step + 1;    //look for current_step + 2
                while ($count < $last_step_no)
                {               
                    if (isset($step_data[$count])) //...until a step is found, OR...
                    {
                       $retval['step_no'] = $count;
                       $retval['delay'] = $step_data[$count]['__Delay'];
                       break;
                    }
                    else $count++;
                }
            } //... No step is found. (Its the end of campaign - kick back with a beer)

            return $retval;
        }
        
        
           
        
        
        
        
        
        
        /**************** These methods perform the actions of the step ************/        
        protected function _apply_tag($tag_id, $contact_id) {
            //insert into tag_join table
            
            return $success_flag;
        }
        protected function _send_email($template_data, $contact_data) {
            
            //get template data
            
            //get contact(s) data
            
            //send to email class
            
            //return $success_flag;
        }
        protected function _send_letter($template_id, $contact_id) {
            //get template data
            
            //get contact(s) data
            
            //send to letter class
            
            return $success_flag;
        }
        protected function _send_tweet($template_id, $contact_id) {
            //get template data
            
            //get contact(s) data
            
            //send to twitter class
            
            return $success_flag;
        }
        protected function _send_sms($template_id, $contact_id) {
            //get template data
            
            //get contact(s) data
            
            //send to sms class
            
            return $success_flag;
        }

        
        
        
}
   

