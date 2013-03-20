<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Tags_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = '__tags';
        $this->order_by = 'Id ASC';   //why isnt;' this reflected in datatable? 
        
        
    }
    
    function tag_dropdown() {
        //get all axctive templates
        //$this->db->where('__ActiveYN =', 1); too complex!
        $results = $this->get();
        
        //create dropdown 
        $retval = array();
        $retval[0] = array  //add a blank option
        (
            'Id' => 0,
            'GroupName' => '',
            '__ActiveYN' => '',
            'tag_dropdown' => ''
        );
        
        //now set up the dropdown array
        foreach ($results as $key => $array)
        {
            $array['tag_dropdown'] = '[TAG ' . $array['Id'] .'] ' . $array['GroupName'];
            $retval[$key + 1] = $array;
        }
        
        return $retval;
        
        
        
       /* foreach ($results as $key => $array)
        {
            $results[$key]['tag_dropdown'] = '[TAG ' . $array['Id'] .'] ' . $array['GroupName'];
        }
        
        return $results;*/
    }
    
    
    
    
    
   
      
    
    
    
    
    
}