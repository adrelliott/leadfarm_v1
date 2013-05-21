<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* FC Utd */

/*
|--------------------------------------------------------------------------
| Define settings for this client
|--------------------------------------------------------------------------
|
| We define all settings for each client's app here.
| 
| Also look in:
| - 22222_database.php
| - global_database.php
| - config.php
| 
|  ****NOTE****: the environment is set in index.php
*/

/*
|--------------------------------------------------------------------------
| Define constants
|--------------------------------------------------------------------------
|
| To ensure a customer's logo appears in the top left, create the logo at 
| 100px x 600px, transparent background, and call it 'logo.png' (must be png, and all lowercase)
| and upload to /assets/includes/custom/XXXXX where 'XXXXX' is dID. (must be called logo.png)
*/
define('OPT_IN_REASON', "This is my opt in reason");  
define('UNSUBSCRIBE_LINK', base_url( 'gen/comms/unsubs/' . DATAOWNER_ID . '/_:_ContactId_:_'));
define('UNSUBSCRIBE', '<br/><br/><small><a href="' . UNSUBSCRIBE_LINK . '">Unsubscribe from all future emails here</a></small>');

define('ADMIN_LEVEL_ADMINISTRATOR', 5);  //set Contact->_AdminLevel to alow superior access
define('ADMIN_LEVEL_SUPERVISOR', 4);  //set Contact->_AdminLevel to alow superior access
define('ADMIN_LEVEL_USER', 3);  //set Contact->_AdminLevel to alow superior access

/*
|--------------------------------------------------------------------------
| Define a logo
|--------------------------------------------------------------------------
|
| To ensure a customer's logo appears in the top left, create the logo at 
| 100px x 600px, transparent background, and call it 'logo.png' (must be png, and all lowercase)
| and upload to /assets/includes/logos/XXXXX where 'XXXXX' is dID.  
*/

