<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Filebox_model extends CRM_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'filebox';
        $this->order_by = 'Id DESC';
        $this->contactId_fieldname = 'ContactId';
        $this->leadId_fieldname = 'LeadId';
        //$this->current_UserId = '9999999';
        //We can maybe move htis MY_MODEL?
        
    }
    
    function get_all_opps_records($where = NULL) {
        //get all records. $where set up in dataset['model_params']
        if ($where != NULL) { $this->db->where($where); }
        $this->db->where(
                $this->leadId_fieldname, 
                $this->data['view_setup']['rID']
                );
        return $this->get();
    }
   
    

}