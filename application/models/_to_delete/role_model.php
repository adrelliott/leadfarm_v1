<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Contactaction_model extends CRM_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'contactaction';
        $this->order_by = '_ActionSubtype DESC';
        $this->contactId_fieldname = 'ContactId';
        $this->action_date_fieldname = 'ActionDate';
        if (isset($this->data['view_setup']['ContactId']))
        {
            $this->current_ContactId = $this->data['view_setup']['ContactId'];
        }
        
        //THIS SI FROM THE SESSION !!!
        $this->current_UserId = '';
        

        //We can maybe move htis MY_MODEL?
        if (isset($this->data['view_setup']['user_data']['UserId']))
        {
            $this->current_UserId = $this->data['view_setup']['user_data']['UserId'];
        }
    }
     
   
    

}