define('PATH_TO_LOGO', 'assets/includes/logos/' . DATAOWNER_ID . '/logo.png');
/*


|--------------------------------------------------------------------------
| Define the connection details for the database
|--------------------------------------------------------------------------
|   NOTE: Each dataowner has thier own database
|   Firstly, get the username and password for *this* user's database...
|   Then get the general config details for the database from global_database.php
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
            'pagename' => 'Fans & Orgs',
            'controller' => 'contact',
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
        /*'report' => Array	//do not change this value - this is what the directory should be called too
        (
            'pagename' => 'Reports',
            'controller' => 'report',
            'method' => '',
            'param' => '',
            'icon'	=> '',
            'css'	=> '',	
            'view' => '@viewtable',				
         ),*/
    
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
                            //'__vehicles.__ActiveYN =' => 1, 
                        ),
                    'fields' => array 
                    (
                        'contact.Id' => '#',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contact.Nickname' => 'Known As',
                        'contact.PostalCode' => 'Postcode',
                        'contact.Email' => 'Prim Email',
                        'contact.Phone1' => 'Landline',
                        'contact.Phone2' => 'Mobile',
                        'contact.PostalCode' => 'Postcode',
                        'contact._OrganisationName' => 'Company Name',
                        'contact._LegacyMembershipNo' => 'Memb No',
                        
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
                        'FirstName' => 'contact',
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
                'campaigns' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => 'campaigns', //The dataset name defined in this file
                    'model_name' => 'campaign_model',
                    'model_method' => 'get_all_records',
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => '#',
                        'Name' => 'Campaign Name',
                        '_Type' => 'Type',
                    ),
                ),
                'reports' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => 'reports', //The dataset name defined in this file
                    'model_name' => 'report_model',
                    'model_method' => 'get_all_records',
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => '#',
                        'Name' => 'Report Name',
                        'Type' => 'Type',
                    ),
                ),
            ),
        ),
        'record' => array
        (
                'index' => '',  //leave blank if no requirement
                'view' => '',   //leave blank if no requirement
        ),
        'stats' => array
        (
             'index' => array
            (
                'count_all_records' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => '', //The dataset name defined in this file
                    'stat_type' => 'count', //count, average, etc
                    'model_name' => 'contact_model',
                    'model_method' => 'count_all_results',
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => '#',
                    ),
                ),
                /*'count_all_adult_records' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => '', //The dataset name defined in this file
                    'stat_type' => 'count', //count, average, etc
                    'model_name' => 'contact_model',
                    'model_method' => 'count_all_results',
                    'model_params' => array
                    (
                        'Birthday >=' => date('Y-m-d', date('Y') - 16 ),
                        '_LegacyMembershipNo > ' => 0,
                     ),
                    'fields' => array 
                    (
                        'Id' => '#',
                    ),
                ),*/
                'count_all_adult_membership_records' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => '', //The dataset name defined in this file
                    'stat_type' => 'count_FC_season', //count, average, etc
                    'model_name' => 'order_model',
                    'model_method' => 'count_all_results',
                    'model_params' => array
                    (
                        //'_ValidUntil' => date('Y') . '/' . (date('y') + 1),
                        //'_ValidUntil' => if(date('n') <= 6) date('Y'),
                        '_ItemBought' => 'Adult Membership',
                     ),
                    'fields' => array 
                    (
                        'Id' => '#',
                    ),
                ),
                'count_all_junior_membership_records' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => '', //The dataset name defined in this file
                    'stat_type' => 'count_FC_season', //count, average, etc
                    'model_name' => 'order_model',
                    'model_method' => 'count_all_results',
                    'model_params' => array
                    (
                        //'_ValidUntil' => date('Y') . '/' . (date('y') + 1),
                        //'_ValidUntil' => if(date('n') <= 6) date('Y'),
                        '_ItemBought' => 'Junior Membership',
                     ),
                    'fields' => array 
                    (
                        'Id' => '#',
                    ),
                ),
                'count_all_adult_seasonticket_records' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => '', //The dataset name defined in this file
                    'stat_type' => 'count_FC_season', //count, average, etc
                    'model_name' => 'order_model',
                    'model_method' => 'count_all_results',
                    'model_params' => array
                    (
                        //'_ValidUntil' => date('Y') . '/' . (date('y') + 1),
                        //'_ValidUntil' => if(date('n') <= 6) date('Y'),
                        '_ItemBought' => 'Season Ticket (Adult)',
                     ),
                    'fields' => array 
                    (
                        'Id' => '#',
                    ),
                ),
                'count_all_junior_seasonticket_records' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => '', //The dataset name defined in this file
                    'stat_type' => 'count_FC_season', //count, average, etc
                    'model_name' => 'order_model',
                    'model_method' => 'count_all_results',
                    'model_params' => array
                    (
                        //'_ValidUntil' => date('Y') . '/' . (date('y') + 1),
                        //'_ValidUntil' => if(date('n') <= 6) date('Y'),
                        '_ItemBought' => 'Season Ticket (Junior)',
                     ),
                    'fields' => array 
                    (
                        'Id' => '#',
                    ),
                ),
                'count_all_adult_records' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => '', //The dataset name defined in this file
                    'stat_type' => 'count', //count, average, etc
                    'model_name' => 'contact_model',
                    'model_method' => 'count_all_results',
                    'model_params' => array
                    (
                        'FirstName !=' => 'count_all_ADUL_records', 
                        //'Birthday <=' => date('Y-m-d', date('Y') - 16 ),
                        'Birthday <' => date('Y-m-d', mktime(0,0,0,date('m'),date('d'),date('Y') - 16)),
                        //'_LegacyMembershipNo > ' => 0,
                     ),
                    'fields' => array 
                    (
                        'Id' => '#',
                    ),
                ),
                'count_all_junior_records' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE
                    'data_source' => '', //The dataset name defined in this file
                    'stat_type' => 'count', //count, average, etc
                    'model_name' => 'contact_model',
                    'model_method' => 'count_all_results',
                    'model_params' => array
                    (
                        'FirstName !=' => 'count_all_junior_records', 
                        //'Birthday <=' => date('Y-m-d', date('Y') - 16 ),
                        'Birthday >=' => date('Y-m-d', mktime(0,0,0,date('m'),date('d'),date('Y') - 16)),
                        //'_LegacyMembershipNo > ' => 0,
                     ),
                    'fields' => array 
                    (
                        'Id' => '#',
                    ),
                )
            ),
        ),
    );

