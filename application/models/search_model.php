<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Model - search_model
 * @author Al Elliott
 * Table Name: XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
 * 
 * Description goes here
 * 
 */
class Search_model extends CRM_Model {


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
    
    
    
    function search($sql) {
        if ($sql) 
        {
            $results['table_data'] = $this->db->query($sql)->result_array();
            $results['table_headers'] = $this->fields_for_search;
                $results['Sql'] = $sql;
                $results['count'] = count($results['table_data']);
            return $results;
        }
        //Set up the vars
        $fields = implode(',', array_keys($this->fields_for_search));
        $table = 'order'; 
        $search_criteria = $this->input->post(); 
        $where = ' WHERE ';
        $conditions = array();
        $table = $this->db->protect_identifiers($table);
        
        //print_array($search_criteria);
        
        //Set up the where statement(s)
        switch ($search_criteria['search_type'])
        {
            //find all opted in contacts
            case 'everyone':
                $where .= " contact.`_OptinEmailYN` != 0 ";
                break;
            
            case 'specific':
                foreach ($search_criteria['item_bought'] as $k => $item_bought)
                {
                    //Get the items bought
                    if ($item_bought) 
                        $conditions['items_bought'][$k] = " ($table.`_ItemBought` = '{$item_bought}' ";
                }

                foreach ($search_criteria['season'] as $k => $season)
                {
                    if (element($k, $conditions['items_bought'], FALSE))
                    {
                        if ($season) 
                                $conditions['or'][] = $conditions['items_bought'][$k] . " AND $table.`_ValidUntil` = '{$season}') ";
                    }
                }
                
                $where .= implode(' OR ', $conditions['or']);
                break;
            
            
        }
        
                    
        $sql = " SELECT DISTINCT $fields FROM " . $this->db->protect_identifiers($table);
        $sql .= " JOIN `contact` ON `contact`.`Id` = `order`.`ContactId` ";
        $sql .= $where;
        $sql .= " AND `order`.`_ActiveRecordYN` = '1' "; 
        $sql .= " AND `contact`.`_ActiveRecordYN` = '1' "; 
        $sql .= " AND `order`.`_dID` = '22232' "; 
        $sql .= " AND `contact`.`_dID` = '22232' ";
        //echo "<p>here comes where for row $k: $where</p>";

        //$results = $this->db->query($sql)->result_array();
        
        $results['all_results'] = $this->db->query($sql);
       
         //$results['table_data'] = $this->db->query($sql)->result_array();
         $results['table_data'] = $results['all_results']->result_array();
         
                    $results['table_headers'] = $this->fields_for_search;
                    $results['Sql'] = $sql;
            
                    
        //return $results;

        //remove duplictes
            
            echo "<p>Count od results BEFORE desup: " . count($results['table_data']) . "</p>";
            $results['table_data'] = $this->to_assoc($results['table_data']);
        //$results['table_data'] = array_unique($results['table_data']);
            echo "<p>Count od results AFTER desup: " . count($results['table_data']) . "</p>";
            
            // $this->load->dbutil();
            //$results['csv'] = $this->dbutil->csv_from_result($results['all_results'], ",","\n");
            die();
        
        //print_array($results, 1);
        //return $results;
         
    }
        
        
        function search_old44($sql) {
        if ($sql) 
        {
            $results['table_data'] = $this->db->query($sql)->result_array();
            $results['table_headers'] = $this->fields_for_search;
                $results['Sql'] = $sql;
                $results['count'] = count($results['table_data']);
            return $results;
        }
        //Set up the vars
        $fields = implode(',', array_keys($this->fields_for_search));
        $table = 'order'; 
        $search_criteria = $this->input->post(); 
        $where = ' WHERE ';
        
        //Set up the where statement(s)
        foreach ($search_criteria['order_type'] as $k => $v)
        {
            if ($v)
            {
                
                //$sql = '';
               // //Deal with the 'not in' queries
                
                if ($search_criteria['order_type_operator'][$k] === 'equalor') 
                {
                    $item_bought = $this->db->escape($search_criteria['order_type'][$k]);
                    $where .= " OR (`order`.`_ItemBought` = $item_bought ";
                    $valid_until = $search_criteria['order_expire'][$k];
                    if ($valid_until)
                    {
                         $where .= ' AND `order`.`_ValidUntil` = ' .  $this->db->escape($valid_until);
                    }
                    $where .= ") ";
                    
                    $sql = " SELECT $fields FROM " . $this->db->protect_identifiers($table);
                    $sql .= " JOIN `contact` ON `contact`.`Id` = `order`.`ContactId` ";
                    $sql .= $where;
                    $sql .= " AND `order`.`_ActiveRecordYN` = '1' "; 
                    $sql .= " AND `contact`.`_ActiveRecordYN` = '1' "; 
                    $sql .= " AND `order`.`_dID` = '22232' "; 
                    $sql .= " AND `contact`.`_dID` = '22232' ";
                    //echo "<p>here comes where for row $k: $where</p>";
                    
                    $results = $this->db->query($sql)->result_array();
                     //manipulate results
                    //echo "<h1>No of orders in this table count of array is " . count($results) . "</h1>";
                   // print_array($results, 0, 'all order records (dups included)');
                    
                }
                //...AND
                elseif ($search_criteria['order_type_operator'][$k] === 'equaland') 
                {
                    $item_bought = $this->db->escape($search_criteria['order_type'][$k]);
                    $where .= " OR (`order`.`_ItemBought` = $item_bought ";
                    $valid_until = $search_criteria['order_expire'][$k];
                    if ($valid_until)
                    {
                         $where .= ' AND `order`.`_ValidUntil` = ' .  $this->db->escape($valid_until);
                    }
                    $where .= ") ";
                    
                    $sql = " SELECT $fields FROM " . $this->db->protect_identifiers($table);
                    $sql .= " JOIN `contact` ON `contact`.`Id` = `order`.`ContactId` ";
                    $sql .= $where;
                    $sql .= " AND `order`.`_ActiveRecordYN` = '1' "; 
                    $sql .= " AND `contact`.`_ActiveRecordYN` = '1' "; 
                    $sql .= " AND `order`.`_dID` = '22232' "; 
                    $sql .= " AND `contact`.`_dID` = '22232' ";
                    //echo "<p>here comes where for row $k: $where</p>";
                    
                    $results = $this->db->query($sql)->result_array();
                     //manipulate results
                    //echo "<h1>No of orders in this table count of array is " . count($results) . "</h1>";
                   // print_array($results, 0, 'all order records (dups included)');
                }
                else    //must be the first row
                {
                    $item_bought = $this->db->escape($search_criteria['order_type'][$k]);
                    $where .= " (`order`.`_ItemBought` = $item_bought ";
                    $valid_until = $search_criteria['order_expire'][$k];
                    if ($valid_until)
                    {
                         $where .= ' AND `order`.`_ValidUntil` = ' .  $this->db->escape($valid_until);
                    }
                    $where .= ") ";
                    
                    $sql = " SELECT $fields FROM " . $this->db->protect_identifiers($table);
                    $sql .= " JOIN `contact` ON `contact`.`Id` = `order`.`ContactId` ";
                    $sql .= $where;
                    $sql .= " AND `order`.`_ActiveRecordYN` = '1' "; 
                    $sql .= " AND `contact`.`_ActiveRecordYN` = '1' "; 
                    $sql .= " AND `order`.`_dID` = '22232' "; 
                    $sql .= " AND `contact`.`_dID` = '22232' ";
                    
                    //echo "<p>here comes where for row $k: $where</p>";
                    
                    $results['table_data'] = $this->db->query($sql)->result_array();
                    $results['table_headers'] = $this->fields_for_search;
                    $results['Sql'] = $sql;
                     //manipulate results
                    //echo "<h1>No of orders in this table count of array is " . count($results) . "</h1>";
                    //print_array($results, 0, 'all order records (dups included)');
                    
                }
                
                //echo "<p>here comes sql for row $k: $where</p>";
                return $results;
            }
        }
        
        
        
        //print_array($search_criteria);
        
        //create super table with all orders and the contact details
        /*$sql = " SELECT $fields FROM " . $this->db->protect_identifiers($table);
        $sql .= " JOIN `contact` ON `contact`.`Id` = `order`.`ContactId` ";
        $sql .= $where;
        $sql .= " AND `order`.`_ActiveRecordYN` = '1' "; 
        $sql .= " AND `contact`.`_ActiveRecordYN` = '1' "; 
        $sql .= " AND `order`.`_dID` = '22232' "; 
        $sql .= " AND `contact`.`_dID` = '22232' ";
        $results = $this->db->query($sql)->result_array();
        */
        
        //manipulate results
       /* echo "<h1>No of orders in this table count of array is " . count($results) . "</h1>";
        print_array($results, 0, 'all order records (dups included)');
        $results = $this->to_assoc($results);
        echo "<h1>No of contacts in this table count of array is " . count($results) . "</h1>";
        print_array($results, 0, 'all order records (dups REMOVED)');
        */
        
    }
    
    
    
