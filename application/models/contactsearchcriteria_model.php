<?php

if (defined ('BASEPATH') === false)
{
  exit ('No direct script access allowed');
}

/**
 * Model for accessing contact criteria
 */
class Contactsearchcriteria_model extends MY_Model
{
    /**
     * The database table to use
     *
     * @var string
     * @access public
     */
    public $table_name = 'Contact_Search_Criteria';
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

}

/* End of file contactsearchcriteria_model.php */
/* Location: ./application/models/contactsearchcriteria_model.php */