/*
|--------------------------------------------------------------------------
| Fields for contact Controller
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
                        'contact.Id' => '#',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contact.Nickname' => 'Known As',
                        'contact.PostalCode' => 'Postcode',
                        'contact.Email' => 'Prim Email',
                        'contact.Phone1' => 'Landline',
                        'contact.Phone2' => 'Mobile',
                        'contact.PostalCode' => 'Postcode',
                        'contact._LegacyMembershipNo' => 'Memb No',
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
                        'contact.Id' => '#',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contact._OrganisationName' => 'Company Name',
                        'contact.PostalCode' => 'Postcode',
                        'contact.Email' => 'Prim Email',
                        'contact.Phone1' => 'Landline',
                        'contact.Phone2' => 'Mobile',
                        'contact.PostalCode' => 'Postcode',
                        'contact._LegacyMembershipNo' => 'Memb No',
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
                'roles' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    //'data_source' => 'roles', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            'ActionType =' => 'Role', 
                        ),     
                    'fields' => array 
                    (
                        'Id' => '#',
                        '_ActionSubtype' => 'Role',
                        'ActionDescription' => 'Description',
                        '_ValidUntil' => 'Season',
                        'StartDate' => 'Start',
                        'EndDate' => 'End',
                    ),
                ),  
                'orders' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    //'data_source' => 'all_actions', //The dataset name defined above
                    'model_name' => 'order_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => NULL,  
                    'fields' => array 
                    (
                        'Id' => '#',
                        'DateCreated' => 'Date',
                        '_ItemBought' => 'Item Bought',
                        '_ValidUntil' => 'Season',
                        'TotalPrice_A' => '£',
                        //'DateCreated' => 'Date Created',
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
                        //'__contactId' => 'contact Id of vehicle owner',
                        '__Make' => 'Make',
                        '__Model' => 'model',
                        '__Registration' => 'Reg',
                        '__MOT_expiry' => 'MOT Exp',
                        '__Service_expiry' => 'Service Exp',
                        //'__ActiveYN' => 'Active?',
                    ),
                ),   
                'comms' => array
                (
    // this needs to be turned to TRUE!!! )(create table & model first though)                
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'comms', //The dataset name defined above
                    'model_name' => 'comms_model',
                    'model_method' => 'get_all_contacts_records', 
                    'model_params' => NULL,      
                    'fields' => array 
                    (
                        '__Id' => '#',
                        '__Type' => 'Type',
                        '__Subject' => 'Subject',
                    ),
                ),
                'relationships' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'relationships', //The dataset name defined above
                    'model_name' => 'contactjoin_model',
                    'model_method' => 'joinon_contactJoin', 
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => '#',
                        'contact.Id' => '',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        '__contactjoin.__Id' => '',
                        '__contactjoin.__Reason' => 'Reason',
                        '__contactjoin.__contactId' => '',
                        '__contactjoin.__contactId2' => '',
                        //'__contactjoin.__ActiveYN' => 'Active?',
                        '__contactjoin._ActiveRecordYN' => '',
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
                        'cssClassInput' => 'xlarge',
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
                            'Dr' => 'Dr',
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
                        'label' => 'Known As',                  
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
                        'label' => 'Primary Email',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge ',
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
                      '_LegacyMembershipNo' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Membership no',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'mini',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' readonly ',  //eg. title="tooltip" rel="tooltips"
                        //'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '_LegacyMembershipNo',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'EmailAddress2' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Secondary Email',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' title="Automated emails go to PRIMARY email only" rel="tooltips" ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'EmailAddress2',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'Birthday' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Date of Birth',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        //'cssClassInput' => 'datepicker',
                        'cssClassInput' => 'datepicker_dob mask_date',
                        'cssIdInput' => '',
                        'extraHTMLInput' => 'title="Use format dd/mm/yyyy" rel="tooltips"',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Birthday',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      '__ClubEventsYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Interested in Club Events?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__ClubEventsYN',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                         (
                            'No' => '0',
                            'Yes' => '1',
                         ),
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      '__AwayMatchYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Interested in Away Match travel?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__AwayMatchYN',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                         (
                            'No' => '0',
                            'Yes' => '1',
                         ),
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
                      '_StreetAddress3' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Address 3',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '_StreetAddress3',
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
                        'label' => 'Town/City',                  
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
                        'cssIdInput' => 'countries_uk',
                        'extraHTMLInput' => ' title="Start typing to find your country" rel="tooltips" ',  //eg. title="tooltip" rel="tooltips"
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
                        'cssClassInput' => 'mask_phone',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' title="Landline Only" rel="tooltips" ',  //eg. title="tooltip" rel="tooltips"
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
                        'cssClassInput' => 'mask_mobile',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' title="Mobile Only - no spaces" rel="tooltips" ',  //eg. title="tooltip" rel="tooltips"
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
                        'cssClassInput' => 'mask_phone_work',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' title="Work Only - space for optional extension" rel="tooltips" ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Phone3',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                      'Phone4' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Overseas Number',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        //'cssClassInput' => 'mask_phone_overseas',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' title="Overseas Only - (+44) 161 2762 987 (Optional space for 4 extra numbers at end)" rel="tooltips" ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Phone4',
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
                        'cssClassInput' => 'xlarge',
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
                        'label' => 'Twitter Id',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        //'cssClassInput' => 'twitter',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' title="Exclude the @" rel="tooltips" ',  //eg. title="tooltip" rel="tooltips"
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
                        'cssClassInput' => 'xxxlarge',
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
                        'defaultvalue' => 1,              
                    ),
                      '_OptinTwitterYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into Twitter?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_OptinTwitterYN',
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
                        'defaultvalue' => 1,              
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
                        'defaultvalue' => 1,              
                    ),
                     '_OptinSurfaceMailYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into Post?',                  
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
                        'defaultvalue' => 1,             
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
                        'defaultvalue' => 1,              
                    ),
                     '_OptinMerchandiseYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into Merchandise Emails?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_OptinMerchandiseYN',
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
                        'defaultvalue' => 1,              
                    ),
                     '__ClubEventsYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into Club Events?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__ClubEventsYN',
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
                        'defaultvalue' => 1,              
                    ),
                     '__AwayMatchYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into Away Match Details?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '__AwayMatchYN',
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
                        'defaultvalue' => 0,              
                    ),
                     '_OptinOtherYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into Youth/Women?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_OptinOtherYN',
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
                        'defaultvalue' => 1,              
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
                        'defaultvalue' => 'Email',              
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
                    'model_method' => 'joinon_contact_and_Vehicle', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'contact.Id' => 'contact Id',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contactaction.Id' => 'booking Id',
                        'contactaction.ActionDescription' => 'ActionDescription',
                        'contactaction._ActionSubtype' => 'Type',
                        'contactaction.ActionDate' => 'Date',
                        'contactaction._EstimatedDuration' => 'Duration',
                        'contactaction._CompletedYN' => 'Completed YN',
                        'contactaction.UserID' => '',
                        'contactaction._Status' => '',
                        '__vehicles.__Registration' => 'Reg',
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
                        '__contactId' => 'contact Id of vehicle owner',
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
                /*'bookings_join' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'bookings_join', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'joinon_contact', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'contact.Id' => 'contact Id',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contactaction.Id' => 'booking Id',
                        'contactaction.ActionDescription' => 'ActionDescription',
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
                    'CreationNotes' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Notes on the job',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'large',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' rows=10',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => 'CreationNotes',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_ActionSubtype' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Type of Booking',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '_ActionSubtype',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'MOT' => 'MOT',
                            'Diagnostic' => 'Diagnostic',
                            'Interim service' => 'Interim Service',
                            'Full Service' => 'Full Service',
                            'Electrical Fault' => 'Electrical Fault',
                            'Accident Damage' => 'Accident Damage',
                        ),
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
                        'label' => 'Type of Booking',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'hidden',
                        'name' => 'ActionType',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => NULL,
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
                        'label' => 'Description of Work',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'large',
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
                    'ActionDate' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Date of Booking',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'datetimepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'date',
                        'name' => 'ActionDate',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_EstimatedDuration' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Estimated Job Duration',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '_EstimatedDuration',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            '1 hour' => '60',
                            '2 hours' => '120',
                            '3 hours' => '180',
                            '4 hours' => '240',
                            '5 hours' => '300',
                            '6 hours' => '360',
                            '7 hours' => '420',
                            '8 hours' => '480',
                            '1.5 Days' => '2160',
                            '2 Days' => '2880',
                            '3 Days' => '4320',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_VehicleId' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Vehicle',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '_VehicleId',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_NotificationDetails' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'How do we get in touch with you?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '_NotificationDetails',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                    
                    '_Status' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Job Status',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '_Status',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            //'Awaiting Check-In',
                            //'Checked-In: Awaiting Mechanic',
                            //'Mechnic Assigned: Awaiting Check-In',
                            'Awaiting Check In' => 0,
                            'Checked In' => 1,
                            'In Progress' => 2,
                            'Paused - Awaiting Parts' => 3.1,
                            'Paused - Awaiting Clent Sign Off' => 3.2,
                            'Paused - Awaiting Manager Sign Off' => 3.2,
                            'Paused - Awaiting re-booking' => 3.3,
                            'Abandoned' => 4,
                            'Completed' => 5,
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'defaultvalue' => 0,
                        'value' => '', 
                    ),
                    'EndDate' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'End Date',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'datetimepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'date',
                        'name' => 'EndDate',
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
                        'label' => 'Mechanic Assigned',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => 'UserID',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            //overidden by dropdown
                        ),
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
                    'model_method' => 'joinon_contact_and_Vehicle', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'contact.Id' => 'contact Id',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contactaction.Id' => 'booking Id',
                        'contactaction.ActionDescription' => 'ActionDescription',
                        '__vehicles.__Registration' => 'Reg',
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
                        '__contactId' => 'contact Id of vehicle owner',
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
                    'model_method' => 'joinon_contact', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'contact.Id' => 'contact Id',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contactaction.Id' => 'booking Id',
                        'contactaction.ActionDescription' => 'ActionDescription',
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
                            '' => '',
                            'Enquiry' => 'Enquiry',
                            'Task' => 'Task',
                            //'Meeting' => 'Meeting',
                            'Phone Call' => 'Phone Call',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '',
                        'defaultvalue' => 'Task', 
                    ),
                    'ActionDescription' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Booking Title',                  
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
                        'cssClassInput' => 'datetimepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'CreationDate',
                        'helpText' => '',                        
                        'length' => '',                        
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                
                    'contactId' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'contactId',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'contactId',
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
                        'cssClassInput' => 'datetimepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'ActionDate',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'StartDate' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Start Date',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'mask_date',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'StartDate',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'EndDate' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'End Date',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'mask_date',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'EndDate',
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
                        'name' => 'UserID',
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
                    '_ValidUntil' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Season',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '_ValidUntil',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            '2013/14' => '2013/14',
                            '2012/13' => '2012/13',
                            '2011/12' => '2011/12',
                            '2010/11' => '2010/11',
                            '2009/10' => '2009/10',
                            '2008/09' => '2008/09',
                            '2007/08' => '2007/08',
                            '2006/07' => '2006/07',
                            '2005/06' => '2005/06',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_ActionSubtype' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Type of booking',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'radio',
                        'name' => '_ActionSubtype',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'MOT' => 'MOT',
                            'Service' => 'Annual Service',
                            'Diagnostics' => 'Diagnostics',
                            'Other' => 'Other'
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_VehicleId' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Vehicle',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '_VehicleId',
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
                ),
            ),
        ),
    );


$config['comms'] = Array
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
                    'model_method' => 'joinon_contact_and_Vehicle', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'contact.Id' => 'contact Id',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contactaction.Id' => 'booking Id',
                        'contactaction.ActionDescription' => 'ActionDescription',
                        '__vehicles.__Registration' => 'Reg',
                    ),
                ),*/ 
            ),
            'view' => array 
            (   
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
                        'Email' => 'Email',
                        //'Password' => 'Password',
                    ),
                ),
                'contact_info' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    //'data_source' => 'users', //The dataset name defined above
                    'model_name' => 'contact_model',
                    'model_method' => 'get_contacts_details', 
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'Username' => 'Username',
                        'Email' => 'Email',
                        'StreetAddress1' => 'StreetAddress1',
                        'StreetAddress2' => 'StreetAddress2',
                        'PostalCode' => 'PostalCode',
                        'City' => 'City',
                        'State' => 'State',                        
                        //'Password' => 'Password',
                    ),
                ),
                /*'tasks_join' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => 'bookings_join', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'joinon_contact', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'contact.Id' => 'contact Id',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contactaction.Id' => 'booking Id',
                        'contactaction.ActionDescription' => 'ActionDescription',
                    ),
                ), */
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'comms_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL,
                
                'dropdowns' => array    //or NULL
                (
                    'users' => array
                    (
                        'source' => 'users',    //which dataset are we using?
                        'label' => array ('Email'),
                        'label_separator' => ' ',
                        'value' => 'Email',
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
                        'label' => 'Contact Id',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__ContactId',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => NULL,
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__TemplateId' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Template Id',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'mini',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__TemplateId',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => NULL,
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Type' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Notes',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'small',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Type',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__From' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Sender',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '__From',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array(1=>1, 2=>2),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                
                    '__To' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'To',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__To',
                        'helpText' => '',                        
                        'length' => '',                        
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                
                    '__Subject' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Subject',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Subject',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Content' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Content',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '  rows=15',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '__Content',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__DateSent' => array       
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Date Sent',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'small',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__DateSent',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => NULL,
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
                    'model_method' => 'joinon_contact_and_Vehicle', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'contact.Id' => 'contact Id',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contactaction.Id' => 'booking Id',
                        'contactaction.ActionDescription' => 'ActionDescription',
                        '__vehicles.__Registration' => 'Reg',
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
                    'model_params' => NULL,
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
                    'model_method' => 'joinon_contactJoin', 
                    'model_params' => NULL, 
                    'fields' => array 
                    (
                        'contact.Id' => 'contact Id',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        '__contactjoin.__Id' => 'Relationship Id',
                        '__contactjoin.__Reason' => 'reason',
                        //'__contactjoin.__contactId' => 'reason',
                        '__contactjoin.__contactId2' => 'CId 2',
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
                    '__contactId' => array      
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
                        'name' => '__contactId',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__contactId2' => array      
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
                        'name' => '__contactId2',
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
                        'label' => 'Reason for Relationship',                  
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
                            'Same household' => 'same-household',
                            'Parent/Child Relationship' => 'parent-child',
                            
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
                             'Inactive' => '0',
                             'Active' => '1',    //label => value
                             
                         ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'defaultvalue' => 'Yes',
                        'value' => '1', 
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
                        '__ContactId' => 'contact Id of vehicle owner',
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
                        '__ContactId' => '',
                        '__Make' => 'Make',
                        '__Model' => 'model',
                        '__Registration' => 'Reg',
                        '__MOT_expiry' => 'MOT Expires',
                        '__Service_expiry' => 'Service Expires',
                    ),
                ), 
                /*'all_actions' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => 'all_actions', //The dataset name defined above
                    'model_name' => 'contactaction_model',
                    'model_method' => 'get_all_vehicles_records', 
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
                            //'contactId =' => '??contactId', 
                            'ActionType =' => 'Booking', 
                        ),                  
                    'fields' => array 
                    (
                        'Id' => '#',
                        'ActionType' => 'Type',
                        'ActionDescription' => 'Description',
                    ),
                ), */   
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
                    'model_method' => 'joinon_contact', 
                    'model_params' => array 
                        (   //These are chained with 'AND'
                            'ActionType =' => 'Booking', 
                        ),           
                    'fields' => array 
                    (
                        'contact.Id' => 'contact Id',
                        'contact.FirstName' => 'First Name',
                        'contact.LastName' => 'Last Name',
                        'contactaction.Id' => 'booking Id',
                        'contactaction.ActionDescription' => 'ActionDescription',
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
                        'label' => 'contact ID',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__contactId',
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
                        'extraHTMLInput' => '  onblur="javascript:this.value=this.value.toUpperCase(); "',  //eg. title="tooltip" rel="tooltips"
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
                    '__VehicleNotes' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Notes on this Vehicle',                  
                        'cssClassInputDiv' => '',
                        'cssClassInput' => 'xxxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => 'rows="20" readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'cssIdInputDiv' => '',
                        'name' => '__VehicleNotes',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => NULL,
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
                        'defaultvalue' => 1,
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
                        'label' => 'Model',                  
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
                        'cssClassInput' => 'datetimepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__MOT_expiry',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => NULL,
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
                        'cssClassInput' => 'datetimepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' readonly', //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Service_expiry',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => NULL,
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
                        'cssClassInput' => 'datetimepicker',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' readonly',  //eg. title="tooltip" rel="tooltips"
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
                        'label' => 'Current Mileage',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'validate[required,custom[integer]]',
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
                        'cssClassInput' => 'textarea xlarge',
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
                        'cssClassInput' => 'textarea xlarge',
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
                        'cssClassInput' => 'textarea xlarge',
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
                        'cssClassInput' => 'textarea xlarge',
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
                        'cssClassInput' => 'textarea xlarge',
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
                        'cssClassInput' => 'textarea xlarge',
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

$config['campaign'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                'campaigns' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    //'data_source' => '', //The dataset name defined above
                    'model_name' => 'campaign_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => 'Id',
                        'Name' => 'Campaign Name',
                        '_Type' => 'Campaign Type',
                    ),
                ),
                'get_all_templates' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'template_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array
                    (
                        '__ActionType !=' => 'TAG'
                    ), 
                    'fields' => array 
                    (
                        '__Id' => 'Id',
                        '__Name' => 'Name',                       
                        '__ActionType' => 'Action type',                       
                    ),
                ),
                'get_all_tags' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'tags_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => 'Id',
                        'GroupName' => 'Tag Name',                       
                        //'GroupCategoryId' => 'Tag Type',                         
                        //'GroupDescription' => 'Tag Description',                         
                    ),
                ),
                'get_all_links' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'links_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        '__Id' => 'Id',                      
                        '__LinkName' => 'Name',                         
                        '__DestinationURL' => 'Destination URL',                         
                    ),
                ),
            ),
            'view' => array 
            (  
               'steps' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => '', //The dataset name defined in this file
                    'model_name' => 'steps_model',
                    'model_method' => 'get_campaign_steps',
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        '__steps.__Id' => '#',
                        '__steps.__CampaignId' => 'Camp ID',
                        '__steps.__StepName' => 'Last Name',
                        '__steps.__ActionType' => 'Postcode',
                        '__steps.__TemplateId' => 'Template Id',
                        '__steps.__TagId' => 'Tag Id',                        
                        '__steps.__StepNo' => 'StepNo',
                        '__steps.__Delay' => 'Delay',
                        //'__template.__Id' => 'templ id',
                        '__template.__Name' => 'temp name',
                    ),
                ),            
                'get_all_templates' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'template_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array
                    (
                        '__ActionType !=' => 'TAG'
                    ), 
                    'fields' => array 
                    (
                        '__Id' => 'Id',
                        '__Name' => 'Name',                       
                        '__ActionType' => 'Action type',                       
                    ),
                ),
                'get_all_tags' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'tags_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => 'Id',
                        'GroupName' => 'GroupName',                       
                        'GroupCategoryId' => 'GroupCategoryId',                         
                    ),
                ),
                'get_all_links' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'links_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        '__Id' => 'Id',                      
                        '__LinkName' => 'Name',                         
                        '__DestinationURL' => 'Destination URL',                         
                    ),
                ),
                'tag_dropdown' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'tags_model',
                    'model_method' => 'tag_dropdown', 
                    'model_params' => NULL, 
                    'fields' => array 
                    (
                        'Id' => 'Id',
                        'GroupName' => 'Tag Name',                       
                        '__ActiveYN' => 'Active',                       
                    ),
                ),
                'template_dropdown' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'template_model',
                    'model_method' => 'template_dropdown', 
                    'model_params' => NULL, 
                    'fields' => array 
                    (
                        '__Id' => 'Id',
                        '__Name' => 'Name',                       
                        '__ActionType' => 'Action type',                        
                    ),
                ),
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'campaign_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL, 
                'dropdowns' => array    //or NULL
                (
                    'tag_dropdown' => array
                    (
                        'source' => 'tag_dropdown',    //which dataset are we using?
                        'label' => array ('tag_dropdown'),
                        'label_separator' => '',
                        'value' => 'Id',
                    ),
                    'template_dropdown' => array
                    (
                        'source' => 'template_dropdown',    //which dataset are we using?
                        'label' => array ('template_dropdown'),
                        'label_separator' => '',
                        'value' => 'template_dropdown',
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
                    'Name' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Campaign name',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Name',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_Type' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Campaign Type',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '_Type',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Follow Up' => 'Follow_Up',
                            'Link Automation' => 'Link_Automation',
                            'Apply Tag only' => 'Tag_only',
                            //'Countdown to Date' => 'Countdown_to_date',
                            //'Countdown from Date' => 'Countdown_from_date',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'Status' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Status',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Status',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                 
                    '__CampaignDescription' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Description',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' rows=2',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '__CampaignDescription',
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


$config['tags'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                //no index ever called
            ),
            'view' => array 
            (  
               //dont; think we need this
                'template_dropdown' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'template_model',
                    'model_method' => 'template_dropdown', 
                    'model_params' => NULL, 
                    'fields' => array 
                    (
                        '__Id' => 'Id',
                        '__Name' => 'Name',                       
                        '__ActionType' => 'Action type',                        
                    ),
                ),
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'tags_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL, 
                'dropdowns' => array    //or NULL
                (                    
                    'template_dropdown' => array
                    (
                        'source' => 'template_dropdown',    //which dataset are we using?
                        'label' => array ('template_dropdown'),
                        'label_separator' => '',
                        'value' => 'template_dropdown',
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
                    'GroupName' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Tag name',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'GroupName',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'GroupCategoryId' => array              //prob a dropdown
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Cat Id',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'GroupCategoryId',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                 
                    'GroupDescription' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Description',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' rows=2',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => 'GroupDescription',
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

$config['template'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                //no index ever called
            ),
            'view' => array 
            (  
               //dont; think we need this
                'template_dropdown' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'template_model',
                    'model_method' => 'template_dropdown', 
                    'model_params' => NULL, 
                    'fields' => array 
                    (
                        '__Id' => 'Id',
                        '__Name' => 'Name',                       
                        '__ActionType' => 'Action type',                        
                    ),
                ),
                'contacts' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array
                    (
                        '_OptinEmailYN =' => 1,
                    ), 
                    'fields' => array 
                    (
                        'Id' => '#',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'Email' => 'Email Address',
                    ),
                ),
            ),            
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'template_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL, 
                'dropdowns' => array    //or NULL
                (                    
                    'template_dropdown' => array
                    (
                        'source' => 'template_dropdown',    //which dataset are we using?
                        'label' => array ('template_dropdown'),
                        'label_separator' => '',
                        'value' => 'template_dropdown',
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
                        'extraHTMLInput' => 'readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'hidden',
                        'name' => '__Id',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__ActionType' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Type of Template',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'hidden',
                        'name' => '__ActionType',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'EMAIL' => 'Email',
                            'SMS' => 'SMS Text',
                            'LETTER' => 'Direct Mail',
                            'TWEET' => 'Tweet',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__Name' => array              //prob a dropdown
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Template name',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' placeholder="E.g. Email 12-2 - Requesting a meeting" ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Name',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                 
                    '__Content' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Content',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        //'cssClassInput' => 'cleditor',
                        'cssClassInput' => 'cleditor',
                        'cssIdInput' => ' __Content',
                        'extraHTMLInput' => ' rows=20',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '__Content',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                 
                    '__FromEmail' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Sender\'s Email',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__FromEmail',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                 
                    '__FromName' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Sender\'s Name',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__FromName',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                 
                    '__Subject' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Subject',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => 'PLaceholder="Write a short, snappy subject here"',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Subject',
                        'helpText' => '',                        
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),                 
                    '__TemplateName' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Template name on PA',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'large',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '__TemplateName',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                        (
                            'Plain Text Email' => 'css_only_standard',
                            'Newsletter' => 'test_basecamp',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                        'default_value' => 'css_only_standard',
                        'blank_entry' => FALSE
                    ),                 
                ),                
            ),
        ),
    );


