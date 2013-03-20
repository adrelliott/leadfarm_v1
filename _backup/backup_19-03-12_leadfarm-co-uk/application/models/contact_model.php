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
        if (isset($this->data))
        {
            if (isset($this->data['view_setup']['ContactId']))
            {
                $this->current_ContactId = $this->data['view_setup']['ContactId'];
            }
        }
    }
    
    function get_contacts_details() {
        return $this->get($this->data['view_setup']['ContactId']);
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
    
    
    /*public function get_single_record($rID, $where = NULL) {
        //get the record with rID. $where set up in dataset['model_params']
        if ($where != NULL) { $this->db->where($where); }
        return $this->get($rID);
    }
    
    */
    
    function get_subscription_fields($Id) {
        $fields = array('Id', 'Email', '_OptinEmailYN', '_OptinSmsYN', '_OptinTwitterYN', '_OptinSurfaceMailYN', '_OptinNewsletterYN', '_OptinPref');
        $this->db->select($fields);
        return $this->get($Id);
    }
    
    
    
    
     function add_to_infusionosft($input, $rID) {
        //mimic infusionsoft creation of record
       /*if ($rID == 'new')
       {         
//Clean up the input array and remove non-infusionsoft fields 
            $input_infusion = clean_data($this->input->post(), 'infusionsoft'); 
            
            //set the ID via infusionsoft
            $this->load->model('crm_model');
            $input['Id'] = $this->crm_model->infusion_add(
                    $this->table_name, $input_infusion
                    );
            $rID = NULL;
       }
       else
       {
           $input['Id'] = $rID;
       }*/
       
       $this->save($input, $rID);
       
       return $rID;
    }
    
    
    
    
    
    
    
   /* public function get_by_rID($rID) {
        //get one record with the ID of $rID
        parent::get($rID);
    }*/
    
    

}