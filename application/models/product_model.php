<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Product_model extends CRM_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'product';
        $this->order_by = 'product.ProductName ASC';   //why isnt;' this reflected in datatable? 
        //$this->contactId_fieldname = '__ContactId'; 
        $this->primary_key = 'Id';
    }
    
    /*function get_link_fields($Id_array) {
        $link_array = $this->get_assoc(array_values($Id_array));
        
        print_array($link_array, 1, 'links returned');
    }
    */
    public function joinon_productjoin($where = NULL) {
        //get all product records where ID1 or ID2 = current Id
        //$this->db->where('ContactId', $this->current_ContactId);
        //if ($where != NULL) { $this->db->where($where); }   
        //$this->db->select('*');
         /*$this->db->join(
                'contact', 
                'contact.Id = ' . $this->table_name. '.ContactId',
                'right'
                );       
            */    
         $this->db->join(
                'productjoin', 
                'productjoin.Id = ' . $this->table_name. '.Id',
                'left outer'
                );       
               
        return $this->get();
        //print_array($query, 1);
        
        //Not convinced this is completely right
        
       
    }
    
    
    //Get for assets/invoicing/js/moiinvoice
    
   function get_products($param) {
       $this->db->select('Id, ProductName, ProductPrice, ItemType');
       $return_arr = array();
       
       if ( ! $param) $param = $_GET["term"];
       $this->db->like('ProductName', $param);
       $results = $this->get();
       
       //print_array($results);
       foreach ($results as $row => $array)
       {
           $row_array = array();
           foreach ($array as $col => $val)
           {
                switch ($col) 
                {
                    case 'Id':
                        $row_array['jItemCode'] = $val;
                        break;
                    case 'ProductName':
                        $row_array['jItemDesc'] = $val;
                        break;
                    case 'ProductPrice':
                        $row_array['jItemPrice'] = $val;
                        break;
                    case 'ItemType':
                        $row_array['jItemType'] = $val;
                        break;
                }
           }
           $row_array['jQtyOnHand'] = 1;
           $row_array['jItemWholesale'] = 1;
           $row_array['jItemRetail'] = 1;
           
           
           $return_arr[] = $row_array;
       }
       //print_array($return_arr, 1);
       
       return $return_arr;
     

    /* Toss back results as json encoded array. */
    
   }
    
    
    
    /*
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