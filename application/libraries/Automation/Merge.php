<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Merge Class
 *
 * Takes the template and retrieves the 
 *
 */

//include(APPPATH . 'libraries/Automation/Crud_lib.php');

//class Merge extends Crud_lib {
class Merge {
  
  var $query            = '';
  
  /**
   * Constructor - Sets PostageApp Preferences
   *
   * The constructor can be passed an array of config values
   */
  function Merge($config = array()){
        //parent::__construct();
  }
  
  function get_cols($template_ids = array()) {
      if( empty($template_ids)) return FALSE;
      print_array($template_ids, 0, 'this si template ids from merge');
  }
  
  
}

/* End of file Merge.php */
/* Location: ./system/application/libraries/Merge.php */