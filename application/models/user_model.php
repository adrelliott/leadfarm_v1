<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class User_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'contact';
        $this->order_by = 'LastName ASC';   //why isnt;' this reflected in datatable? 
        $this->contactId_fieldname = 'Id'; 
        if (isset($this->data['view_setup']['ContactId']))
        {
            $this->current_ContactId = $this->data['view_setup']['ContactId'];
        }
    }
    
    function add($input, $rID) {
       $input['Id'] = $rID;
       
       $this->save($input, $rID);
       
       return $input['Id'];
    }
}