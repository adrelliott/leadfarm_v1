<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Model - allsearch_model
 * @author Al Elliott
 * Table Name: depends
 * 
 * Description goes here
 * 
 */
class Allsearch_model extends CRM_Model {

    //Define vars used throught the process
    //public $table_name = 'depends';

    //public $order_by = '';   //This is set in CRM_Model. Overwrite here 
    //public $primary_key = ''; //This is set in CRM_Model. Overwrite here
public $fields_for_search = array
            (
                'contact.Id' => 'cId',
                'contact.FirstName' => 'First Name',
                'contact.LastName' => 'Last Name',
                'order.ContactId' => 'CID',
                'order._ItemBought' => 'Item',
                'order._ValidUntil' => 'Season',
                'order.DateCreated' => 'Date Created',
            );

    public function __construct() {
        parent::__construct();
    }
    
    function search($table_name) {
       $retval = FALSE;
       $query_binding = array();
       $sql = '';
       $criteria = $this->input->post();
       $fields = implode(',', array_keys($this->fields_for_search));
       $table = 'order';
       //first create the query from the form
       $sql = "SELECT * FROM {$table} WHERE _ItemBought = ?  ";
       //$sql = "SELECT * FROM {$table_name} ";
       $query_binding[] = $criteria['order_type'];
       
       if (element('order_expire', $criteria, FALSE))
       {
            $sql .= "AND WHERE _ValidUntil = ?";
            $query_binding[] = $criteria['order_expire'];
       }
       
       print_array($query_binding);
       
       $retval = $this->db->query($sql, $query_binding)->result_array();
       
       print_array($retval,0, 'retval');
           
       
       //now do the query
       
       
       //now return the results
       
       
       
       
       
       
   }

}

/* End of file allsearch_model.php */
/* Location: ./application/models/XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/allsearch_model.php */