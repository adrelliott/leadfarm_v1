<?php

if (defined ('BASEPATH') === false)
{
  exit ('No direct script access allowed');
}

/**
 * Model for accessing contact searches
 */
class Contactsearch_model extends MY_Model
{
    /**
     * The database table to use
     *
     * @var string
     * @access public
     */
    public $table_name = 'Contact_Search';
    /**
     * Primary key field
     *
     * @var string
     * @access public
     */
    public $primary_key = 'Id';
    /**
     * Order by fields. Default order for this model.
     *
     * @var string
     * @access public
     */
    public $order_by = 'Id';
    /**
     * Currently loaded search details
     *
     * @var array
     * @access private
     */
    private $_data;
    /**
     * Search criteria
     *
     * @var array
     * @access private
     */
    private $_criteria = array ();
    /**
     * IDs of the tags to include
     *
     * @var array
     * @access private
     */
    private $_include_tag_ids = array ();
    /**
     * IDs of the tags to exclude
     *
     * @var array
     * @access private
     */
    private $_exclude_tag_ids = array ();

    /**
     * Construct
     *
     * @return void
     * @access public
     */
    public function __construct ()
    {
        parent::__construct ();

        $this->load->model ('contactgroup_model');
        $this->_tags = $this->contactgroup_model->get ();

        if ($this->form_submitted ()) {

            $this->update ();

            if ($this->input->post ('contact-search-save-criteria')) {
                $this->save_criteria ();
            }

        }

    }

    /**
     * Returns true if the form was submitted
     *
     * @return boolean
     * @access public
     */
    public function form_submitted ()
    {
        if ($this->input->post ('contact-search')) {
            return true;
        }

        return false;

    }

    /**
     * Updates the search criteria from posted values
     *
     * @return void
     * @access public
     */
    public function update ()
    {
        $tag = null;
        $tag_value = null;

        if ($this->input->post ('contact-search-load')) {
            $this->load ($this->input->post ('contact-search-load-id'));
            return;
        }

        $this->_criteria = $this->get_posted_criteria ();
        $this->_include_tag_ids = array ();
        $this->_exclude_tag_ids = array ();

        $this->load->model ('contactgroup_model');

        foreach ($this->_tags as $tag) {

            $tag_value = $this->input->post ('tag-' . $tag['Id'] . '-apply');

            switch ($tag_value) {

                case 'yes':
                {
                    $this->_include_tag_ids[] = $tag['Id'];
                    break;
                }

                case 'no':
                {
                    $this->_exclude_tag_ids[] = $tag['Id'];
                    break;
                }

            }

        }

    }

    /**
     * Returns the valid search criteria from the posted form
     *
     * @return array
     * @access public
     */
    public function get_posted_criteria ()
    {
        $criteria = array ();     /* Search criteria */
        $valid_fields = null;     /* Valid fields to search */
        $valid_operations = null; /* Valid search operations */
        $fields = null;           /* Posted fields */
        $operations = null;       /* Posted operations */
        $text_values = null;      /* Text value posted */
        $date_values = null;      /* Date value posted */
        $i = null;
        $tmp_field = null;
        $field = null;
        $operation = null;
        $value = null;

        $valid_fields = $this->get_valid_fields ();
        $valid_operations = $this->get_valid_operations ();

        $fields = $this->input->post ('field');
        $operations = $this->input->post ('operation');
        $text_values = $this->input->post ('text-value');
        $date_values = $this->input->post ('date-value');

        if (is_array ($fields) === false) {
            return array ();
        }

        foreach ($fields as $i => $tmp_field) {

            $field = null;
            $operation = null;
            $value = '';

            if (array_key_exists ($tmp_field, $valid_fields) === false) {
                continue;
            }

            $field = $valid_fields[$tmp_field];

            if (array_key_exists ($i, $operations) === false
                || array_key_exists ($operations[$i], $valid_operations) === false) {
                continue;
            }

            $operation = $operations[$i];

            if ($field['type'] === 'date' && array_key_exists ($i, $date_values)) {
                $value = trim ($date_values[$i]);
            } elseif ($field['type'] === 'string' && array_key_exists ($i, $text_values)) {
                $value = trim ($text_values[$i]);
            }

            if ($value === '') {
                continue;
            }

            $criteria[] = array (
                'field' => $tmp_field,
                'operation' => $operation,
                'value' => $value
            );

        }

        return $criteria;

    }

