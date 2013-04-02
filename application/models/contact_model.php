<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Contact_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'contact';
        $this->order_by = 'LastName ASC';   //why isnt;' this reflected in datatable? 
        $this->contactId_fieldname = 'Id';
        //$this->primary_key = 'Id';
        /*if (isset($this->data))   //now set in MY_Model
        {
            if (isset($this->data['view_setup']['ContactId']))
            {
                $this->current_ContactId = $this->data['view_setup']['ContactId'];
            }
        }*/
    }
    
    function get_contacts_details() {
        return $this->get($this->data['view_setup']['ContactId']);
        //return $this->get($this->current_ContactId);
    }
    
        
    public function master_search() {
        //get all records. $where set up in dataset['model_params']
        $this->db->join(
                '__vehicles', 
                '__vehicles.__ContactId = ' . $this->table_name. '.' . $this->contactId_fieldname ,
                'left outer'
                );   
        return $this->get();
    }
    
    
    function get_subscription_fields($Id) {
        $fields = array('Id', 'Email', '_OptinEmailYN', '_OptinSmsYN', '_OptinTwitterYN', '_OptinSurfaceMailYN', '_OptinNewsletterYN', '_OptinPref');
        $this->db->select($fields);
        return $this->get($Id);
    }
    

}