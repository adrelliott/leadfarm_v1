<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */
    
    public $data = array
            (
                'config' => array   //store all the congif items here
                    (
                    
                    ),
                'model_setup' => array  //store all vars for queries
                    (
                    
                    ),
                'controller_setup' => array    //store all vars for controlle
                    (
                    
                    ),
                'view_setup' => array   //store all vars for view  
                    (
                        'header_file' => 'header', //turned into modal in T_Controller
                        'footer_file' => 'footer', //turned into modal in T_Controller
                    ),              
            );
    
    public function __construct($controller_name) {
        parent::__construct();
        //Allow the use of query strings as well as trad CI URL paras
        parse_str(str_replace($_SERVER['QUERY_STRING'],'',$_SERVER['REQUEST_URI']),$_GET);
        
        // Put any code here that is to be called before any other controller
        
         
        // 1. Test is_logged_in. This Redirects to login if not.
        $this->_is_logged_in();
        
        // 2. Define dID
        define('DATAOWNER_ID', $this->session->userdata('_dID'));    
        
        // 3. Load the bespoke config
        $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');

        // 4. Now start to set up the $data[config] array for the View_template
        $this->data['view_setup']['navbar'] = $this->config->item('navbar_setup');
        $this->data['config'] = $this->config->item($controller_name);
        $this->data['view_setup']['user_data'] = $this->session->all_userdata();
        
        // 5. now load the database settings
        $dbConn = $this->config->item('database');     //these are different for each dID       
        $this->load->database($dbConn, FALSE, TRUE); //load this dID's database 
        
        // 6. Finally set up last minute vars
        $this->data['controller_setup']['controller_name'] = $this->controller_name;
        
        //if (ENVIRONMENT == 'development') $this->output->enable_profiler(TRUE);
    }
    
    
    //Is there any need for an index() function here?
   
    
    
    protected function _load_view_data($rID = NULL) {
        // 1. Set up the vars for this method
        extract($this->data); 
        extract($this->data['controller_setup']); 
        
        // 2. prepare the model_setup array (this controls the queries)
        $this->data['model_setup'] = $this->_prepare_model($config, $method_name);        
       
        // 3. Do the datasets query & hand over to the controller_setup to post-process data
        if (isset($this->data['model_setup']['datasets']))
        { 
            //do all querues for dropdowns and tables
            $this->data['controller_setup']['datasets'] = $this->_generate_datasets(
                    $this->data['model_setup']['datasets']
                    );
            
            $table_headers =  $this->data['config']['datasets'][$method_name];
            $datasets = $this->data['controller_setup']['datasets'];
            
            //set up table data array
            foreach ($datasets as $dataset => $array)
            {
               $this->data['view_setup']['tables'][$dataset]['table_headers'] = 
                        $this->_generate_table_headings($table_headers[$dataset]['fields']);
               $this->data['view_setup']['tables'][$dataset]['table_data'] = $array;
            }
                  
            //Generate an array of options for dropdown
            if (isset($this->data['config']['record'][$method_name]['dropdowns']))
            {            
                $dropdowns = $this->data['config']['record'][$method_name]['dropdowns']; 
                foreach ($dropdowns as $dropdown => $config)
                {
                    $this->data['view_setup']['dropdowns'][$dropdown] = $this->_create_dropdown(
                        $dropdowns[$dropdown], 
                        $datasets[$dropdown]
                        );
                }
            }
        }
        
        // 4. Now do the record query. store in ['controller_setup']['results']['record']
        // (This is the query that gets all the data for this record        
        if (isset($this->data['model_setup']['record']) && $rID != NULL)
        { 
            $this->data['view_setup']['fields'] = $this->_retrieve_record(
                   $rID, 
                   $this->data['model_setup']['record']
                   );
           
        }
        
        // 5. Any post processing to be done?
        $method_name = 'post_process_' . $this->controller_name;
        if (method_exists($this,$method_name)) $this->$method_name($this->data);
        
        // 6. Now add the fields to view set up, tidy up & generate the view        
        $this->data['view_setup']['method_name'] = $method_name;
        $this->data['view_setup']['controller_name'] = $controller_name;
        
               //Tidy up 
        unset($this->data['model_setup']); //Tidy up...
        unset($this->data['config']);       
        unset($this->data['controller_setup']);
        
        //Now let the individual controllers take over and fetch view
       
    }
    
    
    
    
    
               
    /*
    |--------------------------------------------------------------------------
    | Data Manipulation Methods
    |--------------------------------------------------------------------------
    | These methods are post-processing of data retrieved from DB or API, or 
     *data that has been submitted and needs cleaning before instertion
    |
    */
       
    protected function _create_dropdown($config, $data, $direction = NULL) {
        //converts table results to a dropdown as defined in $config['controller_name']['dropdowns']
        $retval = array();
        extract($config);
        
        //cycle through each result
        foreach ($data as $row => $array)
        {
            $k = '';
            foreach ($label as $col_name)
            {
                $k .= $array[$col_name] . $label_separator;
            }
            
            $retval[$k] = $array[$value];
        }
        
        return $retval;
    } 
    
    protected function _generate_table_headings($fields) {
        $retval = array();
        foreach ($fields as $fieldName => $tableHeading)
        {
            if ($tableHeading != '')    //no value = no heading rqd
            {
                if (strpos($fieldName, '.')) //Strips out the table name
                { 
                    $fieldname_array = explode('.', $fieldName);
                        //creates [0] => table, and [1] => fieldname
                    $fieldName = $fieldname_array[1];
                }                        
                $retval[$fieldName] = $tableHeading;
            }
        }
        
        return $retval;
    }
    
    
     
   
    
    
    /*
    |--------------------------------------------------------------------------
    | CRUD methods
    |--------------------------------------------------------------------------
    | Methods for CRUD   
    |
    */
   protected function _prepare_model($config, $method_name) {
         if (isset($config['datasets'][$method_name]))
        {
            $model_setup['datasets'] = 
                    $config['datasets'][$method_name];
        }        
        if (isset($config['record'][$method_name]))
        {
            $model_setup['record'] = 
                    $config['record'][$method_name];
        }
        
        return $model_setup;
    }
    
     protected function _generate_datasets($datasets) {
        $results = array(); 
        foreach ($datasets as $dataset => $config)
        {
            $results[$dataset] = $this->_generate_dataset ($config);
        }
        
        return $results;        
    }
    

    protected function _generate_dataset ($config) {

        if (isset($config['include_in_query']) && $config['include_in_query'])
        {
            $model_name = $config['model_name'];
            $model_method = $config['model_method'];
            $this->load->model($model_name );
            $this->db->select(array_keys($config['fields']));
            return $this->$model_name->$model_method(if_exists($config['model_params']));
        }
        else
        {
            return $config;
        }
    }

    protected function _retrieve_record ($rID, $config) {
        $results = $config['fields'];        
        //now either get the record or leave it as blank
        if (is_numeric($rID))
        {
            $model_name = $config['model_name'];
            $model_method = $config['model_method']; 
            $this->load->model($model_name );
            $col_names = array();
            foreach ($config['fields'] as $key => $array)
            {
                //echo "<br/>key = $key, ";print_r($array);
                if ($array['on'])
                {
                    $col_names[] = $array['name'];
                }
            }
           // print_array($col_names);
            $this->db->select($col_names);
            $query = $this->$model_name->
                $model_method($rID, if_exists($config['model_params']));
            foreach ($query as $col_name => $value)
            {
                $results[$col_name]['value'] = $value;                
            }
        }
        else
        {
            $this->data['view_setup']['display_none'] = 'display:none'; //hides the other parts fo the form
        }
		
        return $results;
    }
    
    function add_record($input, $rID) {        
        $model_name = $this->controller_name . '_model';
        $this->load->model($model_name);
        $rID = $this->$model_name->add($input, $rID); 
        
        return $rID;
    }
    
    
    
    
    
    
    
      /*
    |--------------------------------------------------------------------------
    | View methods
    |--------------------------------------------------------------------------
    | Methods for loggin in and out. See also controllers/login.php   
    |
    */
    
     protected function _generate_view($data, $view_array = NULL) {
        // 1 . Set up the variables
        /*extract($data['controller_setup']);
        $data['view_setup']['method_name'] = $method_name;
        $data['view_setup']['controller_name'] = $controller_name;*/
        //This method talkes the view array and generates the header/navbar/body/footer

        // 2. Generate the navbar and output as HTML
        
         $navbar_setup = $data['view_setup']['navbar'];
            //Loop through each of the navbar setup properties and generate html <li>
        $html = '';
        foreach ( $navbar_setup as $navbar_item => $array )
        {
            if ($array['controller'] == $this->controller_name)
            {
                $array['css'] .= ' active';    //Sets CSS for current page
            }
            $html .= '<li class="' .$array['css'] . ' ">';
            $html .= '<a href="' . base_url() . DATAOWNER_ID . '/' . $array['controller'];
            $html .= '"><span>' . $array['icon'] . $array['pagename'] . '</span></a></li>';
        }
            //This is the HTML for the navbar
        $data['view_setup']['navbar'] = $html;
        $this->data['view_setup'] = $data['view_setup'];
        
        // 3. Load the views & pass the data
        extract($data['view_setup']);
        $this->load->view($this->_custom_or_default_file('common', $header_file), $data);
        $this->load->view($this->_custom_or_default_file($controller_name, $view_file), $data['view_setup']);
        $this->load->view($this->_custom_or_default_file('common', $footer_file), $data);
    }
    
  
     protected  function _custom_or_default_file($dir, $filename, $containing_dir = 'view', $file_ext = 'php') {
        //looks in views/custom/DATAOWNER_ID/dir for filename first then, if it is
        //not found, it looks in views/default/dir
        //This allows us to over-ride deafult views with cutom ones
        if (file_exists(APPPATH . "views/custom/" . DATAOWNER_ID . "/$dir/$filename.$file_ext"))
        {
            $retval = "custom/" . DATAOWNER_ID . "/$dir/$filename.$file_ext";
        }         
        elseif (file_exists(APPPATH . "views/default/$dir/$filename.$file_ext"))
        {
            $retval = "default/$dir/$filename.$file_ext";
        }
        else
        {
             show_error("Unable to load the requested file: $filename.$file_ext");
        }
        
        return $retval; //returns path & filename
        }
        
    protected function getQueryStringParams() {
        parse_str($_SERVER['QUERY_STRING'], $params);
        return $params;
    }
    
    
        
    
    
  
    
   
      /*
    |--------------------------------------------------------------------------
    | Loggin in/out
    |--------------------------------------------------------------------------
    | Methods for loggin in and out. See also controllers/login.php   
    |
    */
    private function _is_logged_in() {  //used as a test to see if all is well
         $status = $this->session->userdata('is_logged_in');
         //echo "status= $status and url para is" . $this->uri->segment(1);die;
         if (!isset($status) || $status !== TRUE)
         {
             //kick them out
             $dID = $this->uri->segment(1) . '/';
             $message = "Oops. Your session has ended. Please log in";
             $this->data['view_setup']['message'] = $message;
             
             redirect($dID . 'login/');
         }
     }
     
     
     
     ////////////delete me!!!!!///////////////////// /*
     /*
      * methods we THINK we no longer need
      * 
      * 
       /*function process_datasets ($datasets) {
        $results = array(); 
        foreach ($datasets as $dataset => $config)
        {
            if (isset($config['include_in_query']))
            {
                //go through the data set and 
            }
            else
            {
                //$results[$dataset] = $config;
            }            
        }
        
        return $results;     
    }*/
     
      /*public function populate_placeholders ($array) {
        if (! is_array($array))
        {
            $array = array($array);
        }
        
         foreach ($array as $column => $value)
        {
            if (substr($value, 0, 2) == '??')
            {
                switch (substr($value, 2))  //remove the first 2 '??'
                {
                    case 'rID':
                        $array[$column] = $this->rID;
                        break;
                    //add more placeholders here
                    default:
                        break;
                }
            }            
        }
        
        return $array;
     }
    
    */
      /*
     public function view_backup($rID) {
        // 1. Set up the vars for this method
        extract($this->data); 
        extract($this->data['controller_setup']); 
        
        // 2. prepare the model_setup array (this controls the queries)
        $this->data['model_setup'] = $this->prepare_model($config, $method_name);        
        
        // 3. Do the datasets query & hand over to the controller_setup to post-process data
        $this->data['controller_setup']['datasets'] = $this->generate_datasets(
                $this->data['model_setup']['datasets']
                );
        
        // 4. Now do the record query (data goes in ['controller_setup']['results']['record']
        // (This is the query that gets all the data for this record        
        $this->data['controller_setup']['record'] = $this->retrieve_record(
                $rID, 
                $this->data['model_setup']['record']
                );
        unset($this->data['model_setup']); //Tidy up...
        
         // 5. Create the dropdown menus & table
        $datasets = $this->data['controller_setup']['datasets'];
        $dropdowns = $this->data['config']['record'][$method_name]['dropdowns'];
        $table_headers =  $this->data['config']['datasets'][$method_name];//daataset['fields']
        
            //Feed the dropdown config and the data to this method to generate an array of options
        if (isset($dropdowns))
        {
            foreach ($dropdowns as $dropdown => $config)
            {
                $this->data['view_setup']['dropdowns'][$dropdown] = $this->create_dropdown(
                    $dropdowns[$dropdown], 
                    $datasets[$dropdown]
                    );
            }
        }
        
            //Create the table headers & table data
        if (isset($datasets))
        {
            foreach ($datasets as $dataset => $array)
            {
               $this->data['view_setup']['tables'][$dataset]['table_headers'] = 
                        $this->generate_table_headings($table_headers[$dataset]['fields']);
               $this->data['view_setup']['tables'][$dataset]['table_data'] = $array;
            }
        }
        
        // 6. Now add the fields to view set up, tidy up & generate the view        
        $this->data['view_setup']['fields'] = $this->data['controller_setup']['record'];
        $this->data['view_setup']['method_name'] = $method_name;
        $this->data['view_setup']['controller_name'] = $controller_name;        
        
               //Tidy up 
        unset($this->data['config']);       
        unset($this->data['controller_setup']);
        
            // Generate the view!
        $this->generate_view($this->data);
       
    }
         
           /*public function generate_view_backup($view_array = NULL) {
        // 1 . Set up the variables
        extract($this->data['controller_setup']);
        $this->data['view_setup']['method_name'] = $method_name;
        $this->data['view_setup']['controller_name'] = $controller_name;
        //This method talkes the view array and generates the header/navbar/body/footer

        // 2. Generate the navbar and output as HTML
        $navbar_setup = $this->data['view_setup']['navbar'];
            //Loop through each of the navbar setup properties and generate html <li>
        $html = '';
        foreach ( $navbar_setup as $navbar_item => $array )
        {
            if ($array['controller'] == $this->controller_name)
            {
                $array['css'] .= ' active';    //Sets CSS for current page
            }
            $html .= '<li class="' .$array['css'] . ' ">';
            $html .= '<a href="' . base_url() . DATAOWNER_ID . '/' . $array['controller'];
            $html .= '"><span>' . $array['icon'] . $array['pagename'] . '</span></a></li>';
        }
            //This is the HTML for the navbar
        $this->data['view_setup']['navbar'] = $html;
        
        // 3. Load the views & pass the data
        extract($this->data['view_setup']);
        $this->load->view($this->custom_or_default_file('common', 'header'), $this->data);
        $this->load->view($this->custom_or_default_file($controller_name, $view_file), $this->data);
        $this->load->view($this->custom_or_default_file('common', 'footer'), $this->data);
    }
    
    
         
         
        
         *     
         */
        /*public function add($rID) {
        // 1. Set up the vars for this method
        extract($this->data); 
        extract($this->data['controller_setup']); 
        
        // 2. process the input
        
        // 3. Prepare the query (if rID = new then its insert)

        // 4. set up the message and prepare the view
        //if its new, then 
        $this->data['view_setup']['display_none'] = 'display:none';
        $this->data['view_setup']['org_flag'] = '1 OR 0'; //depedns on the typ of record

        // 2. prepare the model_setup array (this controls the queries)
        $this->data['model_setup'] = $this->prepare_model($config, $method_name);
        unset($this->data['config']);   //Tidy up
        
        // 3. Do the datasets query & hand over to the controller_setup to post-process data
        $this->data['controller_setup']['datasets'] = $this->generate_datasets($this->data['model_setup']['datasets']);
        
        // 4. Now do the record query (data goes in ['controller_setup']['results']['record']
        // (This is the query that gets all the data for this record        
        $this->data['controller_setup']['record'] = $this->retrieve_record($rID, $this->data['model_setup']['record']);
        unset($this->data['model_setup']); //Tidy up...
       
        // 4. Generate the view!
       $this->generate_view($this->data);
       
    }*/
        
}
/* End of file MY_Controller.php */
/* Location: ./application/core */
