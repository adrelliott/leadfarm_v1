<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Model - search
 * @author Al Elliott
 * Table Name: 
 * 
 * Description goes here
 * 
 */
class Search_model extends CRM_Model {
    
    public $table_cols = array(
            'FirstName' => 'First Name', 
            'LastName' => 'Last Name',
            'Id' => 'Id',
            '_LegacyMembershipNo' => 'Membership Number',
            'Phone1' => 'Home',
            'Phone2' => 'Work',
            'Phone3' => 'Mobile',
        );
    public $criteria_array = array(
        'equal' => 'Equals',
        'notequal' => "Doesn't equal",
        'greaterthan' => 'Is greater than',
        'lessthan' => 'Is less than'
        );

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'contact';
        $this->order_by = 'Id DESC';
        $this->output->enable_profiler();
        $this->load->dbutil();
        
    }
    
     /**
     * Performs the search and returns the results
     *
     * @return array
     * @access public
     */
    public function do_search ($export = FALSE)
    {
        $where = array ();      /* List of WHERE statements */
        $query = null;          /* SQL query */
        $criteria = array();       /* Search criteria */
        $operation = null;      /* Search operation */
        $contact_ids = null;    /* List of contact IDs */
        $stmt = null;           /* DB statement */
        $row = null;            /* DB row */
        $result = array ();     /* Search result */
        
            $retval = array();
        
        
        
        //clean post
        foreach ($this->input->post() as $k => $a)
        {
            if (substr($k, 0, 4) !== '_::_' && element('value', $a))
            {
                $operation = $this->_get_operation($a['operation']);
                $where[] = $k . ' ' . $operation . ' ' . $this->db->escape ($a['value']);
                //Do we need ot escape or are we doing this automacally????
            }
        }
        
        //If we have conditions to search for then perform the query
        if (count($where) < 1) return FALSE;

        $where[] = '_IsCrmUserYN = FALSE';
        $where[] = '_dID = ' . DATAOWNER_ID;
        
        $query = (
            'SELECT ' . implode(', ', array_keys($this->table_cols))
            . ' FROM contact'
        );
        
        $query .= ' WHERE ' . implode (' AND ', $where);
        $result = $this->db->query($query);

        //print_array($result, 0,'results');
        
        //Turn into an array the view will understand
        if ($export) return $this->dbutil->csv_from_result($result, ",","\n");
        
        $retval['table_headers'] = $this->table_cols;
        $retval['query'] = $query;
        $retval['table_data'] = array();
        $retval['returned_ids'] = array();
        if (count($result) > 0)
        {
            foreach ($result->result_array() as $k => $array)
            {
                foreach ($array as $col => $val)
                {
                    $retval['table_data'][$k][$col] = $val;
                }
                
                $retval['returned_ids'][] = $array['Id']; 
            }
        }
        
        $retval['returned_ids_csv'] = implode(',', $retval['returned_ids']);
        
        
        return $retval;

    }
    
    function export() {
        $retval = FALSE;
        if ($this->input->post('_::_query'))
        {
            $this->load->dbutil();
            $result = $this->db->query($this->input->post('query'));
            print_array($result, 1);
            $retval = $this->dbutil->csv_from_result($result, ",","\n");
        }
        return $retval;
    }
    
    /*
     * Converts the passed value into operators for the search
     * 
     * e.g. pass in 'lessthan' and returns <
     * 
     */
    private function _get_operation($operation) {
        switch ($operation)
        {
            case 'equal':
                $operation = ' = ';
                break;

            case 'notequal':
                $operation = ' != ';
                break;

            case 'greaterthan':
                $operation = ' > ';
                break;

            case 'lessthan':
                $operation = ' < ';
                break;

            default:
                $operation = ' = '; //what should this be??????
        }
        
        return $operation;
    }


}

/* End of file search.php */
/* Location: ./application/models/XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/search.php */