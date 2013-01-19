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
        // Put code here that is to be called before any other controller
        
        // 1. Test is_logged_in. This Redirects to login if not.
        //$this->_is_logged_in();
        
        // 2. Define dID
        define('DATAOWNER_ID', 22222);    //this needs to be taken from the URL 
        
        // 3. Load the bespoke config
        $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');

        // 4. Now start to set up the $data[config] array for the View_template
        $this->data['view_setup']['navbar'] = $this->config->item('navbar_setup');
        $this->data['config'] = $this->config->item($controller_name);
        
        // 5. now load the database settings
        $dbConn = $this->config->item('database');     //these are different for each dID       
        $this->load->database($dbConn, FALSE, TRUE); //load this dID's database 
        
        // 6. Finally set up last minute vars
        $this->data['controller_setup']['controller_name'] = $this->controller_name;
        
        
    ///#/#/#/#/#/#/#/#/#/#CHANGE THIS TO **FALSE** WHEN IN PRODUCTION!/'/#/#/#/#
        $this->output->enable_profiler(TRUE);
        
        
    }
    
    //============================================
    public function prepare_model($config, $method_name) {
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
    
    public function generate_datasets($datasets) {
        $results = array(); 
        foreach ($datasets as $dataset => $config)
        {
            $model_name = $config['model_name'];
            $model_method = $config['model_method'];
            $this->load->model($model_name );
            $this->db->select(array_keys($config['fields']));
            $results[$dataset] = $this->$model_name->
                    $model_method(if_exists($config['model_params']));
        }
        
        return $results;
        
    }
    
    function retrieve_record ($rID, $config) {
        $results = $config['fields'];        
        //now either get the record or leave it as blank
        if ($rID != 'new')
        {
            $model_name = $config['model_name'];
            $model_method = $config['model_method']; 
            $this->load->model($model_name );
            $this->db->select(array_keys($config['fields']));
            $query = $this->$model_name->
                $model_method($rID, if_exists($config['model_params']));
            foreach ($query as $col_name => $value)
            {
                $results[$col_name]['value'] = $value;
            }
        }
		
        return $results;
    }
    
    
    //=============================================   
    
    
    public function index() {
        // 1. Set up the vars for this method
        extract($this->data); 
        extract($this->data['controller_setup']); 
        
        // 2. prepare the model_setup array (this controls the queries)       
        $this->data['model_setup'] = $this->prepare_model($config, $method_name);
        unset($this->data['config']);   //Tidy up
        
        // 3. Do the queries (data goes in ['controller_setup']['results']
        $results = array();
        foreach ($this->data['model_setup'] as $query_type => $array)
        {
            switch ($query_type)
            {
                case 'datasets':
                    foreach ($array as $dataset => $config)
                    {
                        extract($config);
                        //do query
                        $this->load->model($model_name);
                        $this->db->select(array_keys($fields));
                        $results[$query_type][$dataset] = $this->$model_name->get_all_records($model_params);
                    }
                    break;
                case 'record':
                        //$results[$query_type] = $this->$model_name->get_single_record($id, $model_params);  //make sure $id is passed properly
                    break;
                default:
                    show_error("MY_Controller:88, query_type didn't match datasets or record");
            }
        }
        
        // 4 . Hand over to $this->data['controller_setup'] to process results
        unset($this->data['model_setup']);  //Tidy up
        $this->data['controller_setup']['results'] = $results;

print_array($this->data);
    }
    
    public function view($rID) {
        // 1. Set up the vars for this method
        extract($this->data); 
        extract($this->data['controller_setup']); 
        
        // 2. prepare the model_setup array (this controls the queries)
        $this->data['model_setup'] = $this->prepare_model($config, $method_name);
        unset($this->data['config']);   //Tidy up
        
        // 3. Do the datasets query & hand over to the controller_setup to post-process data
        $this->data['controller_setup']['datasets'] = $this->generate_datasets($this->data['model_setup']['datasets']);
        
        // 4. Now do the record query (data goes in ['controller_setup']['results']['record']
        // (This is the query that gets all the data for this record        
        $this->data['controller_setup']['record'] = $this->retrieve_record($rID, $this->data['model_setup']['record']);
        
       // $config = $this->data['model_setup']['record'];
        //$results = $config['fields'];
        
        //now either get the record or leave it as blank
       /* if ($rID != 'new')
        {
            $model_name = $config['model_name'];
            $model_method = $config['model_method']; 
            $this->load->model($model_name );
            $this->db->select(array_keys($config['fields']));
            $query = $this->$model_name->
                $model_method($rID, if_exists($config['model_params']));
            foreach ($query as $col_name => $value)
            {
                $results[$col_name]['value'] = $value;
            }
        }*/
        
        //hand over to the controller_setup to post-process data
        //$this->data['controller_setup']['record'] = $results;
        unset($this->data['model_setup']); //Tidy up...
        
       $this->generate_view();
       
       //print_array($this->data);
               
        
    }
    
     
    public function generate_view($view_array = NULL) {
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
    
    
    
      function custom_or_default_file($dir, $filename, $containing_dir = 'view', $file_ext = 'php') {
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
    
    
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        function custom_or_default_view_file_test($dir, $filename, $file_type = 'php') {
        
        echo "dir = $dir, fielname = $filename, fieltype = $file_type,";
        
       $result = file_exists(APPPATH . 'views/custom/22222/common/page.php');
        echo "<p>Result = $result, fiepath is " . APPPATH . 'views/custom/22222/common/page.php' . "</p>";
        
        //echo "<br/> path 1 is " . APPPATH . 'views/custom/' . DATAOWNER_ID . "/$dir/$filename.$file_type";
        
        if (file_exists(APPPATH . 'views/custom/' . DATAOWNER_ID . "/$dir/$filename.$file_type"))
        {
           //echo "/... yes! 1, ";
                $retval = "custom/" . DATAOWNER_ID . "/$dir/$filename.$file_type";
        }          
        elseif (file_exists(APPPATH . "views/default/$dir/$filename.$file_type"))
        {
            //echo "/... yes! 2, ";
            $retval = "default/$dir/$filename.$file_type";
        }
        else
        {
             show_error("Unable to load the requested file from $dir: $filename.$file_type");
        }
        
        return $retval;
        }
        
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function populate_placeholders ($array) {
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
    
    
    
   
      /*
    |--------------------------------------------------------------------------
    | Loggin in/out
    |--------------------------------------------------------------------------
    | Methods for loggin in and out. See also controllers/login.php   
    |
    */
    private function _is_logged_in() {  //used as a test to see if all is well
         $status = $this->session->userdata('is_logged_in');
         /*$_dID = $this->session->userdata('_dID');
         
         if (!isset($_dID))
         {
             $status = FALSE;   //re-login if session data lost
         }*/
         if (!isset($status) || $status !== TRUE)
         {
             //kick them out
             $message = "Oops. Your session has ended. Please log in";
             $this->data['view_setup']['message'] = $message;
             redirect('login/');
         }
     }
}
/* End of file MY_Controller.php */
/* Location: ./application/core */