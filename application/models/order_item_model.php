<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Order_item_model extends CRM_Model {
    
    function __construct (){
        parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'orderitem';
        //$this->order_by = '_ValidUntil DESC';   //why isnt;' this reflected in datatable? 
        //$this->contactId_fieldname = 'ContactId';
        
    }
    
  function add($input = array(), $rID){
      //first delete all records with $rID
      $this->delete_by('OrderId', $rID);
      
      //now cycle through and add all new records
      if (count($input))
      {
          //submit query
          foreach ($input as $k => $array)
          {
              $array['OrderId'] = $rID;
              $r[$k] = $this->save($array);
          }
          
      }
      
      return $r;
  }
}