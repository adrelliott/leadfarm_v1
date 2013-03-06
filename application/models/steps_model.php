<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Steps_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = '__steps';
        $this->order_by = '__StepNo ASC';   //why isnt;' this reflected in datatable? 
        $this->templateId_fieldname = '__TemplateId'; 
        $this->primary_key = '__Id';
        if (isset($this->data['view_setup']['rID']))
        {
            $this->current_rID = $this->data['view_setup']['rID'];
        }
        
    }
    
    function get_steps($CampaignId, $__StepNumber) {
        $this->db->where('__CampaignId >=', $CampaignId);
        $this->db->where('__StepNo =', $__StepNumber);
        $this->db->or_where('__StepNo =', $__StepNumber + 1); //gest this and next step
        $result = $this->get_assoc();
        
        return $result;
    }
    
    function get_campaign_steps() {
        //just get the steps for this campaign
        $this->db->where('__CampaignId', $this->current_rID);        
        $this->db->join(
                '__template', 
                '__template.__Id = ' . $this->table_name. '.' . $this->templateId_fieldname, 
                'left outer'
                );          
        $results = $this->get();
        
        //print_array($results,1);
        
        //now set up the dropdown array
        $retval = array();
        foreach ($results as $key => $array)
        {
            $array['action_dropdown'] = '[' . $array['__ActionType'] . ' ' . $array['__TemplateId'] . '] - ' . $array['__Name'] ;
            $retval[$key + 1] = $array;
        }
        
         //if there's no results set up a blank step ready to be duplicated
        if ( !$retval)
        {
            $retval = Array();
            $retval[1] = Array
            (
                '__Id' => '',
                '__CampaignId' => $this->current_rID,
                '__StepName' => '',
                '__ActionType' => '',
                '__TemplateId' => 0,
                '__TagId' => 0,
                '__StepNo' => 1,
                '__Delay' => 0,
                '__Name' => '',
                'action_dropdown' => ''
            );
        }
        
        return $retval;
    }
    
    function get_all_steps() {
        //just get the steps for this campaign        
        return $this->get_assoc();
    }
    
    
   
      
    
    
    
    
    
}