<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Comms_model extends MY_Model {

    function __construct (){
        parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = '__comms';
        $this->order_by = '__Id DESC';
        $this->primary_key = '__Id';
        $this->contactId_fieldname = '__ContactId';
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
    
  
    
    public function get_single_record($rID, $where = NULL) {
        //get the record with rID. $where set up in dataset['model_params']
        if ($where != NULL) { $this->db->where($where); }
        $query = $this->get($rID);
        
        if (isset($query['__ContactId']))
        {
            $this->current_ContactId = $query['__ContactId'];
        }
        return $query;
    }
    
   /* 
    
    public function get_all_records($where = NULL) {
        //get all records. $where set up in dataset['model_params']
        if ($where != NULL) { $this->db->where($where); }
        return $this->get();
    }
    
    public function get_all_contacts_records($where = NULL) {
        //get all records. $where set up in dataset['model_params']
        if ($where != NULL) { $this->db->where($where); }
        $this->db->where('__ContactId', $this->data['view_setup']['ContactId']);
        return $this->get();
    }
    
     
    
    
    
    
    
    
    
    
    
    public function get_by_rID($rID) {
        //get one record with the ID of $rID
        parent::get($rID);
    }
    
    * */
    

}