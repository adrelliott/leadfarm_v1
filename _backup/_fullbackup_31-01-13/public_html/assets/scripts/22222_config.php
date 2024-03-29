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
define('COUNTDOWN', 45);  //Notifies the user {45 days {VALUE} days before MOT/Service expires. see libraries/garages/garages.php

//
//
//
//$config['base_url']	= 'http://leadfarm-staging.co.uk/' . DATAOWNER_ID;


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

/* leadfarm-staging.co.uk db details 
$config['database']['username'] = 'leadfar_admin';
$config['database']['password'] = 'DMmanch35';
$config['database']['database'] = 'leadfar2_22222';
*/

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
        'vehicles' => Array	//do not change this value - this is what the directory should be called too
        (
            'pagename' => 'Vehicles',
            'controller' => 'vehicles',
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
                'master_search' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'contacts', //The dataset name defined in this file
                    'model_name' => 'contact_model',
                    'model_method' => 'master_search',
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            //'__Vehicles.__ActiveYN =' => 1, 
                        ),
                    'fields' => array 
                    (
                        'Contact.Id' => '#',
                        'Contact.FirstName' => 'First Name',
                        'Contact.LastName' => 'Last Name',
                        'Contact.PostalCode' => 'Postcode',
                        'Contact.Phone1' => 'Phone',
                        'Contact.Phone2' => 'Mobile',
                        'Contact._OrganisationName' => 'Company Name',
                        '__Vehicles.__Registration' => 'Registration',
                        '__Vehicles.__Model' => 'Model',
                        
                    ),
                ),   
                /*'contacts' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'contacts', //The dataset name defined in this file
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records',
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsOrganisationYN !=' => 1, 
                        ),
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'PostalCode' => 'Postcode',
                        '_IsOrganisationYN' => '',
                    ),
                ),            
                'organisations' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'contacts', //The dataset name defined in this file
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records',
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsOrganisationYN =' => 1, 
                        ), 
                    'fields' => array 
                    (
                        'Id' => '#',
                        '_OrganisationName' => 'Org Name',
                        'StreetAddress1' => 'Address',
                        'FirstName' => 'Contact',
                        'LastName' => '',
                        '_IsOrganisationYN' => '',
                        
                    ),
                ), 
                'actions' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => 'actions', //The dataset name defined in this file
                    'model_name' => 'contactaction_model',
                    'model_method' => 'get_all_records',
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => '#',
                        //'FirstName' => 'First Name',
                        //'LastName' => 'Last Name',
                        //'PostalCode' => 'Postcode',
                    ),
                ), */
                /*'tasks' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => 'actions', //The dataset name defined in this file
                    'model_name' => 'contactaction_model',
                    'model_method' => 'get_all_records',
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            'ActionType !=' => 'Booking', 
                        ), 
                    'fields' => array 
                    (
                        'Id' => '#',
                        //'FirstName' => 'First Name',
                        //'LastName' => 'Last Name',
                        //'PostalCode' => 'Postcode',
                    ),
                ),
                'bookings' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => 'actions', //The dataset name defined in this file
                    'model_name' => 'contactaction_model',
                    'model_method' => 'get_all_records',
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            'ActionType =' => 'Booking', 
                        ), 
                    'fields' => array 
                    (
                        'Id' => '#',
                        //'FirstName' => 'First Name',
                        //'LastName' => 'Last Name',
                        //'PostalCode' => 'Postcode',
                    ),
                ),
                'vehicles' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => 'vehicles', //The dataset name defined in this file
                    'model_name' => 'vehicles_model',
                    'model_method' => 'get_all_records',
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        '__Id' => '#',
                        '__Registration' => 'Reg',
                        '__Make' => 'Manufacturer',
                        '__Model' => 'Model',
                        //'LastName' => 'Last Name',
                        //'PostalCode' => 'Postcode',
                    ),
                ),*/
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
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'contacts', //The dataset name defined in this file
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsOrganisationYN !=' => 1, 
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
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'contacts', //The dataset name defined in this file
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records',
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsOrganisationYN =' => 1, 
                        ), 
                    'fields' => array 
                    (
                        'Id' => '#',
                        '_OrganisationName' => 'Org Name',
                        'StreetAddress1' => 'Address',
                        'FirstName' => 'Contact',
                        'LastName' => '',
                        '_IsOrganisationYN' => '',
                    ),
                ),            
            ),
            'view' => array 
            (
                'all_actions' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'all_actions', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            'ActionType !=' => 'Booking', 
                        ),     
                    'fields' => array 
                    (
                        'Id' => '#',
                        'ActionType' => 'Type',
                        'ActionDescription' => 'Description',
                    ),
                ),     
                'bookings' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'all_actions', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            //'ContactId =' => '??ContactId', 
                            'ActionType =' => 'Booking', 
                        ),                  
                    'fields' => array 
                    (
                        'Id' => '#',
                        'ActionType' => 'Type',
                        'ActionDescription' => 'Description',
                    ),
                ),     
                'vehicles' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'vehicles', //The dataset name defined above
                    'model_name' => 'vehicles_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '__ActiveYN !=' => 0, 
                        ),                      
                    'fields' => array 
                    (
                        '__Id' => '#',
                        '__ContactId' => 'Contact Id of vehicle owner',
                        '__Make' => 'Make',
                        '__Model' => 'model',
                        '__Registration' => 'Reg',
                        '__MOT_expiry' => 'MOT Exp',
                        '__Service_expiry' => 'Service Exp',
                        '__ActiveYN' => 'Active?',
                    ),
                ),     
                /*'communications' => array
                (
    // this needs to be turned to TRUE!!! )(create table & model first though)                
                    'include_in_query' => FALSE, //TRUE or FALSE,
                    'data_source' => 'comminications', //The dataset name defined above
                    'model_name' => 'communications_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => NULL,      
                    'fields' => array 
                    (
                        'Id' => '#',
                    ),
                ),   */  
                'relationships' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'relationships', //The dataset name defined above
                    'model_name' => 'contactjoin_model',
                    'model_method' => 'joinon_ContactJoin', 
                    'model_params' => NULL, 
                    'fields' => array 
                    (
                        'Contact.Id' => 'contact Id',
                        'Contact.FirstName' => 'First Name',
                        'Contact.LastName' => 'Last Name',
                        '__ContactJoin.__Id' => 'Realtionship Id',
                        '__ContactJoin.__Reason' => 'reason',
                        //'__ContactJoin.__ContactId' => 'reason',
                        '__ContactJoin.__ContactId2' => 'CId 2',
                    ),
                ),
                'users' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'users', //The dataset name defined above
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsCrmUserYN =' => 1, 
                        ),
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'Username' => 'Username',
                        'Password' => 'Password',
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
                'dropdowns' => array    //or NULL
                (
                    'users' => array
                    (
                        'source' => 'users',    //which dataset are we using?
                        'label' => array ('FirstName', 'LastName'),
                        'label_separator' => ' ',
                        'value' => 'Id',
                    ),
                    'vehicles' => array
                    (
                        'source' => 'vehicles',    //which dataset are we using?
                        'label' => array ('__Make', '__Model', '__Registration'),
                        'label_separator' => ' ',
                        'value' => '__Id',
                    ),
                ),
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
                    '_IsOrganisationYN' => array        //DO **NOT** REMOVE OR EDIT THIS FIELD!!!!!!
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
                        'name' => '_IsOrganisationYN',
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
                    '__AdverseCreditYN' => array        //DO **NOT** REMOVE OR EDIT THIS FIELD!!!!!!
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Adverse Credit?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => 'title="tooltip" rel="Defaults to Individual',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__AdverseCreditYN',
                        'helpText' => '',
                        'options' => array
                         (
                             'Yes' => '0',    //label => value
                             'No' => '1',
                         ),
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                     '_OrganisationName' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Organisation Name',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '_OrganisationName',
                        'helpText' => '',
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
                        'cssClassInput' => 'large',
                        'cssIdInput' => 'FirstName',
                        'extraHTMLInput' => '',//' onpropertychange="updatenickname(event)" oninput="OnInput(event)" ',  //eg. title="tooltip" rel="tooltips"
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
                        'cssClassInput' => 'large',
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
                      'Nickname' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Nickname',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'large grey-highlight',
                        'cssIdInput' => 'NickName',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Nickname',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'Email' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Email',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Email',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      '_Gender' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Gender',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_Gender',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                        (
                            'Male' => 'Male',    //label => value
                            'Female' => 'Female',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'StreetAddress1' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Address 1',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'StreetAddress1',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'StreetAddress2' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Address 2',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'StreetAddress2',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'City' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'City',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'City',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'State' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'County',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => 'State',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'State',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'Country' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Country',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'medium',
                        'cssIdInput' => 'Country',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Country',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'PostalCode' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Postcode',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'PostalCode',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'Phone1' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Landline',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => 'LastName',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Phone1',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'Phone2' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Mobile',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Phone2',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'Phone3' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Work Number',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Phone3',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'Leadsource' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Where did you hear of us?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => 'Leadsource',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                          (
                            '' => '',
                            'Newpaper Ad' => 'Newpaper Ad',   //'label' => 'value'
                            'Internet Search' => 'Internet Search',
                            'Radio Advert' => 'Radio Advert',
                            'Referral' => 'Referral',
                            'Live nearby' => 'Live nearby'
                          ),
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      '_FacebookUrl' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Facebook Name',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '_FacebookUrl',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      '_TwitterName' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Twitter Handle',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '_TwitterName',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'ContactNotes' => array
                    (
                        'on' => TRUE,    //TRUE or FALSE includes/excludes from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => '',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxxxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => 'rows="20" readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => 'ContactNotes',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '',       
                    ),
                      '_OptinEmailYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into Emails?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_OptinEmailYN',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                          (
                            'Yes' => 1,
                            'No' => 0,
                          ),
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                     '_OptinSmsYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into SMS texts?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_OptinSmsYN',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                          (
                            'Yes' => 1,
                            'No' => 0,
                          ),
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                     '_OptinSurfaceMailYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into Surface Mail?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_OptinSurfaceMailYN',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                          (
                            'Yes' => 1,
                            'No' => 0,
                          ),
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                     '_OptinNewsletterYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into Newsletter?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_OptinNewsletterYN',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                          (
                            'Yes' => 1,
                            'No' => 0,
                          ),
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                     '_OptinPref' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Preferred method:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_OptinPref',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                          (
                            'Email' => 'Email',
                            'Post' => 'Post',
                            'SMS' => 'SMS'
                          ),
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                ),                
            ),
        ),
    );

