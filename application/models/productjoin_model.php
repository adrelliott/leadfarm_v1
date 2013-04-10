<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Productjoin_model extends CRM_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'productjoin';
        $this->order_by = 'productjoin.Id DESC';
        $this->contactId_fieldname = 'ContactId';
        $this->leadId_fieldname = 'LeadId';
        $this->primary_key = 'Id';
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
    
    
    
     public function joinon_ContactJoin($where = NULL) {
        //get all product records where ID1 or ID2 = current Id
        //$this->db->where('ContactId', $this->current_ContactId);
        //if ($where != NULL) { $this->db->where($where); }   
        //$this->db->select('*');
         /*$this->db->join(
                'contact', 
                'contact.Id = ' . $this->table_name. '.ContactId',
                'right'
                );       
            */    
         $this->db->join(
                'product', 
                'product.Id = ' . $this->table_name. '.ProductId',
                'right inner'
                );       
               
        return $this->get();
        //print_array($query, 1);
        
        //Not convinced this is completely right
        
       
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
    
     public function get_single_record($rID, $where = NULL) {
        //get the record with rID. $where set up in dataset['model_params']
        if ($where != NULL) { $this->db->where($where); }
        return $this->get($rID);
    }
    
    */
    
    
    
    
    
    
   /* 
    public function get_by_rID($rID) {
        //get one record with the ID of $rID
        parent::get($rID);
    }
    
    */

}