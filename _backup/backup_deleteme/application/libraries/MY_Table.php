<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.3.1
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * HTML Table Generating Class
 *
 * Lets you create tables manually or from database result objects, or arrays.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	HTML Tables
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/uri.html
 */



class MY_Table extends CI_Table {

	var $rows				= array();
	var $heading			= array();
	var $auto_heading		= TRUE;
	var $caption			= NULL;
	var $template			= NULL;
	var $newline			= "\n";
	var $empty_cells		= "";
	var	$function			= FALSE;

	public function __construct()
	{
            parent::__construct();	
            log_message('debug', "Table Class Initialized");
	}

	function gen_table_custom($tableName, $uri)
        {
            $this->set_template_custom(array ('table_open' => '<table class="dataTable">', 'heading_cell_start' => '<th  class="align-left">', 'anchor_uri' => $uri));  
            $this->set_heading_custom($this->data['dataSetup']['tableSetup'][$tableName]);
            return $this->generate_custom($this->data['records'][$tableName]); 
        }



        // --------------------------------------------------------------------

	/**
	 * Set the template
	 *
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	function set_template_custom($template)
	{
		if ( ! is_array($template))
		{
			return FALSE;
		}

		$this->template = $template;
	}

	// --------------------------------------------------------------------

	/**
	 * Set the table heading
	 *
	 * Can be passed as an array or discreet params
	 *
	 * @access	public
	 * @param	mixed
	 * @return	void
	 */
	function set_heading_custom()
	{
		$args = func_get_args();
                
                $this->heading = $this->_prep_args_custom($args);
	}

	// --------------------------------------------------------------------

	/**
	 * Set columns.  Takes a one-dimensional array as input and creates
	 * a multi-dimensional array with a depth equal to the number of
	 * columns.  This allows a single array with many elements to  be
	 * displayed in a table that has a fixed column count.
	 *
	 * @access	public
	 * @param	array
	 * @param	int
	 * @return	void
	 */
	function make_columns($array = array(), $col_limit = 0)
	{
		if ( ! is_array($array) OR count($array) == 0)
		{
			return FALSE;
		}

		// Turn off the auto-heading feature since it's doubtful we
		// will want headings from a one-dimensional array
		$this->auto_heading = FALSE;

		if ($col_limit == 0)
		{
			return $array;
		}

		$new = array();
		while (count($array) > 0)
		{
			$temp = array_splice($array, 0, $col_limit);

			if (count($temp) < $col_limit)
			{
				for ($i = count($temp); $i < $col_limit; $i++)
				{
					$temp[] = '&nbsp;';
				}
			}

			$new[] = $temp;
		}

		return $new;
	}

	// --------------------------------------------------------------------

	/**
	 * Set "empty" cells
	 *
	 * Can be passed as an array or discreet params
	 *
	 * @access	public
	 * @param	mixed
	 * @return	void
	 */
	function set_empty($value)
	{
		$this->empty_cells = $value;
	}

	// --------------------------------------------------------------------

	/**
	 * Add a table row
	 *
	 * Can be passed as an array or discreet params
	 *
	 * @access	public
	 * @param	mixed
	 * @return	void
	 */
	function add_row()
	{
		$args = func_get_args();
		$this->rows[] = $this->_prep_args($args);
	}

	// --------------------------------------------------------------------

	/**
	 * Prep Args
	 *
	 * Ensures a standard associative array format for all cell data
	 *
	 * @access	public
	 * @param	type
	 * @return	type
	 */
	function _prep_args_custom($args)
	{
		// If there is no $args[0], skip this and treat as an associative array
		// This can happen if there is only a single key, for example this is passed to table->generate
		// array(array('foo'=>'bar'))
		if (isset($args[0]) AND (count($args) == 1 && is_array($args[0])))
		{
			// args sent as indexed array
			if ( ! isset($args[0]['data']))
			{
				foreach ($args[0] as $key => $val)
				{
					if (is_array($val) && isset($val['data']))
					{
						$args[$key] = $val;
					}
					else
					{
						$args[$key] = array('data' => $val);
					}
				}
			}
		}
		else
		{
			foreach ($args as $key => $val)
			{
				if ( ! is_array($val))
				{
					$args[$key] = array('data' => $val);
				}
			}
		}
                //Unset this as we only need to see the assoc array (didn't;l't wnat to amend all the code above though)
                unset($args[0]);
		return $args;
	}

