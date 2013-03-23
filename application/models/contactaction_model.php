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
        $this->table_name = 'contactaction';
        $this->order_by = 'ActionDate DESC';
        $this->contactId_fieldname = 'ContactId';
        $this->action_date_fieldname = 'ActionDate';
        if (isset($this->data['view_setup']['ContactId']))
        {
            $this->current_ContactId = $this->data['view_setup']['ContactId'];
        }
        $this->current_UserId = '9999999';
        //We can maybe move htis MY_MODEL?
        if (isset($this->data['view_setup']['user_data']['UserId']))
        {
            $this->current_UserId = $this->data['view_setup']['user_data']['UserId'];
        }
    }
    
    /*function add($input, $rID) {
       if ($rID == 'new')
       {
          $rID = NULL;
       }      
       
       return $this->save($input, $rID);
    }
     * moved this to MY_MOdel
     */
    
    function joinon_Contact_and_Vehicle($where = NULL) {
        //get all records $where joined on contact (ie get fields from contact table too)
        if ($where != NULL) { $this->db->where($where); }        
        $this->db->join(
                'contact', 
                'contact.Id = ' . $this->table_name. '.' . $this->contactId_fieldname, 
                'left outer'
                );        
        $this->db->join(
                '__vehicles', 
                '__vehicles.__Id = ' . $this->table_name. '._VehicleId', 
                'left outer'
                );   
        return $this->get();
    }
    
    function get_todays_bookings($where = NULL) {
        $this->db->where('ActionDate >=', date('Y-m-d 00:00:00', $this->current_day));
        $this->db->where('ActionDate <=', date('Y-m-d 23:59:59' , $this->current_day));
        $this->db->where('ActionType =', 'Booking');
        $result = $this->joinon_Contact_and_Vehicle($where);
        //Sort these into an array sorted by _Status
        foreach ($result as $k => $array)
        {
            $time = explode(' ', $array['ActionDate']);
            $array['time'] = substr($time[1], 0, -3);
            if ( isset($array['_Status'] )) $status = intval($array['_Status']);
            else $status = 0;
            $result['retval'][$status][$array['time']] = $array;
        }
        
        //just make sure that an empty array is returned if no records exists
        if ( ! array_key_exists('retval', $result)) $result['retval'] = array();
        
        return $result['retval'];
    }
    
    function joinon_Contact_and_Vehicle_singlerecord($rID, $where = NULL) {
        //get all records $where joined on contact (ie get fields from contact table too)
        if ($where != NULL) { $this->db->where($where); }        
        $this->db->join(
                'contact', 
                'contact.Id = ' . $this->table_name. '.' . $this->contactId_fieldname, 
                'left outer'
                );        
        $this->db->join(
                '__vehicles', 
                '__vehicles.__Id = ' . $this->table_name. '._VehicleId', 
                'left outer'
                );        
        return $this->get($rID);
    }
    
    
    function get_all_users_records($where = NULL){
        if ($where != NULL) { $this->db->where($where); }
        $this->db->where(
                'UserID', 
                $this->current_UserId
                );
        return $this->get();
    }
     
   
    

}