    function search_2() {
        //set up vars
        $retval = array();
        $search_criteria = $this->input->post();    // @TODO Make this secure
        $fields = implode(',', array_keys($this->fields_for_search));
        $table = 'contact'; 
        $sql = array();
            
         print_array($search_criteria);
         
        //now cycle through each of the submitted arrays and set up the query
        foreach ($search_criteria['order_type'] as $k => $v)
        {
            if ($v)
            {
                //Deal with the 'not in' queries
                if ($search_criteria['order_type_operator'][$k] === 'notequal') 
                {
                    $nothing = 'nothing';
                }
                //else, just create normal queries
                elseif ($search_criteria['order_type_operator'][$k] === 'equalor') 
                {
                    $sql[$k] = " UNION SELECT " . $fields;
                    $sql[$k] .= " FROM " . $this->db->protect_identifiers($table);
                    $sql[$k] .= " JOIN `order` ON `order`.`ContactId` = `contact`.`Id` ";
                    $sql[$k] .= " WHERE " . "`order`.`_ItemBought` = " . $this->db->escape($v);
                    if ($search_criteria['order_expire'][$k])
                    {
                         $sql[$k] .= ' AND `order`.`_ValidUntil` = ' .  $this->db->escape($search_criteria['order_expire'][$k]) . ' ';
                    }
                    $sql[$k] .= " AND `order`.`_ActiveRecordYN` = '1' "; 
                    $sql[$k] .= " AND `contact`.`_ActiveRecordYN` = '1' "; 
                    $sql[$k] .= " AND `order`.`_dID` = '22232' "; 
                    $sql[$k] .= " AND `contact`.`_dID` = '22232' ";
                }
                elseif ($search_criteria['order_type_operator'][$k] === 'equalorand') 
                {
                    $sql[$k] = " SELECT " . $fields;
                    $sql[$k] .= " FROM " . $this->db->protect_identifiers($table);
                    $sql[$k] .= " JOIN `order` ON `order`.`ContactId` = `contact`.`Id` ";
                    $sql[$k] .= " WHERE " . "`order`.`_ItemBought` = " . $this->db->escape($v);
                    if ($search_criteria['order_expire'][$k])
                    {
                         $sql[$k] .= ' AND `order`.`_ValidUntil` = ' .  $this->db->escape($search_criteria['order_expire'][$k]) . ' ';
                    }
                    $sql[$k] .= " AND `order`.`_ActiveRecordYN` = '1' "; 
                    $sql[$k] .= " AND `contact`.`_ActiveRecordYN` = '1' "; 
                    $sql[$k] .= " AND `order`.`_dID` = '22232' "; 
                    $sql[$k] .= " AND `contact`.`_dID` = '22232' ";
                }
            }
        }
        
       print_array($sql); 
       $sql = join(' ', array_values($sql));
       echo "<p>$sql</p>";
       
       $results = $this->db->query($sql)->result_array();
       
       //de dup
       $results = $this->to_assoc($results);
       
       
       echo ', number of rows= ' . count($results);
       $dup = array_count_values(array_keys($results));
       arsort($dup);
        print_array($dup);
        print_array($results);
        return;
       
       
       $retval = $this->to_assoc($results);
       ksort($retval);
       
        echo ", count of array = " . count($retval);
       $dup = array_count_values(array_keys($retval));
       arsort($dup);
        print_array($dup);
        print_array($retval);
       
       //print_array($results, 0, 'number of rows= ' . count($results));
       
       
return;
//now join the arrays with union
        //$sql = join(' ', $sql);
        print_array($sql);
        //now do the query
        foreach ($sql as $k => $stm)
        {
            $retval[$k] = $this->db->query($stm);
            echo '<h1>Total Results: ' . $retval[$k]->num_rows() . '</h1>';
                //print_array($retval[$k]->result_array());
        }
        
       $sql = join(' ', array_values($sql));
       echo "<p>this si sql" . $sql . "</p>";
       $retval['union'] = $this->db->query($sql);
       echo '<h1>Total Results of union: ' . $retval['union']->num_rows() . '</h1>';
       $retval = $this->to_assoc($retval['union']->result_array());
       ksort($retval);
       
        echo "count of array = " . count($retval);
       $dup = array_count_values(array_keys($retval));
       arsort($dup);
        print_array($dup);
        print_array($retval);
    }
        