$config['links'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                //no index ever called
            ),
            'view' => array 
            (  
               //dont; think we need this
                'campaign_dropdown' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,                    
                    'data_source' => '', //The dataset name defined above
                    'model_name' => 'campaign_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => NULL,
                    /*'model_params' => array
                    (
                        '_Type =' => 'Link_Automation',
                    ), */
                    'fields' => array 
                    (
                        'Id' => 'Id',
                        'Name' => 'Name',                       
                        //'ActionType' => 'Action type',                        
                    ),
                ),
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'links_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL, 
                'dropdowns' => array    //or NULL
                (                    
                    'campaign_dropdown' => array
                    (
                        'source' => 'campaign_dropdown',    //which dataset are we using?
                        'label' => array ('Name'),
                        'label_separator' => '',
                        'value' => 'Id',
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
                        'extraHTMLInput' => 'readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__Id',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__LinkName' => array
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Link Name',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => 'placeholder="Click here for details" rel="tooltips" title="This the text your contacts see when you include this link in an email" ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__LinkName',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__LinkDescription' => array
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Link Description',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxxxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => 'rows=2',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '__LinkDescription',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__SequenceId' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Start a Campaign?',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '__SequenceId',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                            (
                                'test' => 1,
                            ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '__DestinationURL' => array              //prob a dropdown
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Destination URL',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' placeholder="http://" ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => '__DestinationURL',
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

$config['order'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                //no index ever called
            ),
            'view' => array 
            (  
               //dont; think we need this                
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'order_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL, 
                'dropdowns' => NULL,
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
                        'extraHTMLInput' => 'readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'hidden',
                        'name' => 'Id',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_ItemBought' => array
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Item Bought',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '_ItemBought',
                        'helpText' => '',
                        'length' => '',
                        'options' => array
                        (
                            'blah' => 'blah',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'OrderTitle' => array
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => '',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'hidden',
                        'name' => 'OrderTitle',
                        'helpText' => '',
                        'length' => '',
                        'options' => NULL,
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'DateCreated' => array
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Date of Order',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'datepicker mask_date',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'DateCreated',
                        'helpText' => '',
                        'length' => '',
                        'options' => NULL,
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                        'defaultvalue' => date('d/m/Y'),
                    ),
                    'TotalPrice_A' => array
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Amount Paid',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'small input_mask_price',
                        'cssIdInput' => '',
                        'extraHTMLInput' => 'title="Enter the FULL price, including zeros, e.g. £12.00" rel="tooltips"', //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'TotalPrice_A',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'PaymentMethod' => array
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Payment Method',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => 'PaymentMethod',
                        'helpText' => '',
                        'length' => '',
                        'options' => array 
                        (
                            'Cash' => 'Cash',
                            'Cheque' => 'Cheque',
                            'Credit-Debit Card' => 'Credit-Debit Card',
                            'Standing Order' => 'Standing Order', 
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'Source' => array
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Source',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => 'Source',
                        'helpText' => '',
                        'length' => '',
                        'options' => array 
                        (
                            'Online' => 'Online',
                            'Post' => 'Post',
                            'Telephone' => 'Telephone',
                            'Office' => 'Office',
                            'Stall' => 'Stall',
                        ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    '_ValidUntil' => array      
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Season',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'select',
                        'name' => '_ValidUntil',
                        'helpText' => '',                        
                        'length' => '',
                        'options' => array
                            (
                                '2013/14' => '2013/14',
                                '2012/13' => '2012/13',
                                '2011/12' => '2011/12',
                                '2010/11' => '2010/11',
                                '2009/10' => '2009/10',
                                '2008/09' => '2008/09',
                                '2007/08' => '2007/08',
                                '2006/07' => '2006/07',
                                '2005/06' => '2005/06',
                            ),
                        'HTML_before' => '',
                        'HTML_after' => '',
                        'value' => '', 
                    ),
                    'OrderNotes' => array              //prob a dropdown
                    (
                        'on' => TRUE,    //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Order Notes',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxlarge',
                        'cssIdInput' => '',
                        'extraHTMLInput' => ' rows=2 ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => 'OrderNotes',
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


$config['help'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                //no index ever called
            ),
            'view' => array 
            (  
               //dont; think we need this                
            ),
        ),
        'record' => array
        (
            'view' => array
            (
                'model_name' => 'help_model',
                'model_method' => 'get_single_record',
                'model_params' => NULL, 
                'dropdowns' => NULL,
                'fields' => array 
                (
                    //none     
                ),                
            ),
        ),
    );

























$config['user'] = Array
    (
    'datasets' => array 
        (
            'index' => array 
            (
                'users' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    //'data_source' => 'contacts', //The dataset name defined in this file
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
                        'PostalCode' => 'Postcode',
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
                    'model_method' => 'get_all_users_records', 
                    'model_params' => NULL,
                    'fields' => array 
                    (
                        'Id' => '#',
                        'ActionType' => 'Type',
                        'ActionDescription' => 'Description',
                        'UserID' => '',
                    ),
                ),
                 'users' => array
                (
                    'include_in_query' => TRUE, //TRUE or FALSE,
                    //'data_source' => 'contacts', //The dataset name defined in this file
                    'model_name' => 'contact_model',
                    'model_method' => 'get_all_records', 
                    'model_params' => array 
                        (   //These are chained with 'AND'. To define an 'OR'...???
                            '_IsCrmUserYN =' => 1, 
                        ),
                    'fields' => array 
                    (
                        'Id' => '',
                        'FirstName' => 'First Name',
                        'LastName' => 'Last Name',
                        'UserName' => 'Username',
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
                        'cssClassInput' => 'xlarge',
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
                        'label' => 'Known As',                  
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
                        'cssClassInput' => 'xlarge',
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
                      'contactNotes' => array
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
                        'cssIdInput' => 'contact_notes',
                        'extraHTMLInput' => 'rows="20" readonly',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => 'contactNotes',
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
                        'defaultvalue' => 1,              
                    ),
                     '_OptinSmsYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into SMS texts?3',                  
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
                        'defaultvalue' => 1,   
                    ),
                     '_OptinSurfaceMailYN' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Opt into Post?',                  
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
                        'label' => 'Opt into Football Matters info?',                  
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
                     'Username' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Username:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Username',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                     'Password' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Password:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => '',
                        'cssIdInput' => '',
                        'extraHTMLInput' => '',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'text',
                        'name' => 'Password',
                        'helpText' => '',
                        'length' => '',
                        'HTML_before' => '',
                        'HTML_after' => '',  
                        'value' => '',              
                    ),
                     '_Signature' => array
                    (
                        'on' => TRUE,      //TRUE/FALSE to include/exclude from query
                        'cssClassContainingDiv' => '',
                        'cssIdContainingDiv' => '',
                        'cssClassLabel' => '',
                        'cssIdLabel' => '',
                        'label' => 'Signature:',                  
                        'cssClassInputDiv' => '',
                        'cssIdInputDiv' => '',                   
                        'cssClassInput' => 'xxxlarge cleditor',
                        'cssIdInput' => '',
                        'extraHTMLInput' => 'rows="20" ',  //eg. title="tooltip" rel="tooltips"
                        'type' => 'textarea',
                        'name' => '_Signature',
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



