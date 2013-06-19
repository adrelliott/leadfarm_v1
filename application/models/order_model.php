<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Order_model extends CRM_Model {
    
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
    public $fields_for_export = array
            (
                'contact.Id' => 'cId',
                'contact._IsOrganisationYN' => 'Org YN',
                'contact.Title' => 'Title',
                'contact.FirstName' => 'First Name',
                'contact.LastName' => 'Last Name',
                'contact.Nickname' => 'Known As',
                'contact.Email' => 'Email 1',
                'contact.EmailAddress2' => 'Email 2',
                'contact._Gender' => 'Gender',
                'contact.Birthday' => 'DoB',
                'contact._LegacyMembershipNo' => 'Memb No',
                'contact._OrganisationName' => 'Org Name',
                'contact.StreetAddress1' => 'Address 1',
                'contact.StreetAddress2' => 'Address 2',
                'contact._StreetAddress3' => 'Address 3',
                'contact.City' => 'Town',
                'contact.State' => 'County',
                'contact.Country' => 'Country',
                'contact.PostalCode' => 'Postcode',
                'contact.Phone1' => 'Landline',
                'contact.Phone2' => 'Home',
                'contact.Phone3' => 'Mobile',
                'contact.Phone4' => 'Overseas',
                'contact._TwitterName' => 'Twitter',
                'contact._OptinEmailYN' => 'Email Opt In YN',
                'contact._OptinSmsYN' => 'SMS Opt In YN',
                'contact._OptinTwitterYN' => 'Twitter Opt In YN',
                'contact._OptinSurfaceMailYN' => 'Post Opt In YN',
                'contact._OptinNewsletterYN' => 'Newsletter Opt In YN',
                'contact._OptinMerchandiseYN' => 'Mechandise Opt In YN',
                'contact._OptinOtherYN' => 'Away Match Opt In YN',
                'order.ContactId' => 'CID',
                'order._ItemBought' => 'Item',
                'order._ValidUntil' => 'Season',
                'order.DateCreated' => 'Date Created',
                'contact._ActiveRecordYN' => 'Active_record',
                'order._ActiveRecordYN' => 'Active_record',
            );

    function __construct (){
        parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'order';
        $this->order_by = '_ValidUntil DESC';   //why isnt;' this reflected in datatable? 
        $this->contactId_fieldname = 'ContactId';
        if (isset($this->data['view_setup']['ContactId']))
        {
            $this->current_ContactId = $this->data['view_setup']['ContactId'];
        }
    }
    
   public function count_all_results_fcutd() {
       return array(0 => '11');
   }
   
   
   public function record_count() {
       return $this->db->count_all($this->table_name);
   }
   
   public function get_orders_join($export = FALSE, $limit, $start) {
       $criteria = array();
       
       if ($this->input->post())
       {
           $search_criteria = $this->input->post();
       }
       elseif ($this->session->userdata('search_criteria'))
       {
           $search_criteria = $this->session->userdata('search_criteria');
       }
       else return FALSE;
       
       //print_array($search_criteria);
       
       //Get criteria
       foreach ($search_criteria as $k => $v)
       {
           if ($v !== '0')
           {
               switch ($k)
                {
                    case 'order_type':
                        $criteria['order._ItemBought'] = $v;
                        break;

                    case 'order_date_value':
                        if($search_criteria['order_date_value'])
                        {                  
                            if ($search_criteria['order_date_operator'] === 'between' && $search_criteria['order_date_value_between'])
                            {
                                 $criteria['order.DateCreated <='] = convert_DATE($search_criteria['order_date_value_between']);
                                 $criteria['order.DateCreated >='] = convert_DATE($v);
                            }
                            else 
                            {
                                $operator = $this->get_operation($search_criteria['order_date_operator']);
                                $v = convert_DATE($v);
                                $criteria['order.DateCreated ' . $operator] = $v;
                            }
                            
                        }

                        break;
                    case 'order_expire':
                        $criteria['order._ValidUntil'] = $v;
                        break;

                    default:
                        break;
                }
           }
           
       }
       
       //print_array($criteria, 1,'criteria');
       $this->session->set_userdata('search_criteria', $search_criteria);
       //$_SESSION['test'] = 1;
       //Set up & do query
       if ( ! $export) $this->db->select(array_keys($this->fields_for_search));
       else $this->db->select(array_keys($this->fields_for_export));
       
       //$this->order_by = 'contact.LastName ASC';
       if ($limit) $this->db->limit($limit, $start);
        //foreach ($criteria as $k => $array) $this->db->where($array);
       $this->db->where($criteria);
       $this->db->where('contact._ActiveRecordYN', 1);
       $this->db->where('order._ActiveRecordYN', 1);
       $this->db->join('contact', 'contact.Id = order.ContactId');
       
       if ($export)
       {
            $retval['result'] = $this->db->get($this->table_name);
            $this->load->dbutil();
            $retval['csv'] = $this->dbutil->csv_from_result($retval['result'], ",","\n");
       }
       else
       {
            $retval['table_data'] = $this->db->get($this->table_name)->result_array();
            
            //finally, turn array inot one that's understood by the table function
            foreach ($this->fields_for_search as $col => $label)
            {
                $boom = '';
                $boom = explode('.', $col);
                $retval['table_headers'][$boom[1]] = $label;
            }
       }
       
       //do count
        $this->db->where($criteria);
        $this->db->from($this->table_name);
       $this->db->where('contact._ActiveRecordYN', 1);
       $this->db->where('order._ActiveRecordYN', 1);
        $this->db->join('contact', 'contact.Id = order.ContactId');
        $retval['count'] = $this->db->count_all_results();
       
       return $retval;
       
       
       
   }
   public function get_orders_join_mutliple($export = FALSE, $limit, $start) {
       $criteria = array();
       
       if ($this->input->post())
       {
           $search_criteria = $this->input->post();
       }
       elseif ($this->session->userdata('search_criteria'))
       {
           $search_criteria = $this->session->userdata('search_criteria');
       }
       else return FALSE;
       
       //print_array($search_criteria);
       
       //Get criteria
       foreach ($search_criteria as $k => $array)
       {
           switch ($k)
            {
                case 'order_type':
                    foreach ($array as $key => $v)
                    {
                        if ($v !== '0') //don't set criteria if the value passed is 0    
                        {
                            //$operator = $this->get_operation($search_criteria['order_type_operator'][$key]);
                            //$criteria[$key] = array('order._ItemBought ' . $operator => $v);
                            $criteria[$key] = array('order._ItemBought', $v);
                            
                        }

                    }
                    //$operator = $this->get_operation($search_criteria['order_type_operator']);
                    //$criteria['order._ItemBought ' . $operator] = $v;
                    //$criteria[] = array('order._ItemBought ' . $operator => $v);
                    break;

                case 'order_date_value':
                    if($search_criteria['order_date_value'])
                    {
                        foreach ($array as $key => $v)
                        {
                            if ($v !== '0') //don't set criteria if the value passed is 0    
                            {
                                $operator = $this->get_operation($search_criteria['order_date_operator'][$key]);
                                $criteria[$key] = array('order.DateCreated ' . $operator => convert_DATE($v));
                            }
                        }                            
//$operator = $this->get_operation($search_criteria['order_date_operator']);
                        //$v = convert_DATE($v);
                        //$criteria[] = array('order.DateCreated ' . $operator => $v);
                    }

                    break;
                case 'order_expire':
                    foreach ($array as $key => $v)
                    {
                        if ($v !== '0') //don't set criteria if the value passed is 0    
                        {
                            $criteria[$key] = array('order._ValidUntil' => $v);
                        }
                    }
                    //$criteria[] = array('order._ValidUntil' => $v);
                    break;

                default:
                    break;
            }
       }
       
       //print_array($criteria, 1,'criteria');
       $this->session->set_userdata('search_criteria', $search_criteria);
       //$_SESSION['test'] = 1;
       //Set up & do query
       if ( ! $export) $this->db->select(array_keys($this->fields_for_search));
       else $this->db->select(array_keys($this->fields_for_export));
       
       //$this->order_by = 'contact.LastName ASC';
       if ($limit) $this->db->limit($limit, $start);
        foreach ($criteria as $k => $array) $this->db->where($array);
       $this->db->where('contact._ActiveRecordYN', 1);
       $this->db->where('order._ActiveRecordYN', 1);
       $this->db->join('contact', 'contact.Id = order.ContactId');
       
       if ($export)
       {
            $retval['result'] = $this->db->get($this->table_name);
            $this->load->dbutil();
            $retval['csv'] = $this->dbutil->csv_from_result($retval['result'], ",","\n");
       }
       else
       {
            $retval['table_data'] = $this->db->get($this->table_name)->result_array();
            
            //finally, turn array inot one that's understood by the table function
            foreach ($this->fields_for_search as $col => $label)
            {
                $boom = '';
                $boom = explode('.', $col);
                $retval['table_headers'][$boom[1]] = $label;
            }
       }
       
       //do count
        foreach ($criteria as $k => $array) $this->db->where($array);
        $this->db->from($this->table_name);
       $this->db->where('contact._ActiveRecordYN', 1);
       $this->db->where('order._ActiveRecordYN', 1);
        $this->db->join('contact', 'contact.Id = order.ContactId');
        $retval['count'] = $this->db->count_all_results();
       
       return $retval;
       
       
       
   }
   
   
   
   public function get_orders_join_old($export = FALSE) {
       $criteria = array();
       /*$criteria = array
           (
                'order._ItemBought' => 'Adult Membership',
                //'order._ValidUntil' => '2013/14',
                'order._ValidUntil' => '2012/13',
                //'order.DateCreated >=' => '01/04/2013',
           );
       */
       //print_array($this->input->post());
       foreach ($this->input->post() as $k => $v)
       {
           switch ($k)
           {
               case 'order_type':
                   foreach ($v as $key => $val)
                   {
                        $criteria[]['order._ItemBought'] = $v;
                   }
                   //$criteria['order._ItemBought'] = $v;
                   break;
               
               case 'order_date_value':
                   $operation = $this->get_operation($this->input->post('order_date_operator'));
                   $criteria['order.DateCreated'] = $v .  $operation;
                   break;
               
               case 'order_expire':
                   $criteria['order._ValidUntil'] = $v;
                   break;
               
               case FALSE:
                   break;
               default:
                   break;
           }
       }
       
                
       //print_array($criteria);
       //get orders where 'criteria'
       //$this->db->limit($limit, $start);
       $this->db->select($fields);
       $this->db->where($criteria);
       $this->db->join('contact', 'contact.Id = order.ContactId');
       $retval = $this->db->get($this->table_name)->result_array();
       
       //export as csv?
       if ($export)
       {
            $this->load->dbutil();
            $retval['csv'] = $this->dbutil->csv_from_result($retval, ",","\n");
       }
       
       return $retval;
   }
   
   
   
   
   
   
   
   function search_older() {
       $retval = FALSE;
       $criteria = $this->input->post();
       $fields = implode(',', array_keys($this->fields_for_search));
       $table = $this->table_name;
       //$sql = 'SELECT ' . $fields . ' FROM ' . $this->db->protect_identifiers($table);
       //$join = ' JOIN `contact` ON `contact`.`Id` = `order`.`ContactId` ';
       //$where = ' WHERE ';
       
       print_array($criteria);
       
       foreach ($criteria['order_type'] as $k => $v)
       {
           if ($v)
           {
               if ($criteria['order_type_operator'][$k] === 'notequal') 
               {
                  //$sql = "SELECT `c`.`Id`, `c`.`FirstName` FROM `contact` `c` WHERE NOT EXISTS ( SELECT `o`.`Id`, `o`.`ContactId`, `o`.`_ItemBought`, `o`.`_ValidUntil` FROM `order` `o` WHERE `o`.`ContactId` = `c`.`Id` AND `o`.`_ItemBought` = 'Junior Membership'  AND `o`.`_ValidUntil` = '2009/10' ) ";
                  $sql = "SELECT `c`.`Id`, `c`.`FirstName` FROM `contact` `c` WHERE `Id` NOT IN ( SELECT `ContactId` FROM `order` WHERE `_ItemBought` = 'Junior Membership'  AND `_ValidUntil` = '2009/10') ";
                  //$sql = " SELECT * FROM `contact` LEFT OUTER JOIN `order` ON ( `contact`.`Id` = `order`.`ContactId`) WHERE `order`.`ContactId` IS NULL ";
                   
                   
                   
                  
               }
               /*if ($criteria['order_type_operator'][$k] === 'notequal') 
               {
                   $table = 'contact';
                   $sql = 'SELECT ' . $fields . ' FROM ' . $this->db->protect_identifiers($table);
                   $and_or = '';
                    $operator = $this->get_operation($criteria['order_type_operator'][$k]);
                   $join = ' RIGHT OUTER JOIN `order` ON `order`.`ContactId` = `contact`.`Id` ';
                   $where .= ' order._ItemBought ' . $operator . $this->db->escape($v) .' ';
                   //$where .= ' AND order.Id IS NOT null';
                   if ($criteria['order_expire'][$k]) $where .= ' AND order._ValidUntil = ' .  $this->db->escape($criteria['order_expire'][$k]) . ' ';
               }*/
               else
               {
                   $and_or = '';
                    $operator = $this->get_operation($criteria['order_type_operator'][$k]);
                    $where .= $and_or . ' _ItemBought ' . $operator . $this->db->escape($v) .' ';

                    if ($criteria['order_expire'][$k]) $where .= ' AND _ValidUntil = ' .  $this->db->escape($criteria['order_expire'][$k]) . ' ';
               }
                   
               
//$and_or = $criteria['search_type_operator'][$k];
               
               
           }
       }
       
       //$where .= " AND order._ActiveRecordYN = '1' AND contact._ActiveRecordYN = '1' ";
       //$where .= " AND order._dID = '22232' AND contact._dID = '22232' ";
       
       //$sql = $sql . $join . $where;
       echo $sql;
       $query = $this->db->query($sql);
       
       
        echo '<h1>Total Results: ' . $query->num_rows() . '</h1>';
        //print_array($query->result_array());
   }
   function search_old() {
       $retval = FALSE;
       $criteria = $this->input->post();
       $fields = implode(',', array_keys($this->fields_for_search));
       $table = $this->table_name;
       $sql = 'SELECT ' . $fields . ' FROM ' . $this->db->protect_identifiers($table);
       $join = ' JOIN `contact` ON `contact`.`Id` = `order`.`ContactId` ';
       $where = ' WHERE ';
       
       print_array($criteria);
       
       foreach ($criteria['order_type'] as $k => $v)
       {
           if ($v)
           {
                //if 'order_type_operator' = notequal then we use a
                //right outer join and exclude records where contact
               
               //right outer jopin gets me alll contacts
               if ($criteria['order_type_operator'][$k] === 'notequal') 
               {
                   //$table = 'contact';
                   //$sql = 'SELECT ' . $fields . ' FROM ' . $this->db->protect_identifiers($table);
                   $and_or = '';
                    $operator = $this->get_operation($criteria['order_type_operator'][$k]);
                   $join = ' LEFT OUTER JOIN `contact` ON `order`.`ContactId` = `contact`.`Id` ';
                   
                   $join .= ' UNION ';
                   $join .= ' SELECT * FROM `contact` ';
                   $join .= ' RIGHT OUTER JOIN `contact` ON `order`.`ContactId` = `contact`.`Id` ';
                   
                   //$where .= ' order._ItemBought ' . $operator . $this->db->escape($v) .' ';
                   //$where .= ' AND order.Id IS null';
                   //if ($criteria['order_expire'][$k]) $where .= ' AND order._ValidUntil = ' .  $this->db->escape($criteria['order_expire'][$k]) . ' ';
               }
               /*if ($criteria['order_type_operator'][$k] === 'notequal') 
               {
                   $table = 'contact';
                   $sql = 'SELECT ' . $fields . ' FROM ' . $this->db->protect_identifiers($table);
                   $and_or = '';
                    $operator = $this->get_operation($criteria['order_type_operator'][$k]);
                   $join = ' RIGHT OUTER JOIN `order` ON `order`.`ContactId` = `contact`.`Id` ';
                   $where .= ' order._ItemBought ' . $operator . $this->db->escape($v) .' ';
                   //$where .= ' AND order.Id IS NOT null';
                   if ($criteria['order_expire'][$k]) $where .= ' AND order._ValidUntil = ' .  $this->db->escape($criteria['order_expire'][$k]) . ' ';
               }*/
               else
               {
                   $and_or = '';
                    $operator = $this->get_operation($criteria['order_type_operator'][$k]);
                    $where .= $and_or . ' _ItemBought ' . $operator . $this->db->escape($v) .' ';

                    if ($criteria['order_expire'][$k]) $where .= ' AND _ValidUntil = ' .  $this->db->escape($criteria['order_expire'][$k]) . ' ';
               }
                   
               
//$and_or = $criteria['search_type_operator'][$k];
               
               
           }
       }
       
       $where .= " AND order._ActiveRecordYN = '1' AND contact._ActiveRecordYN = '1' ";
       $where .= " AND order._dID = '22232' AND contact._dID = '22232' ";
       
       $sql = $sql . $join . $where;
       echo $sql;
       $query = $this->db->query($sql);
       
       
        echo '<h1>Total Results: ' . $query->num_rows() . '</h1>';
        //print_array($query->result_array());
   }
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   function search_single($criteria) {
       $retval = FALSE;
       $query_binding = array();
       $sql = '';
       $criteria = $this->input->post();
       $fields = implode(',', array_keys($this->fields_for_search));
       $table = $this->table_name;
       
       //first create the query from the form
       $sql = "SELECT * FROM ";
       $sql .= $this->db->protect_identifiers($table);
       $sql .= " WHERE _ItemBought = ? ";
      
       $query_binding[] = $criteria['order_type'];
       
       if (element('order_expire', $criteria, FALSE))
       {
            $sql .= "AND _ValidUntil = ?";
            $query_binding[] = $criteria['order_expire'];
       }
       
       
       $query = $this->db->query($sql, $query_binding);
        echo 'Total Results: ' . $query->num_rows();
   }
    
}