<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Contactgroup_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'Contactgroup';
        $this->order_by = 'Id ASC';   //why isnt;' this reflected in datatable? 
        if (isset($this->data['view_setup']['rID']))
        {
            $this->current_rID = $this->data['view_setup']['rID'];
        }
        
    }
    
    function tag_dropdown() {
        //get all axctive templates
        $this->db->where('__ActiveYN =', 1);
        $results = $this->get();
        //create dropdown
        
        foreach ($results as $key => $array)
        {
            $results[$key]['tag_dropdown'] = '[TAG ' . $array['Id'] .'] ' . $array['GroupName'];
        }
        
        return $results;
    }
    
    
    
    
    
   
      
    
    
    
    
    
}