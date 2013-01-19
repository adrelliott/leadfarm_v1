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
        $this->contactId_fieldname = 'ContactId';
        if (isset($this->data['view_setup']['ContactId']))
        {
            $this->current_ContactId = $this->data['view_setup']['ContactId'];
        }
    }

}