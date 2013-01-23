<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Contactaction_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'ContactAction';
        $this->order_by = 'ActionDate DESC';
        $this->contactId_fieldname = 'ContactId';
        if (isset($this->data['view_setup']['ContactId']))
        {
            $this->current_ContactId = $this->data['view_setup']['ContactId'];
        }
    }
    
    function add($input, $rID) {
        //mimic infusionsoft creation of record
       if ($rID == 'new')
       {
          //$input['Id'] = rand(7000, 8000);
          $rID = NULL;
       }      
       
       return $this->save($input, $rID);
    }
    
    function joinon_Contact_and_Vehicle($where = NULL) {
        //get all records $where joined on contact (ie get fields from contact table too)
        if ($where != NULL) { $this->db->where($where); }        
        $this->db->join(
                'Contact', 
                'Contact.Id = ' . $this->table_name. '.' . $this->contactId_fieldname, 
                'left outer'
                );        
        $this->db->join(
                '__Vehicles', 
                '__Vehicles.__Id = ' . $this->table_name. '._VehicleId', 
                'left outer'
                );        
        return $this->get();
    }
    
    function joinon_Contact_and_Vehicle_singlerecord($rID, $where = NULL) {
        //get all records $where joined on contact (ie get fields from contact table too)
        if ($where != NULL) { $this->db->where($where); }        
        $this->db->join(
                'Contact', 
                'Contact.Id = ' . $this->table_name. '.' . $this->contactId_fieldname, 
                'left outer'
                );        
        $this->db->join(
                '__Vehicles', 
                '__Vehicles.__Id = ' . $this->table_name. '._VehicleId', 
                'left outer'
                );        
        return $this->get($rID);
    }


}