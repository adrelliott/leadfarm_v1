<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Template_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = '__Template';
        $this->order_by = '__Id ASC';   //why isnt;' this reflected in datatable? 
        
        $this->primary_key = '__Id';
        if (isset($this->data['view_setup']['rID']))
        {
            $this->current_rID = $this->data['view_setup']['rID'];
        }
        
    }
    
    function template_dropdown() {
        //get all axctive templates
        //$this->db->where('__ActiveYN =', 1);  no need for this complexity
        $this->order_by = '__ActionType ASC';  
        $results = $this->get();
        
        //create dropdown 
        $retval = array();
        $retval[0] = array  //add a blank option
        (
            '__Id' => 0,
            '__Name' => '',
            '__ActionType' => '',
            'template_dropdown' => ''
        );
        
        //combine to make the dropdown
        foreach ($results as $key => $array)
        {
            $array['template_dropdown'] = '[' . $array['__ActionType'] . ' ' . $array['__Id'] .'] ' . $array['__Name'];
            $retval[$key+2] = $array;
        }
        
        return $retval;
    }
    
    
   
      
    
    
    
    
    
}