<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Links_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = '__Links';
        $this->order_by = '__Id ASC';   //why isnt;' this reflected in datatable? 
        //$this->contactId_fieldname = '__ContactId'; 
        $this->primary_key = '__Id';
    }
    
    /*function get_link_fields($Id_array) {
        $link_array = $this->get_assoc(array_values($Id_array));
        
        print_array($link_array, 1, 'links returned');
    }
    
    
    function get_link_fields_old($array, $recipients) {
        //Retrieve the link info for each of the links
        $id_array = array();
        foreach ($array as $link => $Id) if (is_numeric($Id)) $id_array[] = $Id;
        $link_array = $this->get($id_array);
        
        print_array($link_array, 1, 'results from link query');
        
        //now combine the links with the recipient info
        if (is_array($recipients))
        {
            foreach ($recipients as $email => $array)
            {
                foreach ($id_array as $k => $v)
                {
                    //$recipients[$email][$k] = $
                }
                
            }
        }
        return ;
        //print_array($results, 1, 'results from link query');
    }*/
    
    
   
    
    

}