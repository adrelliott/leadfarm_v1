<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Model - search_page_model
 * @author Al Elliott
 * Table Name: Multiple
 * 
 * Description goes here
 * 
 */
class Search_page_model extends CRM_Model {

    //Define vars used throught the process
    public $table_name = array (
        'contact' => 'contact',
        'order' => 'order'
    );
    private $_post = array();    //Contains $this->input->post()
    private $_query = array();    //Contains the full query
    private $_fields = array();    //Contains the full array of fields to return
    private $_tables = array ();
    
    
    public function __construct() {
        parent::__construct();
        
    }

    public function do_search($main_table, $join_table, $query_type, $search_type) {
        //clean the post
        $this->_post = clean_data($this->input->post());
        $this->_tables = array(
            $main_table => array (
                'type' => 'main',
                'alias' => '',
            ),
            $join_table => array (
                'type' => 'join',
                'alias' => '',
            ),
        );
        $fields = $this->config->item('fields_for_search');
        $this->_fields = $fields[$main_table][$join_table];
        
        //Now switch the $query_type and call appropriate function
        switch ($query_type)
        {
            case 'or':
                $this->query = $this->_or_search($search_type);
                break;
            case 'and':
                $this->query = $this->_and_search($search_type);
                break;
            case 'not':
                $this->query = $this->_not_search($search_type);
                break;
        }
        
        //now do the search & return the results
        $this->load->model($main_table . '_model', 'main_model');
        $this->_query['results'] = $this->db->query($this->_query['sql']);
        $totalquery = $this->db->query('SELECT FOUND_ROWS() as total;');
$row= $totalquery->row();
echo $row->total; 
        //Do we want to export?
            //save query in PHP Session?
        //echo "count = " . $this->_query['count'];
    }
    
    
    
    private function _or_search($search_type) {
        //Prepare the query for a search using OR
       switch ($search_type) 
        {
            //FC UTD use Orders as products...
            case 'fc_order_search':
                $join_on = array (
                    'contact' => 'Id',
                    'order' => 'ContactId',
                );
                $group_by = array (
                    'contact' => 'Id',
                );
                //set up the query
                //$this->_set_alias('contact', 'c');
                $this->_set_alias('order', 'o');
                $this->_query['select'] = 'SELECT ' . $this->_set_fields('contact');
                $this->_query['select'] .= ',' . $this->_set_fields('order');
                $this->_query['from'] = $this->_set_table('contact', 'FROM');
                $this->_query['join'] = $this->_set_table('order','left join');
                $this->_query['on'] = $this->_set_join_on($join_on);
                $this->_query['where'] = 'WHERE ' . $this->_set_where('or');
                $this->_query['other'] = $this->_group_by($group_by);
                //set up the conditions
                break;

        }
        
        //Create the sql by joining all constinuent parts of the array
        $this->_query['sql'] = join(' ', $this->_query);
    }
    
    
    private function _and_search($search_type) {
        //Prepare the query for a search using OR
        $join = array();
        $join_on = array();
        $group_by = array();
        $conditions = '';
        
        switch ($search_type) 
        {
            //FC UTD use Orders as products...
            case 'fc_order_search':
                $join_on = array (
                    'contact' => 'Id',
                    'order' => 'ContactId',
                );
                $group_by = array (
                    'contact' => 'Id',
                );
                //set up the query
                $this->_set_alias('contact', 'c');
                $this->_set_alias('order', 'o1');
                $this->_query['select'] = 'SELECT ' . $this->_set_fields('contact');
                $this->_query['select'] .= ',' . $this->_set_fields('order');
                $this->_query['from'] = $this->_set_table('contact', 'FROM');
                
                //Set up the loop to create the INNER JOIN section
                
                //First inner join...
                $conditions = $this->_set_conditions();
                $count = count($conditions);
                
                //remaining inner joins...
                $i = 1; 
                while($i<=$count) 
                {
                    
                    $alias = 'o' . $i;
                    $this->_set_alias('order', $alias);
                    $conditions = $this->_set_conditions();
                    $join['tmp'][] = 'INNER JOIN `order` `' . $alias . '`';
                    $join['tmp'][] = ' ON `' . $this->_get_table_name('contact') . '`.Id=';
                    $join['tmp'][] = '`' . $alias . '`.ContactId ';
                    $join['tmp'][] = ' AND ' . $conditions[$i-1];
                    $join['retval'][] = join('', $join['tmp']);
                    unset($join['tmp']);
                    $i++;
                }
                
                $this->_query['join'] = join('', $join['retval']);
                //$this->_query['on'] .= ' AND '
                
                
                
                
               // $this->_query['where'] = 'WHERE ' . $this->_set_where('or');
                //$this->_query['other'] = $this->_group_by($group_by);
                //set up the conditions
                break;

        }
        
        //Create the sql by joining all constinuent parts of the array
        $this->_query['sql'] = join(' ', $this->_query);
    }
    
    
    private function _not_search() {
        //do the search for the upsell
    }
    
