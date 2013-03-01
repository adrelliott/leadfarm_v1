<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Lead_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'Lead';
        $this->order_by = 'Id DESC';
        $this->contactId_fieldname = 'ContactID';
        if (isset($this->data['view_setup']['ContactId']))
        {
            $this->current_ContactId = $this->data['view_setup']['ContactId'];
        }
        //$this->current_UserId = '9999999';
        //We can maybe move htis MY_MODEL?
        if (isset($this->data['view_setup']['user_data']['UserId']))
        {
            $this->current_UserId = $this->data['view_setup']['user_data']['UserId'];
        }
    }
    
    function join_on_contact($where = NULL) {
        //get all records $where joined on contact (ie get fields from contact table too)
        if ($where != NULL) { $this->db->where($where); }        
        $this->db->join(
                'Contact', 
                'Contact.Id = ' . $this->table_name. '.' . $this->contactId_fieldname, 
                'left outer'
                );  
        $this->order_by = 'Lead.Id DESC';
        return $this->get();
    }
   
    

}