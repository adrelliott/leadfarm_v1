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
    }
    
    
    
    public function get_all_records($where = NULL) {
        //get all records. $where set up in dataset['model_params']
        if ($where != NULL) { $this->db->where($where); }
        return $this->get();
    }
    
    public function get_all_contacts_records($where = NULL) {
        //get all records. $where set up in dataset['model_params']
        if ($where != NULL) { $this->db->where($where); }
        $this->db->where('ContactId', $this->data['view_setup']['ContactId']);
        return $this->get();
    }
    
     public function get_single_record($rID, $where = NULL) {
        //get the record with rID. $where set up in dataset['model_params']
        if ($where != NULL) { $this->db->where($where); }
        $this->db->where('ContactId', $this->data['view_setup']['ContactId']);
        return $this->get($rID);
    }
    
    
    
    
    
    
    
    
    
    public function get_by_rID($rID) {
        //get one record with the ID of $rID
        parent::get($rID);
    }
    
    

}