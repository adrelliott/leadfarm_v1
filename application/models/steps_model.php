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
        $this->table_name = '__Steps';
        $this->order_by = '__StepNo ASC';   //why isnt;' this reflected in datatable? 
        $this->templateId_fieldname = '__TemplateTagId'; 
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
        return $this->get_assoc();
    }
    
    function get_campaign_steps() {
        //just get the steps for this campaign
        $this->db->where('__CampaignId', $this->current_rID);        
        $this->db->join(
                '__Template', 
                '__Template.__Id = ' . $this->table_name. '.' . $this->templateId_fieldname, 
                'left outer'
                );          
        $results = $this->get_assoc();
        
        //now set up the dropdown array
        foreach ($results as $key => $array)
        {
            $results[$key]['action_dropdown'] = '[' . $array['__ActionType'] . ' ' . $array['__TemplateTagId'] . '] - ' . $array['__Name'] ;
        }
        
        return $results;
    }
    
    function get_all_steps() {
        //just get the steps for this campaign        
        return $this->get_assoc();
    }
    
    
   
      
    
    
    
    
    
}