        function search_old() {
            $retval = array();
            $search_criteria = $this->input->post();    // @TODO Make this secure
            $fields = implode(',', array_keys($this->fields_for_search));
            $where = array();
            $table = 'contact';
            $select = "SELECT contact.Id, contact.FirstName FROM ";
            $select .= $this->db->protect_identifiers($table);
            $select .= " RIGHT JOIN `order` ON `order`.`ContactId` = `contact`.`Id` WHERE ";
            //$select = "SELECT c.Id, c.FirstName FROM contact WHERE ";
            //$select = "SELECT `c`.`Id`, `c`.`FirstName` FROM `contact` WHERE ";
            
            print_array($search_criteria);
            
            foreach ($search_criteria['order_type'] as $k => $v)
            {
                if ($v)
                {
                    //Deal with the 'not in' queries
                    if ($search_criteria['order_type_operator'][$k] === 'notequal') 
                    {
                        $sql[$k] = "SELECT `c`.`Id`, `c`.`FirstName` FROM `contact` `c` WHERE `Id` NOT IN ( SELECT `ContactId` FROM `order` WHERE `_ItemBought` = 'Junior Membership'  AND `_ValidUntil` = '2009/10') ";
                    }
                    else
                    {
                        //$where[$k] = $select . ' JOIN `order` ON `contact`.`Id` = `order`.`ContactId` ';
                        $where[$k] = ' (`order`.`_ItemBought` = ' . $this->db->escape($v) .' ';

                        if ($search_criteria['order_expire'][$k]) 
                            $where[$k] .= ' AND `order`.`_ValidUntil` = ' .  $this->db->escape($search_criteria['order_expire'][$k]) . ' ';
                        $where[$k] .= ') ';
                        
                        if ($k + 1 < count($search_criteria['order_type']))
                        {
                            $where[$k] .= " AND ";
                        }
                        elseif ($k + 1 == count($search_criteria['order_type']))
                        {
                            $where[$k] .= " AND `order`.`_ActiveRecordYN` = '1' AND `contact`.`_ActiveRecordYN` = '1' ";
                            $where[$k] .= " AND `order`.`_dID` = '22232' AND `contact`.`_dID` = '22232' ";
                        }
                        
                    }
                }
            }
            
            $sql = $select . join(' ', array_values($where));
            echo $sql;
            
            $retval = $this->db->query($sql);
                echo '<h1>Total Results: ' . $retval->num_rows() . '</h1>';
                //print_array($retval[$k]->result_array());
                
                
            /*foreach ($sql as $k => $statement)
            {
                $retval[$k] = $this->db->query($statement);
                echo '<h1>Total Results: ' . $retval[$k]->num_rows() . '</h1>';
                //print_array($retval[$k]->result_array());
            }*/
       
       
        
                
            
        }

}

/* End of file search_model.php */
/* Location: ./application/models//search_model.php */