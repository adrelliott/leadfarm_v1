<?php

/*
|--------------------------------------------------------------------------
| Define constants
|--------------------------------------------------------------------------
|
| To ensure a customer's logo appears in the top left, create the logo at 
| 100px x 600px, transparent background, and call it 'logo.png' (must be png, and all lowercase)
| and upload to /assets/includes/custom/XXXXX where 'XXXXX' is dID. (must be called logo.png)
*/
define('OPT_IN_REASON', "This is my opt in reason");  //Added to Infusionsoft
//$config['base_url']	= 'http://localhost/projects/_leadfarm/leadfarm_v2.0/' . DATAOWNER_ID;


/*
|--------------------------------------------------------------------------
| Define a logo
|--------------------------------------------------------------------------
|
| To ensure a customer's logo appears in the top left, create the logo at 
| 100px x 600px, transparent background, and call it 'logo.png' (must be png, and all lowercase)
| and upload to /assets/includes/custom/XXXXX where 'XXXXX' is dID. 
 * 
 * If there is no logo, then default it to:
 * define('PATH_TO_LOGO', '/assets/includes/default/logo.png');
*/
//define('PATH_TO_LOGO', 'assets/includes/custom/' . DATAOWNER_ID . '/logo.png');
define('PATH_TO_LOGO', 'assets/includes/default/logo.png');
/*
|--------------------------------------------------------------------------
| Define the connection details for the database
|--------------------------------------------------------------------------
|
| 
*/
$config['database']['hostname'] = 'localhost';
$config['database']['username'] = 'leadfarm_22222';
$config['database']['password'] = 'DMmanch35';
$config['database']['database'] = '22222_leadfarm_data';
$config['database']['dbdriver'] = 'mysql';
$config['database']['dbprefix'] = '';
$config['database']['pconnect'] = TRUE;
$config['database']['db_debug'] = TRUE;
$config['database']['cache_on'] = FALSE;
$config['database']['cachedir'] = '';
$config['database']['char_set'] = 'utf8';
$config['database']['dbcollat'] = 'utf8_general_ci';
$config['database']['swap_pre'] = '';
$config['database']['autoinit'] = TRUE;
$config['database']['stricton'] = FALSE;



/*
|--------------------------------------------------------------------------
| Nav Bar items
|--------------------------------------------------------------------------
|
| Select which nav bar items will go here
|
*/
$config['navbar_setup'] = Array
    (
        
        'index' => Array	
        (
            'pagename' => 'Dashboard',
            'controller' => 'dashboard',
            'method' => '',
            'param' => '',
            'icon'	=> '<img src="' . base_url() . 'assets/images/header/icon_dashboard.png" /> ',
            'css'	=> ' iconed',
            'view' => '',						
        ),
        'contact' => Array	//do not change this value - this is what the directory should be called too
        (
            'pagename' => 'Contacts',
            'controller' => 'contact',
            'method' => '',
            'param' => '',
            'icon'	=> '',
            'css'	=> '',
            'view' => '@viewtable',			
        ),
        'booking' => Array	//do not change this value - this is what the directory should be called too
        (
            'pagename' => 'Bookings',
            'controller' => 'booking',
            'method' => '',
            'param' => '',
            'icon'	=> '',
            'css'	=> '',	
            'view' => '@viewtable',				
         ), 
        'campaign' => Array	//do not change this value - this is what the directory should be called too
        (
            'pagename' => 'Campaigns',
            'controller' => 'campaign',
            'method' => '',
            'param' => '',
            'icon'	=> '',
            'css'	=> '',	
            'view' => '@viewtable',				
        ),
        'report' => Array	//do not change this value - this is what the directory should be called too
        (
            'pagename' => 'Reports',
            'controller' => 'report',
            'method' => '',
            'param' => '',
            'icon'	=> '',
            'css'	=> '',	
            'view' => '@viewtable',				
         ),
    
        //ADDING MORE PAGES? Read this...
            //You can add pages here, but you MUST follow the structure above,
    );


/*
|--------------------------------------------------------------------------
| Fields for Dashboard Controller
|--------------------------------------------------------------------------
|
| set up like this:
 * $config['dashboard'] = array
    (
    'datasets' => array 
    (
        '{method_name}' => array 
        (
            '{table_name}' => array
 
        )
    )
|
*/
$config['dashboard'] = Array
    (
        'datasets' => array 
        (
            'index' => array 
            (
                'contacts' => array
                (
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records',
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsOrganisation !=' => 1, 
                        ),
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'PostalCode' => 'Postcode',
                    ),
                ),            
                'organisations' => array
                (
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records',
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsOrganisation =' => 1, 
                        ), 
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'PostalCode' => 'Postcode',
                    ),
                ), 
                'actions' => array
                (
                    'model_name' => 'contactaction_model',
                    'model_method' => 'get_all__records',
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => '#',
                        //'FirstName' => 'First Name',
                        //'LastName' => 'Last Name',
                        //'PostalCode' => 'Postcode',
                    ),
                ),
            ),
        ),
        'record' => array
        (
                'index' => '',  //leave blank if no requirement
                'view' => '',   //leave blank if no requirement
        ),
    );

/*
|--------------------------------------------------------------------------
| Fields for Contact Controller
|--------------------------------------------------------------------------
|
| set up like this:
 * $config['dashboard'] = array
    (
    'datasets' => array 
    (
        '{method_name}' => array 
        (
            '{table_name}' => array
 
        )
    )
|
*/
$config['contact'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                'contacts' => array
                (
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsOrganisation !=' => 1, 
                        ),
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'PostalCode' => 'Postcode',
                    ),
                ),            
                'organisations' => array
                (
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records',
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsOrganisation =' => 1, 
                        ), 
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'PostalCode' => 'Postcode',
                    ),
                ),            
            ),
            'view' => array 
            (
                'actions' => array
                (
                    'model_name' => 'contactaction_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => NULL,                   
                    'fields' => array 
                    (
                        'Id' => '#',
                        'ActionType' => 'Type',
                        'ActionDescription' => 'Description',
                    ),
                ),     
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'contact_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL,                         
                'fields' => array 
                (
                    'Id' => array
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Id',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Id',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_IsOrganisation' => array        //DO **NOT** REMOVE OR EDIT THIS FIELD!!!!!!
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Record Type',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => 'title="tooltip" rel="Defaults to Individual',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_IsOrganisation',
                        'helpText' => '',
                        'options' => array
                         (
                             'Individual' => '0',    //label => value
                             'Organisation' => '1',
                         ),
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                      'Title' => array
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Title',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => 'Title',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                        (
                            '' => '',    //label => value
                            'Mr' => 'Mr',
                            'Mrs' => 'Mrs',
                            'Miss' => 'Miss',
                            'Ms' => 'Ms',
                            'Lord' => 'Lord',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                      'FirstName' => array
                    (
                        'on' => TRUE,        //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'First Name',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => 'FirstName',
                        'extraHTMLInput' => ' onpropertychange="updatenickname(event)" oninput="OnInput(event)" ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'FirstName',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '', 
                        'value' => '', 
                    ),
                      'LastName' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Last Name',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => 'LastName',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'LastName',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                ),                
            ),
        ),
    );



/* End of file */

