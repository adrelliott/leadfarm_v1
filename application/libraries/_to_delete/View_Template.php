<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
/*
 * This class is designed to generate a var ($html) that is a concatenation of all
 * the views every up for the header, navbar, {body} and footer. {body} is taken from
 * $this->data['controller'] and allows us to use this same class to load all of our views.
 * We simply pass the main view's name via $this->data['controller'] and this tempate will 
 * hunt for it and insert it inot the resulting HTML.
 * 
 * NOTE: The app directory structure dictates that we first look for the view in
 * the 'views/custom/XXXX' directory (where 'XXXX' is the dID of the data owner),
 * and we must always have a directory named the controller that contains the file
 * e.g. filename.php is kept in /views/custom/XXXX/{controller_name}/filename.php
 */

class View_Template  extends User_Controller {
        var $CI;
        var $data;
        var $navbar_html;        
        
        public function __construct($data)
        {
            $this->CI =& get_instance();     //allows us to use CI functionality       
            $this->data = $data;    //grabs data from User_Controller (mainly navbar config)
            $this->data['navbar_html'] = $this->gen_navbar();
        }
   
      private function gen_navbar() //returns an array of ready-to-use links
      {
          $retval = array(); 
          $n = $this->data['config']['navbar_setup'];
          //Loop through each of the navbar setup properties and generate html <li>
          foreach ( $n as $v => $array )
            {
              if ($n[$v]['controller'] == $this->data['controller_name'])
              {
                  $n[$v]['css'] = $n[$v]['css'] . ' active';    //Sets CSS for current page
              }
              $li = '<li class="' .$n[$v]['css'] . ' ">';
              $retval[] = $li . '<a href="' . base_url() . DATAOWNER_ID . '/' . $n[$v]['controller'] . '">
                        <span>' . $n[$v]['icon'] . $n[$v]['pagename'] . '</span></a></li>';
            } 
           return $retval;  //This sis sent ot the Navbar.php view 
      }

      
      public function load_page($data)
      {          
 //echo "<pre> here comes the data in Voewtemplate";print_r($data);echo "</pre>";
          extract($data); //turns array into vars
          $pageElements = Array ('@@header', '@@navbar', $view_file, '@@footer');
            //we use '@@' as an identifier - see the 'substr' line below...
          $html = '';
          foreach ($pageElements as $n) //$n = page element/filename
          {
              if ( substr($n, 0, 2) != '@@' )   //i.e. if its $data['view']
              {
                  $path_filename = $controller_name . '/' . $n . '.php';
              }
              else
              {
                  if ( isset($modal) )   //test for modal 
                  //(Add $this->data['modal'] = TRUE to controller to load modal_header & modal_navbar
                  {
                      $n = substr($n, 2) . '_modal';
                  }
                  else
                  {
                      $n = substr($n, 2);
                  }
                  $path_filename = 'common/' . $n . '.php';
              }
          
              //Now check for the file and return the file from the custom folder, if its exists, 
              //or default folder if it does not. Throws error if it cannot find either
              
              $page_paths[$n] = custom_or_default_file(APPPATH , 'views', $path_filename, DATAOWNER_ID);  //function defined in file_helper
           
                //Now load each view a string to create an $html ready for outputting
              $html .= $this->CI->load->view($page_paths[$n], $this->data, TRUE);
          }          
          echo $html;
      }
}

/*
 * <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   
/*
 * This class is designed to generate a var ($html) that is a concatenation of all
 * the views every up for the header, navbar, {body} and footer. {body} is taken from
 * $this->data['controller'] and allows us to use this same class to load all of our views.
 * We simply pass the main view's name via $this->data['controller'] and this tempate will 
 * hunt for it and insert it inot the resulting HTML.
 * 
 * NOTE: The app directory structure dictates that we first look for the view in
 * the 'views/custom/XXXX' directory (where 'XXXX' is the dID of the data owner),
 * and we must always have a directory named the controller that contains the file
 * e.g. filename.php is kept in /views/custom/XXXX/{controller_name}/filename.php
 */