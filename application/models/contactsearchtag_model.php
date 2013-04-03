<?php

if (defined ('BASEPATH') === false)
{
  exit ('No direct script access allowed');
}

/**
 * Model for accessing contact tags
 */
class Contactsearchtag_model extends CRM_Model
{
    /**
     * The database table to use
     *
     * @var string
     * @access public
     */
    public $table_name = 'Contact_Search_Tag';
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

/* End of file contactsearchtag_model.php */
/* Location: ./application/models/contactsearchtag_model.php */