$config['booking'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                'bookings_join' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'bookings_join', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'joinon_Contact_and_Vehicle', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'Contact.Id' => 'contact Id',
                        'Contact.FirstName' => 'First Name',
                        'Contact.LastName' => 'Last Name',
                        'ContactAction.Id' => 'booking Id',
                        'ContactAction.ActionDescription' => 'ActionDescription',
                        '__Vehicles.__Registration' => 'Reg',
                    ),
                ), 
            ),
            'view' => array 
            (                
                'vehicles' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'vehicles', //The dataset name defined above
                    'model_name' => 'vehicles_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '__ActiveYN !=' => 0, 
                        ),                      
                    'fields' => array 
                    (
                        '__Id' => '#',
                        '__ContactId' => 'Contact Id of vehicle owner',
                        '__Make' => 'Make',
                        '__Model' => 'model',
                        '__Registration' => 'Reg',
                        '__MOT_expiry' => 'MOT Exp',
                        '__Service_expiry' => 'Service Exp',
                        '__ActiveYN' => 'Active?',
                    ),
                ),   
                'users' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'users', //The dataset name defined above
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsCrmUserYN =' => 1, 
                        ),
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'Username' => 'Username',
                        //'Password' => 'Password',
                    ),
                ),
                'bookings_join' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'bookings_join', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'joinon_Contact', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'Contact.Id' => 'contact Id',
                        'Contact.FirstName' => 'First Name',
                        'Contact.LastName' => 'Last Name',
                        'ContactAction.Id' => 'booking Id',
                        'ContactAction.ActionDescription' => 'ActionDescription',
                    ),
                ), 
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'contactaction_model',
                'model_method' => 'joinon_Contact_and_Vehicle_singlerecord',
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
                    'ActionType' => array      
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
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'ActionType',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'ActionDescription' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'ActionDescription',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'ActionDescription',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'CreationDate' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Date created',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'date',
                        'name' => 'CreationDate',
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

