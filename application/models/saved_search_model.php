<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Saved_search_model extends CRM_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'saved_searches';
        $this->order_by = 'Id ASC';   //why isnt;' this reflected in datatable? 
        //$this->contactId_fieldname = 'ContactId';
    }
    
   function saved_search_dropdown_html() {
        //get all axctive templates
        //$this->db->where('__ActiveYN =', 1);  no need for this complexity
        $this->order_by = 'Name ASC';  
        $results = $this->get();        
        
        //create dropdown 
        $retval = array();  
        foreach ($results as $key => $array)
        {
            $array['saved_search_dropdown'] = $array['Name'];
            $retval[$key+1] = $array;
        }
        /*$tmp = array 
        (
            '__Id' => 0,
            '__Name' => '',
            '__ActionType' => 'TAG',
            'template_dropdown' => '[TAG 0] APPLY TAG ONLY',
        );
        array_unshift($retval, $tmp);*/
        return $retval;
    }
    
    
    
}