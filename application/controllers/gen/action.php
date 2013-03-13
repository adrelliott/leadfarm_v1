<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include(APPPATH . 'libraries/Automation/Crud_lib.php');

class Action extends Crud_lib {
    
        var $tasks = array();   //holds all data on the tasks
        var $data = array();   //Not used at the moment        
        var $form = array();    //holds all data from the form
        var $cols = array       //alows us to remove bad fieldnames from $_POST
        (
            'contact' => array
            (
                'FirstName', 'LastName', 'Email', 'Username', 'Password'
            ),
        );
        var $mandatory_fields = array   //these are the minimum cols to retrieve from the contact query
        (
            'contact' => array
                (
                'Id', 'Email', '_OptinEmailYN', '_OptinSmsYN', '_OptinTwitterYN', '_OptinSurfaceMailYN', '_OptinNewsletterYN', '_ActiveUserYN'
                ),
            'link' => NULL,
            '__tags' => array
            (
                '__Id',
            ),
        );
        
        public function __construct()    {
            parent::__construct();
        }     
        
        
	function check_for_tasks($dID) {
            $this->set_DATAOWNER($dID);
            
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
            $this->tasks['to_do'] = $this->crud('retrieve');
            
print_array($this->tasks, 0, "outstanding tasks - time = ".time());
            if( empty($this->tasks['to_do'])){
                echo "no tasks found, time is ".time();
                return;
            }
            
            //remove duplicate tasks to do
            $this->tasks['to_do'] = array_map(
                    "unserialize", 
                    array_unique(array_map("serialize",$this->tasks['to_do']))
                    );            
            
            //Get all steps for each campaign that is affected
            $this->tasks['campaign_ids'] = array_keys($this->make_assoc(
                     $this->tasks['to_do'],
                     '__CampaignId')
                     );
            
            $this->crud['model_name'] = 'steps';              
            $this->crud['where_in']['values'] = $this->tasks['campaign_ids'];            
            $this->crud['where_in']['col'] = '__CampaignId';            
            $this->tasks['all_steps'] = $this->crud('retrieve');            

            //Get all templates for each step that is returned
            $this->tasks['template_ids'] = array_keys($this->make_assoc(
                     $this->tasks['all_steps'],
                     '__TemplateId')
                     );            
            $this->tasks['template_ids'] = array_filter($this->tasks['template_ids']);
            
            //if we have templates returned, then convert them to an array that _send_email or _send_tweet can recognise
            if ( ! empty($this->tasks['template_ids']) )
            {
                $this->crud['model_name'] = 'template';              
                $this->crud['where_in']['values'] = $this->tasks['template_ids'];            
                $this->crud['where_in']['col'] = '__Id';
                $this->tasks['all_templates'] = $this->make_assoc(
                        $this->crud('retrieve'),
                        '__Id');
                
                //now get a list of the queries we need to do to populate these templates
                $this->tasks['queries'] = $this->_get_cols($this->tasks['all_templates']);
            }
            
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
                if (isset($this->tasks['queries']['cleaned_template'][$template_id]))
                    $template_data = $this->tasks['queries']['cleaned_template'][$template_id];
                else $template_data = FALSE;
                $tmp_array[$camp_id][$step_no]['template_data'] = $template_data;
            }
            $this->tasks['all_data'] = $tmp_array;  //this is a master array for all task! 

        
        # 3. Now get the contact details for these tasks
            $this->tasks['contact_ids'] = array_keys($this->make_assoc(
                     $this->tasks['to_do'],
                     '__ContactId')
                     );
            
            $this->crud['model_name'] = 'contact';              
                //get the most common fields used in templates
            $this->crud['select'] = $this->tasks['queries']['cols']['contact'];
            $this->crud['where_in']['values'] = $this->tasks['contact_ids'];            
            $this->crud['where_in']['col'] = 'Id';            
            $this->tasks['all_contacts'] = $this->make_assoc(  //make 'Id' the key
                     $this->crud('retrieve'),
                     'Id'
                    );
            //************* should we be getting other data here from other tables??***
        
        # 4. Now perform each task    
            foreach ($this->tasks['to_do'] as $k => $task_details)
            {
                $campaign_data = $this->tasks['all_data'][$task_details['__CampaignId']];
                if ($this->tasks['all_contacts'][$task_details['__ContactId']]) $contact_data = $this->tasks['all_contacts'][$task_details['__ContactId']]; else return;
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
            
             //insert new tasks (if there are any)
            if( isset($this->tasks['insert_array'] ))
            {
                $this->crud['model_name'] = 'nextsteps';  
                $this->crud['insert_batch'] = array
                        (
                            'table' => '__nextsteps',
                            'data' => $this->tasks['insert_array'],             
                        );

                print_array($this->crud['insert_batch'], 0, 'insert_batch');
                $this->crud('insert_batch');
            }
            
            //update...
            if( isset($this->tasks['update_array'] ))
            {
                $this->crud['model_name'] = 'nextsteps';  
                $this->crud['update_batch'] = array
                        (
                            'table' => '__nextsteps',
                            'data' => $this->tasks['update_array'],
                            'col' => '__Id',               
                        );            
                print_array($this->crud['update_batch'], 0, 'update_batch');
                $this->crud('update_batch');   
            }
            
            //print_array($this->tasks, 0, 'final array');
        }
        