$config['contactaction'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                /*'bookings_join' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'bookings_join', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'joinon_Contact_and_Vehicle', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'Contact.Id' => 'contact Id',
                        'Contact.FirstName' => 'First Name',
                        'Contact.LastName' => 'Last Name',
                        'ContactAction.Id' => 'booking Id',
                        'ContactAction.ActionDescription' => 'ActionDescription',
                        '__Vehicles.__Registration' => 'Reg',
                    ),
                ),*/ 
            ),
            'view' => array 
            (                
                'vehicles' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'vehicles', //The dataset name defined above
                    'model_name' => 'vehicles_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '__ActiveYN !=' => 0, 
                        ),                      
                    'fields' => array 
                    (
                        '__Id' => '#',
                        '__ContactId' => 'Contact Id of vehicle owner',
                        '__Make' => 'Make',
                        '__Model' => 'model',
                        '__Registration' => 'Reg',
                        '__MOT_expiry' => 'MOT Exp',
                        '__Service_expiry' => 'Service Exp',
                        '__ActiveYN' => 'Active?',
                    ),
                ),   
                'users' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'users', //The dataset name defined above
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsCrmUserYN =' => 1, 
                        ),
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'Username' => 'Username',
                        //'Password' => 'Password',
                    ),
                ),
                /*'tasks_join' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'bookings_join', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'joinon_Contact', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'Contact.Id' => 'contact Id',
                        'Contact.FirstName' => 'First Name',
                        'Contact.LastName' => 'Last Name',
                        'ContactAction.Id' => 'booking Id',
                        'ContactAction.ActionDescription' => 'ActionDescription',
                    ),
                ), */
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'contactaction_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL,
                'dropdowns' => array    //or NULL
                (
                    'users' => array
                    (
                        'source' => 'users',    //which dataset are we using?
                        'label' => array ('FirstName', 'LastName'),
                        'label_separator' => ' ',
                        'value' => 'Id',
                    ),
                    'vehicles' => array
                    (
                        'source' => 'vehicles',    //which dataset are we using?
                        'label' => array ('__Make', '__Model', '__Registration'),
                        'label_separator' => ' ',
                        'value' => '__Id',
                    ),
                ),
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
                    'ActionType' => array      
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
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => 'ActionType',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Enquiry' => 'Enquiry',
                            'Task' => 'Task',
                            'Meeting' => 'Meeting',
                            'Phone Call' => 'Phone Call',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'ActionDescription' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'ActionDescription',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'ActionDescription',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                         (
                            // 
                         ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'CreationNotes' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Notes',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => 'CreationNotes',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'CreationDate' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Date created',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'timestamp',
                        'name' => 'CreationDate',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array  //what hours do we want to show in dropdown? 
                        (
                            //'01' => '01',
                            //'02' => '02',
                            //'03' => '03',
                            //'04' => '04',
                           // '05' => '05',
                            //'06' => '06',
                            //'07' => '07',
                            '08' => '08',
                            '09' => '09',
                            '10' => '10',
                            '11' => '11',
                            '12' => '12',
                            '13' => '13',
                            '14' => '14',
                            '15' => '15',
                            '16' => '16',
                            '17' => '17',
                            '18' => '18',
                            //'19' => '19',
                            //'20' => '20',
                            //'21' => '21',
                            //'22' => '22',
                            //'23' => '23',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    /*'CreationDate_date' => array       
                    (
                        'on' => FALSE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Date created',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'date',
                        'name' => '&&CreationDate_date',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'CreationDate_hours' => array       
                    (
                        'on' => FALSE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Date created',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'time',
                        'name' => '&&CreationDate_hours',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ), 
                    'CreationDate_mins' => array       
                    (
                        'on' => FALSE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Date created',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'time',
                        'name' => '&&CreationDate_mins',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),   */                 
                    'ContactId' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'ContactId',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'ContactId',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'ActionDate' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Completion Date',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'datepicker',
                        'cssIdInput' => 'datepicker',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'ActionDate',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'UserID' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Person Responsible',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => 'ActionDate',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            //This is overidden. Its the dropdown 'users'
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_CompletedYN' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Is this Completed?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_CompletedYN',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Yes' => 1,
                            'No' => 0
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                ),
            ),
        ),
    );

