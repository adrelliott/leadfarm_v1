<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Contact_model extends CRM_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'contact';
        //$this->order_by = 'FirstName ASC';   //why isnt;' this reflected in datatable? 
        $this->order_by = 'Id DESC';   //why isnt;' this reflected in datatable? 
        $this->contactId_fieldname = 'Id';
        $this->db->where('_IsCrmUserYN !=', 1);
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
    
    function get_latest_record($field_name = NULL) {
        if( ! $field_name )
            return FALSE;
        //options['field_name'] = '_LegacyMembershipNumber'
        $this->db->select_max($field_name);
        return $this->get();
    }
 
   
    function get_data_via_ajax_codeignitor() {
        //first, get the column names to search for
        $a = array();
        $cols = $this->data['config']['datasets']['index']['contacts']['fields'];
        foreach ( $cols as $colname => $label )
        {
            $exp = explode(".", $colname);
            $a['cols'][] = $exp[1];
            if ( $label ) $a['rows'][] = $exp[1];
        }
        $aColumns = $a['cols'];
        $aHeaders = $a['rows'];
              
        //set up the query
        $sIndexColumn = $this->contactId_fieldname;
	$sTable = $this->table_name;
        
        // Paging
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
			intval( $_GET['iDisplayLength'] );
	}
        
        //Ordering
        $sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
        
        //Filtering
        $sWhere = "";
        if ( $_GET['sSearch'] != "" )
        {
            $aWords = preg_split('/\s+/', $_GET['sSearch']);
            $sWhere = "WHERE (";

            for ( $j=0 ; $j<count($aWords) ; $j++ )
            {
                if ( $aWords[$j] != "" )
                {
                    $sWhere .= "(";
                    for ( $i=0 ; $i<count($aColumns) ; $i++ )
                    {
                        $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $aWords[$j] )."%' OR ";
                    }
                    $sWhere = substr_replace( $sWhere, "", -3 );
                    $sWhere .= ") AND ";
                }
            }
            $sWhere = substr_replace( $sWhere, "", -4 );
            $sWhere .= ')';
        }
        
        // Individual column filtering 
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
        
        
        
        /*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
        //echo "<p>query is $sQuery<p>";
	//$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	//$rResult = $this->db->query( $sQuery );
        //$this->db->select("SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns)), FALSE);
        $this->db->select(" SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns)), FALSE);
        $this->db->from($sTable);
        $this->db->where($sWhere);
        //$this->db->orderby($sOrder);
        $this->db->limit($sLimit);
	$rResult = $this->db->get();
        
	
        //echo "got here,]...";
        print_array($rResult->result_array(), 1, 'result');
	// Data set length after filtering
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	//$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$rResultFilterTotal = $this->db->query( $sQuery );
        
	//$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$aResultFilterTotal = $rResultFilterTotal->result_array(); 
	$iFilteredTotal = $aResultFilterTotal[0];
        $iFilteredTotal = array_values($iFilteredTotal);
        $iFilteredTotal = $iFilteredTotal[0];
	
	//Total data set length
	$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
		FROM   $sTable
	";
	//$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$rResultTotal = $this->db->query( $sQuery );
	$aResultTotal = $rResultTotal->result_array();
	$iTotal = array_values($aResultTotal[0]);
        $iTotal = $iTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		//"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array(),
		//"raw_data" => array(),
	);
	
        foreach ($rResult->result_array() as $result_row)
        {
           $row = array();
           //print_array($result_row, 0, '180');
           foreach ($aHeaders as $k => $v)
           {
                $row[] = $result_row[ $aHeaders[$k] ];
                //print_array($row);
           }
           $output['aaData'][] = $row;
        }
        //print_array($output['aaData'], 1, 'this is output');
	//echo json_encode( $output );
	return $output;
        
        
    }
    
    function get_data_via_ajax_non_codeigniter() {
        //first, get the column names to search for
        $a = array();
        $cols = $this->data['config']['datasets']['index']['contacts']['fields'];
        foreach ( $cols as $colname => $label )
        {
            $exp = explode(".", $colname);
            $a['cols'][] = $exp[1];
            if ( $label ) $a['rows'][] = $exp[1];
        }
        $aColumns = $a['cols'];
        $aHeaders = $a['rows'];
        
        //print_array($aColumns, 0, '$aColumns');
        //print_array($aHeaders, 0, '$aHeaders');
              
        //set up the query
        $sIndexColumn = $this->contactId_fieldname;
	$sTable = $this->table_name;
        
        // Paging
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
			intval( $_GET['iDisplayLength'] );
	}
        
        //Ordering
        $sOrder = "";
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
					($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
        else $sOrder = "ORDER BY  " . $this->order_by;
        
        //Filtering
        $sWhere = "";
        if ( $_GET['sSearch'] != "" )
        {
            $aWords = preg_split('/\s+/', $_GET['sSearch']);
            $sWhere = "WHERE (";

            for ( $j=0 ; $j<count($aWords) ; $j++ )
            {
                if ( $aWords[$j] != "" )
                {
                    $sWhere .= "(";
                    for ( $i=0 ; $i<count($aColumns) ; $i++ )
                    {
                        $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $aWords[$j] )."%' OR ";
                    }
                    $sWhere = substr_replace( $sWhere, "", -3 );
                    $sWhere .= ") AND ";
                }
            }
            $sWhere = substr_replace( $sWhere, "", -4 );
            $sWhere .= ' AND `_dID` = ' . DATAOWNER_ID . ') AND (' . $this->table_name . '._ActiveRecordYN = 1)';
        }
        else $sWhere = 'WHERE (`_dID` = ' . DATAOWNER_ID . ') AND (' . $this->table_name . '._ActiveRecordYN = 1)';
                
        
        // Individual column filtering 
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}
        
        /*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns))."`
		FROM   $sTable
		$sWhere
		$sOrder
		$sLimit
		";
        
	//$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$rResult = $this->db->query( $sQuery );
        
        /*$this->db
                ->select("SELECT SQL_CALC_FOUND_ROWS `".str_replace(" , ", " ", implode("`, `", $aColumns)), FALSE)
                ->from($sTable)
                ->where($sWhere)
                ->orderby($sOrder)
                ->limit($sLimit);
	$rResult = $this->db->get();
         * 
       
         */
	
        
	// Data set length after filtering
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	//$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$rResultFilterTotal = $this->db->query( $sQuery );
        
	//$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$aResultFilterTotal = $rResultFilterTotal->result_array(); 
	$iFilteredTotal = $aResultFilterTotal[0];
        $iFilteredTotal = array_values($iFilteredTotal);
        $iFilteredTotal = $iFilteredTotal[0];
	
	//Total data set length
	$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
		FROM   $sTable
	";
	//$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$rResultTotal = $this->db->query( $sQuery );
	$aResultTotal = $rResultTotal->result_array();
        $iTotal = array_values($aResultTotal[0]);
        $iTotal = $iTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		//"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
        foreach ($rResult->result_array() as $result_row)
        {
           $row = array();
           //print_array($result_row, 0, '180');
           foreach ($aHeaders as $k => $v)
           {
                $row[] = $result_row[ $aHeaders[$k] ];
                //print_array($row);
           }
           $output['aaData'][] = $row;
        }
	return $output;
        
        
    }
    

}