        function redir($dID, $ContactId = NULL, $LinkId, $Step = 1) { 
                    //NOTE> if step=-1 then stop the sequence
            $this->set_DATAOWNER($dID);
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
            $results = $this->crud('retrieve');

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
            $this->set_DATAOWNER($dID);
             
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
                    $results = $this->crud('create');
                    if ($table = 'contact') $contact_id = $results;
                    break;
                case 'retrieve':
                    $this->crud['id'] = $contact_id;                 
                    $results = $this->crud('retrieve');
                    return;
                    break;
                case 'update':
                    $this->crud['id'] = '';                         
                    $this->crud['where_in']['values'] = $this->tasks['campaign_ids'];
                    $this->crud['where_in']['col'] = '__CampaignId';
                    $results = $this->crud('update');
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
       
        /*
         * This method cycles through all the temnplates (passed as $template_ids) and extracts all the cols required to retrive from the contact database
         * It also makes all vars in the temnplate lower case if it is an Email (PostageApp doesn;t like mixed case)
         */
        protected function _get_cols($template_ids = array(), $mandatory_fields = FALSE) {
            //set up method
            if( empty($template_ids)) return FALSE;
            $reval = array(); 
            
            //1. cycle though the templates passed & extract vars
            foreach ($template_ids as $id => $array)
            {
                //Find all the vars (wrapped in '{{ }}')
                preg_match_all(
                        '/\{{([^}]+)\}}/', 
                        $array['__Subject'], 
                        $retval['cols'][$id]
                        );
                preg_match_all(
                        '/\{{([^}]+)\}}/', 
                        $array['__Content'], 
                        $retval['cols'][$id]
                        );
                
                //Add them to the list of cols to retrieve
                foreach($retval['cols'][$id][1] as $k => $var)
                {
                    $explode = explode('.', $var);
                    $this->mandatory_fields[strtolower($explode[0])][] = $explode[1];
                }
                
                //change vars to lower case in the template (for PostageApp only)
                if ($array['__ActionType'] == 'EMAIL')
                {
                    foreach($retval['cols'][$id][0] as $k => $var)
                    {
                        $template_ids[$id]['__Subject'] = str_replace($var, strtolower($var), $template_ids[$id]['__Subject']);
                        $template_ids[$id]['__Content'] = str_replace($var, strtolower($var), $template_ids[$id]['__Content']);
                    }
                }
            }
            $retval['cleaned_template'] = $template_ids;    //
            $retval['cols'] = $this->mandatory_fields;
            
            //now remove any duplicates in the cols_rqd array
            foreach ( $retval['cols'] as $table => $array)
            {
                $retval['cols'][$table] = array_unique($array);                   
            }
            
            return $retval;
        }
        
        
        
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
            $success_flag = FALSE;
//insert into tag_join table
            
            return $success_flag;
        }
        protected function _send_email($template_data, $contact_data) {
            $success_flag = FALSE;
            $retval['headers'] = array(
                'subject' => 'Example Subject',
                'from'    => 'sender@example.com'
              ); 
            $retval['message'] = array(
                'text/html'   => $template_data['__Content'],
                'text/plain'   => $template_data['__ContentPlaintext']                
              );
            $retval['test-template'] = $template_data['__TemplateName'];
            
            //debug:    REMOVE THIS WHEN GOING LIVE!!!
            //check $config['recipient_override'] in postageapp/config!!!!!;
            
            if( ! isset($contact_data[0])) $contact_data = array($contact_data);
            {
                foreach ($contact_data as $key => $array)
                {
                    extract($array);
                    if ($_ActiveUserYN == 1 && '_OptinEmailYN' == 1)
                    {
                        $retval['recipients'][$Email] = array();
                        foreach($retval['recipients']['Email'] as $k => $v)
                        {
                            $retval['recipients']['Email'][strtolower($key)] = $v;
                        }
                    }
                }                
            }
            print_array($retval['recipients'], 0, 'retval_recipients for ');
                    //sort the incoming data ready to pass to PostageApp
            //get template data
            
            //get contact(s) data
            
            //send to email class
            
            //return $success_flag;
        }
        protected function _send_letter($template_id, $contact_id) {
            $success_flag = FALSE;
            //get template data
            
            //get contact(s) data
            
            //send to letter class
            
            return $success_flag;
        }
        protected function _send_tweet($template_id, $contact_id) {
            $success_flag = FALSE;
            //get template data
            
            //get contact(s) data
            
            //send to twitter class
            
            return $success_flag;
        }
        protected function _send_sms($template_id, $contact_id) {
            $success_flag = FALSE;
            //get template data
            
            //get contact(s) data
            
            //send to sms class
            
            return $success_flag;
        }
}
   