$config['contactjoin'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                /*'bookings_join' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'bookings_join', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'joinon_Contact_and_Vehicle', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'Contact.Id' => 'contact Id',
                        'Contact.FirstName' => 'First Name',
                        'Contact.LastName' => 'Last Name',
                        'ContactAction.Id' => 'booking Id',
                        'ContactAction.ActionDescription' => 'ActionDescription',
                        '__Vehicles.__Registration' => 'Reg',
                    ),
                ),*/ 
            ),
            'view' => array 
            (  
                'contacts' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'contacts', //The dataset name defined in this file
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records',
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            //'_IsOrganisationYN !=' => 1, 
                        ),
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'PostalCode' => 'Postcode',
                        '_IsOrganisationYN' => '',
                    ),
                ),            
                'relationships' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'relationships', //The dataset name defined above
                    'model_name' => 'contactjoin_model',
                    'model_method' => 'joinon_ContactJoin', 
                    'model_params' => NULL, 
                    'fields' => array 
                    (
                        'Contact.Id' => 'contact Id',
                        'Contact.FirstName' => 'First Name',
                        'Contact.LastName' => 'Last Name',
                        '__ContactJoin.__Id' => 'Realtionship Id',
                        '__ContactJoin.__Reason' => 'reason',
                        //'__ContactJoin.__ContactId' => 'reason',
                        '__ContactJoin.__ContactId2' => 'CId 2',
                    ),
                ),
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'contactjoin_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL, 
                'dropdowns' => NULL,
                'fields' => array 
                (
                    '__Id' => array
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
                        'name' => '__Id',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__ContactId' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Id 1',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__ContactId',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__ContactId2' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Id 2',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__ContactId2',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Reason' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Reason for Realtionship',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '__Reason',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                         (
                            'Spouse' => 'Spouse',
                            'Partner' => 'Partner',
                            'Employee' => 'Employee',
                            'Colleague' => 'Colleague',
                            'Business Partner'=> 'Business Partner',
                            'Friend' => 'Friend',    //label => value
                            'Sibling' => 'Sibling',
                            'Neighbour' => 'Neighbour', 
                         ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                    
                    '__ActiveYN' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Relationship Active?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__ActiveYN',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                         (
                             'Active' => '1',    //label => value
                             'Inactive' => '0',
                         ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                    
                ),                
            ),
        ),
    );