	// --------------------------------------------------------------------

	/**
	 * Add a table caption
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	function set_caption($caption)
	{
		$this->caption = $caption;
	}

	// --------------------------------------------------------------------

	/**
	 * Generate the table
	 *
	 * @access	public
	 * @param	mixed
	 * @return	string
	 */
	function generate_custom($table_data = NULL)
	{
		// The table data can optionally be passed to this function
		// either as a database result object or an array
		if ( ! is_null($table_data))
		{
			if (is_object($table_data))
			{
				$this->_set_from_object($table_data);
			}
			elseif (is_array($table_data))
			{
				$set_heading = (count($this->heading) == 0 AND $this->auto_heading == FALSE) ? FALSE : TRUE;
				$this->_set_from_array($table_data, $set_heading);
			}
		}

		// Is there anything to display?  No?  Smite them!
		if (count($this->heading) == 0 AND count($this->rows) == 0)
		{
			return 'Undefined table data';
		}

		// Compile and validate the template date
		$this->_compile_template();

		// set a custom cell manipulation function to a locally scoped variable so its callable
		$function = $this->function;

		// Build the table!

		$out = $this->template['table_open'];
		$out .= $this->newline;

		// Add any caption here
		if ($this->caption)
		{
			$out .= $this->newline;
			$out .= '<caption>' . $this->caption . '</caption>';
			$out .= $this->newline;
		}

		// Is there a table heading to display?
		if (count($this->heading) > 0)
		{
			$out .= $this->template['thead_open'];
			$out .= $this->newline;
			$out .= $this->template['heading_row_start'];
			$out .= $this->newline;

			foreach ($this->heading as $field => $heading)
			{
                                $temp = $this->template['heading_cell_start'];

				foreach ($heading as $key => $val)
				{                                    
					if ($key != 'data' )
					{
						$temp = str_replace('<th', "<th $key='$val'", $temp);
					}
				}

				$out .= $temp;
				$out .= isset($heading['data']) ? $heading['data'] : '';
				$out .= $this->template['heading_cell_end'];
			}
                        $out .= $this->_generate_checkboxes('th');    //This inserts <th></th> if checkboxes rqd
                        $out .= $this->_generate_radio_buttons('th');    //This inserts <th></th> if checkboxes rqd
			$out .= $this->template['heading_row_end'];
			$out .= $this->newline;
                        $out .= $this->template['thead_close'];
			$out .= $this->newline;
		}
			
		// Build the table rows
		if (count($this->rows) > 0)
		{
			$out .= $this->template['tbody_open'];
			$out .= $this->newline;

			$i = 1;
			foreach ($this->rows as $row)
			{
                                if ( ! is_array($row))
				{
					break;
				}

				// We use modulus to alternate the row colors
				$name = (fmod($i++, 2)) ? '' : 'alt_';

				$out .= $this->template['row_'.$name.'start'];
				$out .= $this->newline;

				foreach ($row as $field => $cell)
				{
                                    if ( array_key_exists($field, $this->heading) )
                                    {
                                        $temp = $this->template['cell_'.$name.'start'];

                                            foreach ($cell as $key => $val)
                                            {
                                                    if ($key != 'data')
                                                    {
                                                            $temp = str_replace('<td', "<td $key='$val'", $temp);
                                                    }
                                            }
                                            //Now add in our custom function that wraps the lines in <a> tag
                                            $Id_fieldname = $this->template['primary_key_fieldname'];
                                            //$anchor = $this->_generate_anchor($row[$Id_fieldname]);
                                            $anchor = $this->_generate_anchor($row, $Id_fieldname);
                                            $cell = isset($cell['data']) ? $anchor['start'] . $cell['data'] . $anchor['end'] : '';
                                            $out .= $temp;

                                            if ($cell === "" OR $cell === NULL)
                                            {
                                                    $out .= $this->empty_cells;
                                            }
                                            else
                                            {
                                                    if ($function !== FALSE && is_callable($function))
                                                    {
                                                            $out .= call_user_func($function, $cell);
                                                    }
                                                    else
                                                    {
                                                            $out .= $cell;
                                                    }
                                            }

                                            $out .= $this->template['cell_'.$name.'end'];
                                    }
                                       
				}
				
                                $Id_fieldname = $this->template['primary_key_fieldname'];
                                $anchor = $this->_generate_anchor($row, $Id_fieldname);
                                $out .= $this->_generate_checkboxes('td',$row[$Id_fieldname]);  
                                $out .= $this->_generate_radio_buttons('td',$row[$Id_fieldname]);  
                                   //This inserts checkboxes If rqd
				$out .= $this->template['row_'.$name.'end'];  
				$out .= $this->newline;
			}

			$out .= $this->template['tbody_close'];
			$out .= $this->newline;
		}

		$out .= $this->template['table_close'];

		// Clear table class properties before generating the table
		$this->clear();
		return $out;
	}

