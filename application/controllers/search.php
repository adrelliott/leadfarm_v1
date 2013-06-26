<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contact') ) get_bespoke_controller();  //yup = go get it.
else
{   //nope? Use this default class then
    
    class Search extends CRM_Controller {
        
        public $controller_name = 'search';
        public $search_tables = array   //should this be private??
            (
                'contact', 'order'
            );
        
        private $items_bought = array(
            'Adult Membership', 'Junior Membership', 'Season Ticket (Adult)', 'Season Ticket (Junior)', 'Community Shares', 'TreasureLine', 'Holiday Draw', '127 Club', 'Match Sponsor', 'Matchball Sponsor', 'Matchday Programme Sponsor', 'Programme Adverts', 'Pitchside Hording', 'Pink Sponsorship', 'Newsletter Sponsor', 'Community Sponsor', 'Youth Team Sponsor', 'Women Team Sponsor', 'Player Sponsor', 'Club Donations', 'DF Donations',  'Club Events', 'Merchanidise', 'Away Match Travel'
    );

        public function __construct()    {
             parent::__construct();
             
           $this->output->enable_profiler();
             $this->load->library('pagination');
        }

        public function index() {   
            parent::index();
            $this->_load_view_data();
            $this->_generate_view($this->data);
        }
        
        
        public function search_22() {
            //print_array($this->input->post());
            $where = array();
            $conditions = $this->input->post();
            $table = $this->db->protect_identifiers('order');
            
            //Cycle through the input array and extract the where conditions
            foreach ($conditions['items_bought'] as $search_type => $array)
            {
                //Get the items bought
                foreach ($array as $k => $v)
                {
                    if (in_array($v, $this->items_bought))
                        $where['items_bought'][$k+1] = " ($table.`_ItemBought` = '{$v}' ";
                }
            }
              
            foreach ($conditions['order_expire'] as $search_type => $info)
            {
                foreach ($info as $k => $array)
                {
                    if (element($k, $where['items_bought'], FALSE))
                    {
                        foreach ($array as $k2 => $v)
                        {
                            if ($v) 
                                $where['conditions'][$search_type][] = $where['items_bought'][$k] . " AND $table.`_ValidUntil` = '{$v}') ";
                        }
                    }
                }
                
                $glue = ' ' . strtoupper($search_type) . ' ';
                $where[$search_type . '_conditions'] = implode($glue, $where['conditions'][$search_type]);
                
            }
            
            $sql = ' WHERE ';
            if (element('or_conditions', $where, FALSE)) $sql .= $where['or_conditions'];
            if (element('and_conditions', $where, FALSE)) $sql .= ' AND ' . $where['and_conditions'];
            
            
            $this->load->model('order_model');
            $retval = $this->order_model->search_custom($sql);
            
            
            
            print_array($retval);
            
            
            
        }
        
        
        
        
        public function report($report_type, $start = 0) {
             $retval = array();
             $export = FALSE;
//print_array($this->input->post(), 1);
             //set up config for pagination
             $config = array();
             $config['base_url'] = base_url('search/report/' . $report_type);
             $config['uri_segment'] = 4;
             $config['per_page'] = 50;
             $limit = $config['per_page'];
             $start = $this->uri->segment(4);

             //Do the search
             $this->session->set_userdata('report_type', $report_type);
             $retval = $this->do_search(FALSE, $limit, $start, $report_type);
             $config['total_rows'] = $retval['count'];
                     
             //Set up the view
            $this->pagination->initialize($config);
            $this->data['view_setup']['tables']['search_results'] = $retval;
            $this->data['view_setup']['tables']['search_results']['pagination_links'] = $this->pagination->create_links();
            $this->data['view_setup']['tables']['search_results']['total_records'] = $config['total_rows'];

            //load the view
            parent::report();
            $this->_load_view_data();
            
            $this->_generate_view($this->data);
            
        }
        
        function export_as_csv($report_type) {
            $retval = $this->do_search(TRUE, FALSE, 0, $report_type);
            //print_array($retval);
            //return;
            
            //load the view
            parent::report();
            $this->_load_view_data();
            
            $this->_generate_view($this->data);
            
             $this->load->helper('download');
            $csv = $retval['csv'];
            $name = "csv_export.csv";
            //print_array( $this->data['tables']['search_results']['csv_file'] , 1);
            force_download($name, $csv);
        }
        
        
        function custom_search() {
            $this->load->model('order_model');
                     $retval = $this->order_model->search_custom();
                     //print_array($retval, 1);
                     
                     parent::report();
            $this->_load_view_data();
            
            $this->_generate_view($this->data);
            
             $this->load->helper('download');
            $csv = $retval['csv'];
            $name = "csv_export.csv";
            //print_array( $this->data['tables']['search_results']['csv_file'] , 1);
            force_download($name, $csv); 
        }
        
        function do_search($export, $limit, $start, $report_type) {
            switch ($report_type)
             {
                 case 'order':
                     //load order model
                     $this->load->model('order_model');
                     $retval = $this->order_model->get_orders_join($export, $limit, $start);
                     //$config['total_rows'] = $this->order_model->record_count();
                     break;
                 case 'role':
                     //load order model
                     $this->load->model('contactaction_model');
                     $retval = $this->contactaction_model->get_roles_join($export, $limit, $start);
                     //$config['total_rows'] = $this->order_model->record_count();
                     break;
                 default:
                     break;
             }
            
             //print_array($retval, 1);
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
   
   
   
   
   
   
   
   
   
   
   
        
        
    }
}   