$config['vehicles'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                'vehicles' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'vehicles', //The dataset name defined above
                    'model_name' => 'vehicles_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            //'_IsOrganisationYN !=' => 1, 
                        ),    
                    'fields' => array 
                    (
                        '__Id' => '#',
                        '__ContactId' => 'Contact Id of vehicle owner',
                        '__Make' => 'Make',
                        '__Model' => 'model',
                        '__Registration' => 'Reg',
                        '__MOT_expiry' => 'MOT Expires',
                        '__Service_expiry' => 'Service Expires',
                    ),
                ), 
            ),
            'view' => array 
            (                
                'vehicles' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'vehicles', //The dataset name defined above
                    'model_name' => 'vehicles_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => NULL,        
                    'fields' => array 
                    (
                        '__Id' => '#',
                        '__ContactId' => 'Contact Id of vehicle owner',
                        '__Make' => 'Make',
                        '__Model' => 'model',
                        '__Registration' => 'Reg',
                        '__MOT_expiry' => 'MOT Expires',
                        '__Service_expiry' => 'Service Expires',
                    ),
                ), 
                'users' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'users', //The dataset name defined above
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsCrmUserYN =' => 1, 
                        ),
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'Username' => 'Username',
                        //'Password' => 'Password',
                    ),
                ),
                /*'tasks_join' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'bookings_join', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'joinon_Contact', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'Contact.Id' => 'contact Id',
                        'Contact.FirstName' => 'First Name',
                        'Contact.LastName' => 'Last Name',
                        'ContactAction.Id' => 'booking Id',
                        'ContactAction.ActionDescription' => 'ActionDescription',
                    ),
                ), */
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'vehicles_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL,
                'dropdowns' => array    //or NULL
                (
                    'users' => array
                    (
                        'source' => 'users',    //which dataset are we using?
                        'label' => array ('FirstName', 'LastName'),
                        'label_separator' => ' ',
                        'value' => 'Id',
                    ),
                    'vehicles' => array
                    (
                        'source' => 'vehicles',    //which dataset are we using?
                        'label' => array ('__Make', '__Model', '__Registration'),
                        'label_separator' => ' ',
                        'value' => '__Id',
                    ),
                ),
                'fields' => array 
                (
                    '__Id' => array
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
                        'name' => '__Id',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__ContactId' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Contact ID',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__ContactId',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Task' => 'Task',
                            'Meeting' => 'Meeting',
                            'Phone Call' => 'Phone Call',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Registration' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Registration',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Registration',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Task' => 'Task',
                            'Meeting' => 'Meeting',
                            'Phone Call' => 'Phone Call',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__ActiveYN' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Active?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__ActiveYN',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Yes' => 1,
                            'No' => 0
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Make' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Manufacturer',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '__Make',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            '' => '',
                            'Audi' => 'Audi',
                            'BMW' => 'BMW',
                            'Chevrolet' => 'Chevrolet',
                            'Datsun' => 'Datsun',
                            'Ford' => 'Ford',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Model' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Manufacturer',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Model',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            '' => '',
                            'Audi' => 'Audi',
                            'BMW' => 'BMW',
                            'Chevrolet' => 'Chevrolet',
                            'Datsun' => 'Datsun',
                            'Ford' => 'Ford',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__MOT_expiry' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'MOT Due:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'datepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__MOT_expiry',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            '' => '',
                            'Audi' => 'Audi',
                            'BMW' => 'BMW',
                            'Chevrolet' => 'Chevrolet',
                            'Datsun' => 'Datsun',
                            'Ford' => 'Ford',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Service_expiry' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Service Due:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'datepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Service_expiry',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            '' => '',
                            'Audi' => 'Audi',
                            'BMW' => 'BMW',
                            'Chevrolet' => 'Chevrolet',
                            'Datsun' => 'Datsun',
                            'Ford' => 'Ford',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Date_of_healthcheck' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Healthcheck Date:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'datepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Date_of_healthcheck',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Mileage' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Service Due:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'datepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Mileage',
                        'helpText' => '',                        
                        'length' => '',                        
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Tyre_osf' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Tyres - O/S/F',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '__Tyre_osf',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            '' => '',
                            '12mm' => '12',
                            '11mm' => '11',
                            '10mm' => '10',
                            '9mm' => '9',
                            '8mm' => '8',
                            '7mm' => '7',
                            '6mm' => '6',
                            '5mm' => '5',
                            '4mm' => '4',
                            '3mm' => '3',
                            '2mm' => '2',
                            '1mm' => '1',
                            '0mm' => '0',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Tyre_nsf' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Tyres - N/S/F',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '__Tyre_nsf',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            '' => '',
                            '12mm' => '12',
                            '11mm' => '11',
                            '10mm' => '10',
                            '9mm' => '9',
                            '8mm' => '8',
                            '7mm' => '7',
                            '6mm' => '6',
                            '5mm' => '5',
                            '4mm' => '4',
                            '3mm' => '3',
                            '2mm' => '2',
                            '1mm' => '1',
                            '0mm' => '0',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Tyre_osr' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Tyres - O/S/R',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '__Tyre_osr',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            '' => '',
                            '12mm' => '12',
                            '11mm' => '11',
                            '10mm' => '10',
                            '9mm' => '9',
                            '8mm' => '8',
                            '7mm' => '7',
                            '6mm' => '6',
                            '5mm' => '5',
                            '4mm' => '4',
                            '3mm' => '3',
                            '2mm' => '2',
                            '1mm' => '1',
                            '0mm' => '0',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Tyre_nsr' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Tyres - N/S/R',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '__Tyre_nsr',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            '' => '',
                            '12mm' => '12',
                            '11mm' => '11',
                            '10mm' => '10',
                            '9mm' => '9',
                            '8mm' => '8',
                            '7mm' => '7',
                            '6mm' => '6',
                            '5mm' => '5',
                            '4mm' => '4',
                            '3mm' => '3',
                            '2mm' => '2',
                            '1mm' => '1',
                            '0mm' => '0',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Tyre_pressure_osf' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => '',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'text',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Tyre_pressure_osf',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Tyre_pressure_nsf' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => '',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'text',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Tyre_pressure_nsf',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Tyre_pressure_osr' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => '',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'text',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Tyre_pressure_osr',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Tyre_pressure_nsr' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => '',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'text',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Tyre_pressure_nsr',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Tyre_notes' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Notes for Tyres:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'textarea xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '__Tyre_notes',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_lights' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Lights',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_lights',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_horn_wipers_washers' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Horn/wipers/washers',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_horn_wipers_washers',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_aircon' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Aircon',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_aircon',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Electric_notes' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Notes for Electrics:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'textarea xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '__Electric_notes',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_brakes' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Brakes (Noise & Feel)',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_brakes',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_clutch' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Clutch/Transmission',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_clutch',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_engine_noise' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Engine Noise & Smoke',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_engine_noise',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_glass' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Glass/mirros/wiper blades',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_glass',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_seat_belts' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Seat belts',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_seat_belts',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Internal_notes' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Notes:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'textarea xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '__Internal_notes',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_fluid_levels' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Oil/Water/Coolant/Scr Wash',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_fluid_levels',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_fluid_leaks' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Oil/Water Leaks',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_fluid_leaks',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_battery' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Battery levels',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_battery',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_drive_belts' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Drive Belts',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_drive_belts',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Bonnet_notes' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Notes:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'textarea xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '__Bonnet_notes',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_brake_fluid' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Brake Fluid Condition/Temp',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_brake_fluid',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_master_cylinder' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Master Cylinder/Servo',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_master_cylinder',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_linings' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Linings - Pads/shoes',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_linings',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_disc_drums' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Discs/Drums',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_disc_drums',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_hoses' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Hoses/Pipes/Cables/Wheel Bearings',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_hoses',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Brakes_notes' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Notes:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'textarea xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '__Brakes_notes',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_exhaust' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Exhaust/Catalyst',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_exhaust',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_steering' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Steering/Suspension',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_steering',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_drive_shafts' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Driveshafts/Gaiters',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_drive_shafts',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Check_oil' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Oil leaks',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__Check_oil',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Green' => '0',
                            'Amber' => '1',
                            'Red' => '2',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Underside_notes' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Notes:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'textarea xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '__Underside_notes',
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

