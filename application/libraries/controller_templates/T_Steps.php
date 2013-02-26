<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class T_Steps extends MY_Controller { 

    public $controller_name = 'steps';
    
    public function __construct()    {
         parent::__construct($this->controller_name);
    }
    
    public function index($view_file) {
       redirect(DATAOWNER_ID . '/campaign' );    
    }
   
    public function add($view_file, $controller, $rID) {       
        //clean input
        $input = clean_data($this->input->post());
        
        // print_array($input,0, 'pre work');
        
        //Collate input fields by record 
        $retval = array();
        foreach ($input as $k => $v)
        {
            //first explode by '_'
            $elements = explode('_', $k);
            $retval[$elements[1]]['__'.$elements[0]] = $v; 
            $retval[$elements[1]]['__StepNo'] = $elements[1];
        }
        //print_array($retval, 0, 'here is raw array');
        
        foreach ($retval as $step => $attr)
        {
            
            if ($attr['__StepName'])
            {
                //default delay to 1 second if not set
                if(!$attr['__Delay']) $attr['__Delay'] = 1; 
                $attr['__CampaignId'] = $rID;
                
                //Set up the action
                $elements['explosion1'] = explode('] ', $attr['__StepName']);
                $elements['explosion2'] = explode(' ',substr($elements['explosion1'][0], 1)); 
                $attr['__ActionType'] = $elements['explosion2'][0];
               
                if ( $attr['__ActionType'] != 'TAG')
                {
                    $attr['__TemplateId'] = $elements['explosion2'][1];
                }
                
                
                $retval[$step] = $attr; //add our chnages back into the array
            }
            else unset($retval[$step]);
            
        }
        
        //save record(s)
        foreach ($retval as $record => $input)
        {
            $id = $this->add_record($input, $input['__Id']);
        }

        $url = site_url (DATAOWNER_ID . '/' . $controller . '/view/' . $view_file . '/' . $rID);

        if ($this->input->is_ajax_request ()) {
            $response = array (
                'success' => true,
            );

            $this->output->set_content_type('application/json');
            $this->output->set_output(json_encode($response));
            return;
        }

        //refresh page
        redirect($url);
    }
    
    
   
}
   