    /**
     * Returns a list of valid search fields
     *
     * @return array
     * @access public
     */
    public function get_valid_fields ()
    {
        return array (
            'FirstName' => array (
                'label' => 'First Name',
                'type' => 'string',
             ),
            'LastName' => array (
                'label' => 'Last Name',
                'type' => 'string',
             ),
            'Birthday' => array (
                'label' => 'Birthday',
                'type' => 'date',
             ),
            'City' => array (
                'label' => 'City',
                'type' => 'string',
             ),
            'State' => array (
                'label' => 'State',
                'type' => 'string',
             ),
            'Country' => array (
                'label' => 'Country',
                'type' => 'string',
             ),
            'Email' => array (
                'label' => 'Email address',
                'type' => 'string',
             ),
        );

    }

    /**
     * Returns a list of valid search operations
     *
     * @return array
     * @access public
     */
    public function get_valid_operations ()
    {
        return array (
            'equal' => 'Equals',
            'notequal' => "Doesn't equal",
            'greaterthan' => 'Is greater than',
            'lessthan' => 'Is less than'
        );

    }

    /**
     * Performs the search and returns the results
     *
     * @return array
     * @access public
     */
    public function search ()
    {
        $where = array ();      /* List of WHERE statements */
        $query = null;          /* SQL query */
        $criteria = null;       /* Search criteria */
        $operation = null;      /* Search operation */
        $contact_ids = null;    /* List of contact IDs */
        $stmt = null;           /* DB statement */
        $row = null;            /* DB row */
        $result = array ();     /* Search result */

        $query = (
            'SELECT ' . implode (', ', array_keys ($this->get_datatable_headers ()))
            . ' FROM contact'
        );

        $where[] = '_IsCrmUserYN = FALSE';

        /*
         * Add the normal search criteria
         */

        foreach ($this->_criteria as $criteria) {

            switch ($criteria['operation']) {

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
                    continue;

            }

            $where[] = $criteria['field'] . ' ' . $operation . ' ' . $this->db->escape ($criteria['value']);

        }

        /*
         * Add the tags
         */

        if (count ($this->_include_tag_ids) > 0) {

            $contact_ids = $this->_get_joined_contact_ids ($this->_include_tag_ids);

            if (count ($contact_ids) > 0) {
                $where[] = 'Id IN (' . implode (', ', $contact_ids) . ')';
            }

        }

        if (count ($this->_exclude_tag_ids) > 0) {

            $contact_ids = $this->_get_joined_contact_ids ($this->_exclude_tag_ids);

            if (count ($contact_ids) > 0) {
                $where[] = 'Id NOT IN (' . implode (', ', $contact_ids) . ')';
            }

        }

        if (count ($where) > 0) {
            $query .= ' WHERE ' . implode (' AND ', $where);
        }

        /*
         * Return the results
         */

        $stmt = $this->db->query ($query);

        foreach ($stmt->result_array () as $row) {
            $result[] = $row;
        }

        return $result;

    }

    /**
     * Returns the table headings for the datatable
     *
     * @return array
     * @access public
     */
    public function get_datatable_headers ()
    {
        return array (
            'Id' => '#',
            'FirstName' => 'First Name',
            'LastName' => 'Last Name',
            'PostalCode' => 'Postcode',
        );

    }

