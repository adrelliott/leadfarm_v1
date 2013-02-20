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
        $this->order_by = '__Id ASC';   //why isnt;' this reflected in datatable? 
        $this->contactId_fieldname = '__ContactId'; 
        $this->primary_key = '__Id';
        
    }
    
    function get_steps($CampaignId, $__StepNumber) {
        $this->db->where('__CampaignId >=', $CampaignId);
        $this->db->where('__StepNo =', $__StepNumber);
        $this->db->or_where('__StepNo =', $__StepNumber + 1); //gest this and next step
        return $this->get_assoc();
    }
   
      
    
    
    
    
    
}