	// --------------------------------------------------------------------

	/**
	 * Clears the table arrays.  Useful if multiple tables are being generated
	 *
	 * @access	public
	 * @return	void
	 */
	function clear()
	{
		$this->rows				= array();
		$this->heading			= array();
		$this->auto_heading		= TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Set table data from a database result object
	 *
	 * @access	public
	 * @param	object
	 * @return	void
	 */
	function _set_from_object($query)
	{
		if ( ! is_object($query))
		{
			return FALSE;
		}

		// First generate the headings from the table column names
		if (count($this->heading) == 0)
		{
			if ( ! method_exists($query, 'list_fields'))
			{
				return FALSE;
			}

			$this->heading = $this->_prep_args($query->list_fields());
		}

		// Next blast through the result array and build out the rows

		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$this->rows[] = $this->_prep_args($row);
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Set table data from an array
	 *
	 * @access	public
	 * @param	array
	 * @return	void
	 */
	function _set_from_array($data, $set_heading = TRUE)
	{
		if ( ! is_array($data) OR count($data) == 0)
		{
			return FALSE;
		}

		$i = 0;
		foreach ($data as $row)
		{
			// If a heading hasn't already been set we'll use the first row of the array as the heading
			if ($i == 0 AND count($data) > 1 AND count($this->heading) == 0 AND $set_heading == TRUE)
			{
				$this->heading = $this->_prep_args($row);
			}
			else
			{
				$this->rows[] = $this->_prep_args($row);
			}

			$i++;
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Compile Template
	 *
	 * @access	private
	 * @return	void
	 */
	function _compile_template()
	{
		if ($this->template == NULL)
		{
			$this->template = $this->_default_template();
			return;
		}

		$this->temp = $this->_default_template();
		foreach (array('anchor_uri','ContactId_name','anchor_uri_append','anchor_attr','primary_key_fieldname','checkbox_flag','checkbox_class','checkbox_name','checkbox_value_is_id','table_open', 'thead_open', 'thead_close', 'heading_row_start', 'heading_row_end', 'heading_cell_start', 'heading_cell_end', 'tbody_open', 'tbody_close', 'row_start', 'row_end', 'cell_start', 'cell_end', 'row_alt_start', 'row_alt_end', 'cell_alt_start', 'cell_alt_end', 'table_close') as $val)
		{
			if ( ! isset($this->template[$val]))
			{
				$this->template[$val] = $this->temp[$val];
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Default Template
	 *
	 * @access	private
	 * @return	void
	 */
	function _default_template()
	{
		return  array (
			'anchor_uri'                   => '',
			'ContactId_name'             => '',
			'anchor_uri_append'           => '',
			'anchor_attr'                 => '',    //e.g class="iframe"
			'primary_key_fieldname'       => 'Id',    //this is usually 'Id' or '__Id'
			'checkbox_flag'                 => '',    // set to TRUE for checkboxes
			'checkbox_class'                 => '',    // can be blank for no class
			'checkbox_name'                 => '',    // <input name="XXX"
                        'checkbox_value_is_id'          => '',  //do we use row[ID] as value for checkbox?
			'radio_flag'                 => '',    // set to TRUE for checkboxes
			'radio_class'                 => '',    // can be blank for no class
			'radio_name'                 => '',    // <input name="XXX"
                        'radio_value_is_id'          => '',  //do we use row[ID] as value for checkbox?
                        'table_open'			=> '<table class="dataTable">',
                        'link_controller'		=> 'contact',

                        'thead_open'			=> '<thead>',
                        'thead_close'			=> '</thead>',

                        'heading_row_start'		=> '<tr>',
                        'heading_row_end'		=> '</tr>',
                        'heading_cell_start'            => '<th class="align-left">',
                        'heading_cell_end'		=> '</th>',

                        'tbody_open'			=> '<tbody>',
                        'tbody_close'			=> '</tbody>',

                        'row_start'				=> '<tr>',
                        'row_end'				=> '</tr>',
                        'cell_start'			=> '<td>',
                        'cell_end'				=> '</td>',

                        'row_alt_start'		=> '<tr>',
                        'row_alt_end'			=> '</tr>',
                        'cell_alt_start'		=> '<td>',
                        'cell_alt_end'			=> '</a></td>',

                        'table_close'			=> '</table>'
					);
	}
        
        // This method inserts a link if one has been passed via set_template(anchor => 1)
        
        function _generate_anchor($row, $Id_fieldname)
        {       
        $id = $row[$Id_fieldname];
        
//first check to see if there is a value for $this->template('anchor_uri')
            $retval = array('start' => '', 'end' => '');
            if ( isset($this->template['anchor_uri']) && $this->template['anchor_uri'] != '' )
            {
                $attr = '';
                if ( isset($this->template['anchor_attr']) && $this->template['anchor_attr'] != '' )
                {
                    $attr = $this->template['anchor_attr'];
                }
                $cid = '';  //make this '0/' to standardise all URLs
                if ( isset($this->template['ContactId_name']) && isset($row[$this->template['ContactId_name']]) )
                {
                    $cid = $row[$this->template['ContactId_name']]['data'] . '/';
                }
                $retval['start'] = '<a href="' . base_url() . DATAOWNER_ID . '/' . $this->template['anchor_uri'] . '/' . $id['data'] . '/' . $cid . $this->template['anchor_uri_append'] . '" ' . $attr . ' >';
                $retval['end'] = '</a>';
            }
            return $retval;
        }
        
        function _generate_checkboxes($type, $id = NULL)
        {         
            $retval = '';
            $class = '';
            $name = '';
            if (isset($this->template['checkbox_flag']) && $this->template['checkbox_flag'] != '')
            {
                
                if ($type == 'th')
                {
                    $retval = '<th></th>';
                }
                else
                {
                    if (isset($this->template['checkbox_class']) && $this->template['checkbox_class'] != '')
                    {
                        $class = $this->template['checkbox_class'];
                    }
                    if (isset($this->template['checkbox_name']) && $this->template['checkbox_name'] != '')
                    {
                        $name = $this->template['checkbox_name'];
                    }
                    if (isset($this->template['checkbox_value_is_id']) && $this->template['checkbox_value_is_id'] != '')
                    {
                        $value = $id['data'];
                    }
                    //$retval = '<td><input name="' . $name . '[' . $id['data'] . ']" class="' . $class . '" type="checkbox" value="' . $value . '"></td>'; 
                    $retval = '<td><input name="' . $name . '" class="' . $class . '" type="checkbox" value="' . $value . '"></td>'; 
                }
            }
            return $retval;
        }
        
        function _generate_radio_buttons($type, $id = NULL)
        {         
            $retval = '';
            $class = '';
            $name = '';
            if (isset($this->template['radio_flag']) && $this->template['radio_flag'] != '')
            {
                
                if ($type == 'th')
                {
                    $retval = '<th></th>';
                }
                else
                {
                    if (isset($this->template['radio_class']) && $this->template['radio_class'] != '')
                    {
                        $class = $this->template['radio_class'];
                    }
                    if (isset($this->template['radio_name']) && $this->template['radio_name'] != '')
                    {
                        $name = $this->template['radio_name'];
                    }
                    if (isset($this->template['radio_value_is_id']) && $this->template['radio_value_is_id'] != '')
                    {
                        $value = $id['data'];
                    }
                    //$retval = '<td><input name="' . $name . '[' . $id['data'] . ']" class="' . $class . '" type="checkbox" value="' . $value . '"></td>'; 
                    $retval = '<td><input name="' . $name . '" class="' . $class . '" type="radio" value="' . $value . '"></td>'; 
                }
            }
            return $retval;
        }
        
        


}


/* End of file Table.php */
/* Location: ./system/libraries/Table.php */

