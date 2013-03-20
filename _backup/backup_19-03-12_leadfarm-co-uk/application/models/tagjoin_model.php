<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Tagjoin_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = '__tagjoin';
        $this->order_by = '__Id ASC';   //why isnt;' this reflected in datatable? 
        
        $this->primary_key = '__Id';
    }
    
    
    
   
      
    
    
    
    
    
}