    /**
     * Saves the search criteria
     *
     * @return void
     * @access public
     */
    public function save_criteria ()
    {
        $search_id = null;      /* Search ID */
        $data = null;           /* DB data */
        $criteria = null;       /* Search criteria */
        $tag_id = null;         /* Tag ID */

        $this->load->model ('contactsearchcriteria_model');
        $this->load->model ('contactsearchtag_model');

        $search_id = $this->input->post ('search-id');
        $data = $this->get_single_record ($search_id);

        if (array_key_exists ('Id', $data) && $data['Id']) {

            $this->contactsearchcriteria_model->delete_by ('Search_id', $search_id);
            $this->contactsearchtag_model->delete_by ('Search_id', $search_id);

            $data['UpdatedDate'] = date ('Y-m-d H:i:s');
            $data['name'] = $this->input->post ('search-name');

            $this->save ($data, $search_id);

        } else {

            $data = array (
                'Contact_id' => $this->session->userdata ('UserId'),
                'CreationDate' => date ('Y-m-d H:i:s'),
                'UpdatedDate' => date ('Y-m-d H:i:s'),
                'name' => $this->input->post ('search-name')
            );

            $search_id = $this->save ($data);

        }

        $this->_data = $data;

        foreach ($this->_criteria as $criteria) {

            $data = array (
                'Search_id' => $search_id,
                'field' => $criteria['field'],
                'operation' => $criteria['operation'],
                'value' => $criteria['value']
            );

            $this->contactsearchcriteria_model->save ($data);

        }

        foreach ($this->_include_tag_ids as $tag_id) {

            $data = array (
                'Search_id' => $search_id,
                'Tag_id' => $tag_id,
                'include' => true
            );

            $this->contactsearchtag_model->save ($data);

        }

        foreach ($this->_exclude_tag_ids as $tag_id) {

            $data = array (
                'Search_id' => $search_id,
                'Tag_id' => $tag_id,
                'include' => false
            );

            $this->contactsearchtag_model->save ($data);

        }

    }

    /**
     * Loads in a previous search
     *
     * @param integer $search_id
     * @return void
     * @access public
     */
    public function load ($search_id)
    {
        $data = null;           /* DB data */
        $tag_rows = null;       /* List of tag rows */
        $tag_row = null;        /* Tag row */

        $this->_criteria = array ();
        $this->_include_tag_ids = array ();
        $this->_exclude_tag_ids = array ();

        $data = $this->get_single_record ($search_id);

        if (array_key_exists ('Contact_id', $data) === false || $data['Contact_id'] !== $this->session->userdata ('UserId')) {
            return;
        }

        $this->_data = $data;

        $this->load->model ('contactsearchcriteria_model');
        $this->load->model ('contactsearchtag_model');

        $this->_criteria = $this->contactsearchcriteria_model->get_by ('Search_id', $search_id);
        $tag_rows = $this->contactsearchtag_model->get_by ('Search_id', $search_id);

        foreach ($tag_rows as $tag_row) {

            if ($tag_row['include']) {
                $this->_include_tag_ids[] = $tag_row['Tag_id'];
            } else {
                $this->_exclude_tag_ids[] = $tag_row['Tag_id'];
            }

        }

    }

    /**
     * Returns the ID of the search
     *
     * @return integer
     * @access public
     */
    public function get_id ()
    {
        if (is_array ($this->_data)){
            return $this->_data['Id'];
        }

    }

    /**
     * Returns the name of the search
     *
     * @return string
     * @access public
     */
    public function get_name ()
    {
        if (is_array ($this->_data)){
            return $this->_data['name'];
        }

    }

    /**
     * Returns the search criteria
     *
     * @return array
     * @access public
     */
    public function get_criteria ()
    {
        return $this->_criteria;
    }

    /**
     * Returns the included tag IDs
     *
     * @return array
     * @access public
     */
    public function get_included_tag_ids ()
    {
        return $this->_include_tag_ids;
    }

    /**
     * Returns the excluded tag IDs
     *
     * @return array
     * @access public
     */
    public function get_excluded_tag_ids ()
    {
        return $this->_exclude_tag_ids;
    }

    /**
     * Returns the contacts which are joined to the given tag IDs
     *
     * @param array $tag_ids
     * @return array
     * @access private
     */
    private function _get_joined_contact_ids (array $tag_ids)
    {
        $query = null;           /* SQL query */
        $stmt = null;            /* DB statement */
        $row = null;             /* DB row */
        $contact_ids = array (); /* List of contact IDs */

        $query = (
            'SELECT __ContactId'
            . ' FROM __tagjoin'
            . ' WHERE __TagId IN (' . implode (', ', $tag_ids) . ')'
        );

        $stmt = $this->db->query ($query);

        foreach ($stmt->result_array () as $row) {
            $contact_ids[] = $row['__ContactId'];
        }

        return array_unique ($contact_ids);

    }

}

/* End of file contactsearch_model.php */
/* Location: ./application/models/contactsearch_model.php */