    //Checks for table name and returns alias or table name.
    //If optional $alias is set then it will return just an alias, if exists
    private function _get_table_name($table_name, $alias = FALSE) {
        $table = $this->_tables[$table_name];
        if ($alias) $table_name = '';
        
        return strtolower(element('alias', $table, $table_name));
    }
    
    private function _set_alias($table_name, $table_alias) {
        $this->_tables[$table_name]['alias'] = $table_alias;
    }
    
     private function _set_fields($table_name) {
        $fields = array();
        
        //Look up the field list from $this->_fields
        foreach ($this->_fields[$table_name] as $k => $col)
            $fields[$k] = '`' . $this->_get_table_name($table_name) . '`.' . $col;
        
        //Join it as comma separated list
        return join(',', $fields);
    }
    
    //Sets the FROM or JOIN perption and also includes an alias if set
    private function _set_table($table_name, $type) {
        $retval = strtoupper($type) . ' `' . $table_name . '`';
        
        //Is there an alias?
        $alias = $this->_get_table_name($table_name, 1);
        if ($alias) $retval .= ' `' . $alias . '`';
        
        return $retval;
    }
    
    private function _set_join_on($array) {
        $retval = array();
        $table = '';
        
        foreach ($array as $table => $col)
        {
            $table = '`' . $this->_get_table_name($table) . '`';
            $retval[] = $table . '.' . $col;
        }
        
        return 'ON ' . join('=', $retval);
    }
    
    private function _clean_post() {
        //chekc post for complete rows of info
        $field_list = $this->_fields['search_cols'];
        $post = $this->_post;
        $unset_list = array();
        $extra_cond = array();
        $cond = '';
        
        //Find any rows of inputted data that are not complete
        foreach ($field_list as $table => $a)
        {
            foreach ($post[$table] as $k => $v)
            {
                //Other checks can go in here
                if ($v === '') $unset_list[] = $k;
            }
        }
        
        //now unset the rows that are missing data
        foreach ($field_list as $table => $a)
            foreach ($unset_list as $k => $row)
                unset($post[$table][$row]);
        
        //now check the dates
        /*foreach ($post['date'] as $k => $v)
        {
            switch ($k)
            {
                case 'operator':
                    switch ($v)
                    {
                        case 'Any':
                            //find all
                            break;
                        case 'on':
                            $cond = 'table.DateCreated =';
                            $cond .= convert_DATE($post['date']['start'],'to_DATE');
                            $extra_cond[] = $cond;
                    }
            }
        }*/
        
        return $post;
        
    }
    
    private function _set_where($query_type) {
        //set the where
        $where = array();
        
        //Add the bracketed conditions
        $where[] = join(' OR ', $this->_set_conditions());
        //print_array($where, 1);
                
        //now add the standard where
        $where[] = join(' AND ', $this->_set_standard_where());
        
        //Join them all up
        $where = join(' AND ', $where);
        
        return $where;
    }
    private function _set_standard_where() {
        $table_name = '';
        $retval = array();
        
        foreach ($this->_tables as $table => $array)
        {
            $table_name = '`' . $this->_get_table_name($table) . '`';
            $retval[] = '(' . $table_name . '._ActiveRecordYN=1)';
            $retval[] = '(' . $table_name . '._dID=' . DATAOWNER_ID . ')';
        }
        
        return $retval;
    }
    private function _set_conditions() {
        //set the where
        $cond = array();
        $col = '';
        $input = $this->_clean_post();
        $field_list = $this->_fields['search_cols'];
        
        //group each array key in brackets
        foreach ($field_list as $field => $array)
        {
            $col = '`' . $this->_get_table_name($array['table']);
            $col .= '`.' . $array['col'] ;

            //cycle through the submitted form data and create conditions
            foreach ($input[$field] as $k => $v)
                $cond['fields'][$field][$k] = $col . '=' . $this->db->escape($v);
        }
        
        //now group the conditions together
        foreach ($cond['fields'] as $field => $array)
        {
            $row_count = count($array); //no of rows submitted
            $i = 0;
            while($i<$row_count)
            {
                //Cycle through the fields in the input and create field=val
                foreach ($this->_fields['grouping'] as $field2)
                    $cond['tmp'][] =  $cond['fields'][$field2][$i];
                
                //now join these to make the (field1=val1 AND field2=va2)
                $cond['retval'][$i] = '(' . join(' AND ', $cond['tmp']) . ')';
                $i++;
                unset($cond['tmp']);
            }
        }
       
        //now join the bracketed conditions by OR & return
        return $cond['retval'];
    }
    
    
   private function _group_by($array) {
        $retval = array();
        $table = '';
        
        foreach ($array as $table => $col)
        {
            $table = '`' . $this->_get_table_name($table) . '`';
            $retval[] = 'GROUP BY ' . $table . '.' . $col;
        }
        
        return join(' ', $retval);
   }
    
    
    
    
}

/* End of file search_page_model.php */
/* Location: ./application/models/XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/search_page_model.php */