<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
    
        protected $dID = '';    //set by $this->_set_DATAOWNER();
        var $tasks = array();   //holds all data on the tasks
        var $crud = array();    //holds all data on the query
        
        public function __construct()    {
            parent::__construct();
            $this->output->enable_profiler(TRUE);
            $this->_reset();    //set up the crud array
        }     
        
        
	function check_for_tasks($dID) {
            $this->_set_DATAOWNER($dID);
            
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
            $this->tasks['to_do'] = $this->_crud('retrieve');
            print_array($this->tasks);
            if( empty($this->tasks['to_do'])){
                echo "no tasks found, time is ".time();
                return;
            }
            
            //remove duplicates
            $this->tasks['to_do'] = array_map(
                    "unserialize", 
                    array_unique(array_map("serialize",$this->tasks['to_do']))
                    );            

            //Get all steps for each campaign that is affected
            $this->tasks['campaign_ids'] = array_keys($this->_make_assoc(
                     $this->tasks['to_do'],
                     '__CampaignId')
                     );
            $this->crud['model_name'] = 'steps';              
            $this->crud['where_in']['values'] = $this->tasks['campaign_ids'];            
            $this->crud['where_in']['col'] = '__CampaignId';            
            $this->tasks['all_steps'] = $this->_crud('retrieve');
            
            //Get all templates for each step that is returned
            $this->tasks['template_ids'] = array_keys($this->_make_assoc(
                     $this->tasks['all_steps'],
                     '__TemplateId')
                     );
            $this->crud['model_name'] = 'template';              
            $this->crud['where_in']['values'] = $this->tasks['template_ids'];            
            $this->crud['where_in']['col'] = '__Id';
            $this->tasks['all_templates'] = $this->_make_assoc(
                    $this->_crud('retrieve'),
                    '__Id');
            
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
            $this->tasks['contact_ids'] = array_keys($this->_make_assoc(
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
            $this->tasks['all_contacts'] = $this->_make_assoc(  //make 'Id' the key
                     $this->_crud('retrieve'),
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
                    //if( $next_step ) echo "<h1>found next step!</h1>".print_array($next_step);
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
            $this->_crud('update_batch');
            
            $this->crud['model_name'] = 'nextsteps';  
            $this->crud['insert_batch'] = array
                    (
                        'table' => '__nextsteps',
                        'data' => $this->tasks['insert_array'],             
                    );
            $this->_crud('insert_batch');
            
            //insert
            print_array($this->tasks, 0, 'final array');
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

        
        /********************** The Database ,ethods *********************/
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
        
        private function _reset() {  //resets the crud (query) array
            $this->crud = array
            (
                'model_name' => '',
                'select' => FALSE,
                'where' => FALSE,
                'where_in' => FALSE,
                'id' => FALSE,
                'assocYN' => FALSE
            );
        }
        
        protected function _crud($type, $method_name = FALSE) {
            $model = $this->_set_up_db_conn($this->crud['model_name']);
            //For instructions on these see http://ellislab.com/codeigniter/user-guide/database/active_record.html
            if ($this->crud['select']) $this->db->select($this->crud['select']);
            if ($this->crud['where']) $this->db->where($this->crud['where']);
            if ($this->crud['where_in']) $this->db->where_in(
                    $this->crud['where_in']['col'], 
                    $this->crud['where_in']['values']
                    );
            switch($type)
            {
                case 'create':
                    $results = $this->$model->save($this->crud['input']);
                    break;
                case 'retrieve':       
                    if ($this->crud['id']) $results = $this->$model->get($this->crud['id']);
                    else $results = $this->$model->get();
                    break;
                case 'update':
                    //do update
                    break;
                case 'delete':
                    //do update
                    break;            
                case 'update_batch':
                    if ($this->crud['update_batch'])  $results = $this->db->update_batch(
                            $this->crud['update_batch']['table'], //what table we updating? 
                            $this->crud['update_batch']['data'], //with what (array), 
                            $this->crud['update_batch']['col'] //What col are we matching?, 
                            ); 
                    break;                
                case 'insert_batch':
                    if ($this->crud['insert_batch']) $results = $this->db->insert_batch(
                            $this->crud['insert_batch']['table'], //what table we updating? 
                            $this->crud['insert_batch']['data'] //with what (array), 
                            );
                    break;                
                case 'where_in':
                    $ids = $this->crud['where_in'];
                    $this->db->where_in(
                            $this->crud['where_in']['col'], 
                            $this->crud['where_in']['values']
                            );
                    if ($this->crud['id']) $results = $this->$model->get($this->crud['id']);
                    else $results = $this->$model->get();
                    break;            
                default:
                    show_error("No CRUD chosen");
                    break;         
            }

            $this->_reset();    //reset the crud array

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
        
}
   

