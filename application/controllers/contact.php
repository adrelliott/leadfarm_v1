<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contact') ) get_bespoke_controller();  //yup = go get it.
else
{   //nope? Use this default class then
    
    class Contact extends CRM_Controller {
        
        public $controller_name = 'contact';
        public $search_tables = array   //should this be private??
            (
                'contact', 'order'
            );

        public function __construct()    {
             parent::__construct();
        }

        public function index() {   
            parent::index();
            $this->_load_view_data();
            $this->_generate_view($this->data);
        }
        
        public function view($view_file, $rID, $ContactId = FALSE, $fieldset = 0, $pull = '') {
            if( ! $ContactId ) //Allows us just to pass contact ID
            {
                redirect( site_url ("contact/view/$view_file/$rID/$rID/$fieldset") ); 
                return;
            }
            
            parent::view($view_file, $rID, $ContactId);   
            
            //What record fieldset do we show? Org, ind or unknown?
            $this->data['view_setup']['fieldset'] = $fieldset;
        
            $this->_load_view_data($rID);
            
            //check for expirations of MOT & service
            $this->load->library('garages/garage');
            
            $this->data['view_setup']['notifications'] = array();
            if (isset($this->data['view_setup']['tables']['vehicles']['table_data'][0]))
            {
                $this->data['view_setup']['notifications'] = 
                        $this->garage->check_vehicle_expiry 
                        (
                        $this->data['view_setup']['tables']['vehicles'],
                        $this->data['view_setup']['ContactId']
                        );
            }

            
            $this->load_view($pull);
        }
        
        public function add($view_file, $rID, $ContactId, $fieldset) {
            //clean input
            $input = clean_data($this->input->post());
            
            //save record
            $rID = $this->add_record($input, $rID);
            
             //Have we set nay client-specific methods to run?
            $method_name = 'add_' . DATAOWNER_ID;
            if (method_exists($this, $method_name)) $this->$method_name($input, $rID);
            
            $url = site_url ($this->controller_name . '/view/' . $view_file . '/' . $rID . '/' . $rID . '/' . $input['_IsOrganisationYN']);

            if ($this->input->is_ajax_request ()) {
                $response = array (
                    'success' => true,
                );

                if ($ContactId === 'new') {
                   $response['redirect'] = $url;
                }

                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($response));
                return;
            }

            //refresh page
            redirect($url);

        }
        
        //Post process data for the view? put it here:
        /*public function post_process_contact() {
            
        }*/
        
        public function append_note($view_file, $rID, $ContactId, $fieldset) {
            //Concatenate the new note ready for updating
            $input = clean_data($this->input->post()); 
            $input['ContactNotes'] .= "\n:::: On " . date('d-m-Y H:i') . ', ' . 
                    $this->session->userdata('FirstName') . ' ' . 
                    $this->session->userdata('LastName') . " wrote:::: \n" . 
                    $input['add_a_note'];  //add the new note details
            unset($input['add_a_note']); //tidy up        

            //save record
            $this->add_record($input, $rID);

            if ($this->input->is_ajax_request()) {
                $response = array(
                    'success' => true,
                    'data' => array ('ContactNotes' => $input['ContactNotes'])
                );
                $this->output->set_content_type('application/json');
                $this->output->set_output(json_encode($response));
                return;
            }

            //refresh page
            redirect( $this->controller_name . '/view/edit/' . $rID . '/' . $ContactId . '/' . $fieldset );

        }
        
        public function delete_record($id = FALSE) {
            //$this->load->model($method_name . '_model', 'contact');
            parent::delete_record($id);
            
            redirect( site_url( '/contact' ));          
        }
        
        /*public function add_22232($input, $rID) {
            //if memberhsip number is blank, then
            if ( $input['_LegacyMembershipNo'] == NULL )
            {
                $input['_LegacyMembershipNo'] = $rID + 50000;
            }
            $this->add_record($input, $rID);
        }*/
        
        function test1($ContactId) {
            //get maximum memberhsip number 
            $this->load->model('contact_model');
            $max_memb_no = $this->contact_model->get_max('_LegacyMembershipNo');
          
            //Now get this contact\s memberhsip number
            $contact_record = $this->contact_model->get($ContactId);
            $current_memb_no = $contact_record['_LegacyMembershipNo'];
            if (  is_null($current_memb_no) || $current_memb_no < 1 )
            {
                $new_member_no = array('_LegacyMembershipNo' => $max_memb_no + 1);
                $r = $this->contact_model->save($new_member_no, $ContactId);
            }
            
        }
        
        public function ajax_feed_ci() {
            $this->load->library('Datatables');
        
            $this->datatables->select('Id, FirstName, LastName, Nickname, PostalCode, Email, Phone1, Phone2, _LegacyMembershipNo');
            $this->datatables->from('contact');
            $data['json_result'] = $this->datatables->generate();
            echo $data['json_result'];
        }
        
        public function ajax_feed  () {
            //load the model & run the method
            $this->load->model('contact_model');
            $output = $this->contact_model->get_data_via_ajax_non_codeigniter();
            //$output = $this->contact_model->get_data_via_ajax_codeigniter();
            
            //output the results as JSON
            echo json_encode( $output );
        }
        
        public function dropdown_ajax_feed() {
            $r = array
                (
                    "al Elliott","lea Elliott","charlie Elliott"
                );
            
            echo json_encode($r);
        }
        
        
        
        
        
        
        
        public function ajax_feed_old($method_name = 'index', $dataset_name = 'contacts') {
            //what fields do we need?
            $config = $this->data['config']['datasets'][$method_name][$dataset_name];
            $fields = $this->_generate_table_headings($config['fields']);
            
            //Whats database settings?
            $this->load->database();
            $conn = array
            (
                'user' => $this->db->username,
                'password' => $this->db->password,
                'db' => $this->db->database,
                'server' => $this->db->hostname,
            );
            
            //Output
            echo generate_ajax_results(array_keys($fields), $conn);
            
        }
        
        public function report($report_type) {
           $this->output->enable_profiler();
             $retval = array();
             $export = FALSE;

             //First work out if we need to export the results as a CSV
             if ($this->input->post('export')) $export = TRUE;

             //Now work out what report type and load the right model
             switch ($report_type)
             {
                 case 'order':
                     //load order model
                     $this->load->model('order_model');
                     $retval = $this->order_model->get_orders_join($export);
                     break;
                 default:
                     break;
             }
             
             //Either force download the CSV or show the table
             $this->data['view_setup']['tables']['search_results'] = $retval;
             //print_array($retval);
             
            parent::report();
            
              $this->_load_view_data();
            $this->_generate_view($this->data);
            
             //print_array($this->data, 1);
        }
        
        public function search($post_process = NULL) {
            $this->load->model('search_model');
            $this->data['tables']['search_results']['table_headers'] = array();
            parent::search();
            
            if ($this->input->post('_::_submit'))
            {
                
            //print_array($this->input->post(), 1);
                //if ($this->input->post('_::_export') == 1) $export = TRUE;
                    //print_array( $this->data['tables']['search_results']['csv_file'] , 1, 'normal search results');
                if ($post_process === 'export')
                {
                    $this->load->helper('download');
                    //$csv = $this->data['tables']['search_results']['csv_file'];
                    $csv = $this->search_model->do_search(TRUE);
                    $name = "csv_export.csv";
                    //print_array( $this->data['tables']['search_results']['csv_file'] , 1);
                    force_download($name, $csv);
                    //return;
                }
                else $this->data['tables']['search_results'] = $this->search_model->do_search();
                
                $this->data['tables']['search_results']['post_data'] = $this->input->post();
            }
            //else
            {
            
            $this->_load_view_data();
            $this->_generate_view($this->data);
            }
            //Make sure we store the query somewhere ready to save as a saved search
            
        }
        
        public function search_orders() {
            //$this->output->enable_profiler();
            $this->load->model('order_model');
            $results = $this->order_model->get_orders_join();
            
            //now paginate and also give option to export as csv
            $this->load->library('pagination');

            $config['base_url'] = site_url('contact/search_orders');
            $config['total_rows'] = 200;
            $config['per_page'] = 20; 

            $this->pagination->initialize($config); 

            echo $this->pagination->create_links();
        }
        
        function search_new($table_name) {
            
            $this->output->enable_profiler();
            $retval = '';
            $export = FALSE;
            //Validate the input
            /*if ( ! in_array($table_name, $this->search_tables))
            {
                show_error ('Not allowed to search that table');
                return;
            }*/
            
            //Is export ticked? force download of file 
            if ($this->input->post('export')) $export = TRUE;
            
            switch ($table_name)
            {
                case 'order':
                    $this->load->model('order_model');
                    $retval = $this->order_model->get_orders_join($export);
            }
            
            
            
            //Set up pagination
            $this->load->library('pagination');

            $config['base_url'] = site_url('contact/search_new/' . $table_name);
            $config['total_rows'] = 200;
            $config['per_page'] = 20; 
            $config['uri_segment'] = 4; 

            
            //View the results
           print_array($retval);
        }
        
        function convert_dates($input, $format = 'd/m/Y') {
            $retval = FALSE;
            
            switch ($format)
            {
                case 'Y-m-d':
                    $retval = join('-',array_reverse(explode('/',$input)));
                    break;
                case 'Y-m-d h:i':
                    $retval = explode(' ', $input);
                    $etval = join('-',array_reverse(explode('/',$retval[0]))) . $retval[1];
                    break;
                case 'Y-m-d h:i:s':
                    $retval = join('-',array_reverse(explode('/',$input)));
                    break;
                
            }
            
        }
        function testing_dates() {
            $this->load->helper('date');
            
            $dates = array
                    (
                         'from_db' => array
                        (
                            'DATE' => '2012-05-25',
                            'DATETIME' => '2012-05-25 23:34:55',
                            'TIMESTAMP' => '2012-05-25 23:34:55',
                        ),
                        'from_form' => array
                        (
                            'DATE' => '25/05/1977',
                            'DATETIME' => '25/05/1977 23:02',
                            'TIMESTAMP' => '25/05/1977 23:02:12',
                        ),
                    );
           
            //convert to_DATE
            echo '<br/>this is converting 25/05/1977 to DATE for db: ',convert_DATE('25/05/1977');
            echo '<br/>this is converting from 1977-05-25 for form: ',convert_DATE('1977-05-25', 'from_DATE');
            
            
        }
        
         
    function read_word() {
        $this->load->helper('file');
        $filename = 'http://localhost:8888/projects/leadfarm_v1/public_html/assets/includes/fc_utd_changes_v1.docx';
        
        $content = $this->read_file_docx($filename);
        
        if ($content !== FALSE) echo nl2br($content);
        else echo "No!";
       
        
        return
        
        $string = read_file('includes/fc_utd_changes_v1.docx');
        //print $string;
        echo "hello - this is type; " . get_mime_by_extension('includes/fc_utd_changes_v1.docx');
    }
    
    public function unzip() {
        $this->load->library('unzip');
        $this->load->helper('file');
        $this->load->helper('xml');
        $this->load->helper('text');
        
        //$this->unzip->extract('assets/includes/fc_utd_changes_v1.docx');
        //$string1 = read_file('assets/includes/word/document.xml');
        $string2 = read_file('assets/includes/Martin_Gradwell_CV_2.5.doc');
        //$string = read_file('assets/includes/customXml/item1.xml');
        //$string = xml_convert($string);
        //$string1 = ascii_to_entities($string1);
        $string2 = ascii_to_entities($string2);
        
        //strip out punctation & make it all lowercase
        $remove = array ( "!", "@", "$", "%","^", "&", ":", ",", ".", "*", "(", ")",);
        $string2 = str_replace($remove,"",$string2);
        //$string2 = strtolower($string2);
        
        //first find the position of 
$re = '/# Match position between camelCase "words".
    (?<=[a-z])  # Position is after a lowercase,
    (?=[A-Z])   # and before an uppercase letter.
    /x';
//$string = preg_split($re, $string);
//$string = ascii_to_entities($string);
        $keywords = array(
            'CLINICAL INSTRUCTION', 'CI experience', 'sorry', 'walsh', 'Create New Contact', 'Curriculum Vitae','C', 'C++', 'C#', 'HTML', 'XML', 'Java', 'Javascript', 'COBOL', 'Delphi', 'Pascal','Visual Basic'
        );
        $count = array();
        
        //foreach ($keywords as $keyword)
        //{
       //     $count[$keyword] = substr_count(strtolower($string1), strtolower($keyword));
      //  }
        
       // print_array($count, 0, 'count of kw in string1');
        
        foreach ($keywords as $keyword)
        {
            $count[$keyword] = substr_count(strtolower($string2), strtolower($keyword));
        }
        
        echo "<h1>Contents of Word doc</h1>".$string2;
        print_array($count, 0, 'count of kw in string2');
        



        //echo "<h1>String1</h1>".$string1;
    }
    
    function read_file_docx($filename) {
        $striped_content = '';
        $content = '';
        die('fielname:' . $filename);
        if(!$filename ||!file_exists($filename)) return '397';
        
        
        $zip = zip_open($filename);
        if (!$zip || is_numeric($zip)) return '401';
        
        while ($zip_entry = zip_read($zip)) 
        { 
            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
            if (zip_entry_name($zip_entry) != "word/document.xml") continue;
            
            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            zip_entry_close($zip_entry);
        }// end while 
        zip_close($zip); 

        //echo $content; 
        //echo ""; 
        //file_put_contents('1.xml', $content);	 
        
        $content = str_replace('', " ", $content); 
        $content = str_replace('', "\r\n", $content); 
        $striped_content = strip_tags($content); return $striped_content; 
        
        return $striped_content;
        
    }
    
    
    }
}   