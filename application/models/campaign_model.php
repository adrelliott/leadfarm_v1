<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Campaign_model extends CRM_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'campaign';
        $this->order_by = 'Id ASC';   //why isnt;' this reflected in datatable? 
        $this->contactId_fieldname = 'ContactId';
    }
    
   
    
    
}