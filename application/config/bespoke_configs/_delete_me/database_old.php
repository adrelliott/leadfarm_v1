<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Define database settings for this user
|--------------------------------------------------------------------------
|
| We define standard DB settings here. This ifile is 'included' by the main 
| XXXXX_config.php file and is set up to serve both dev, staging and prod environs
*/

$default_username = 'admin';
$default_password = 'DMmanch35';

//global settings
$config['database']['hostname'] = 'localhost';
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
$config['database']['prefix'] = '';

//Now set up the specefic settigns for each environment
switch (ENVIRONMENT) 
{
case 'hn-development':
		$config['database']['username'] = 'root';
		$config['database']['password'] = '';
		$config['database']['database'] = 'leadfarm';
		break;
	
case 'al-development':  //on al's Desktop
                $default_prefix = 'local_';
		$config['database']['username'] = $default_prefix . 'superadmin';
		$config['database']['password'] = $default_password;
		$config['database']['database'] = $default_prefix . 'master';
		break;
	
case 'staging': //On leadfarm.co.uk    
                $default_prefix = 'local_'; // <<----------------------------------needs changing!
		$config['database']['username'] = $default_prefix . 'admin';
		$config['database']['password'] = $default_password;
		$config['database']['database'] = $default_prefix . '22222';
		break;
					
case 'demo':  // on automatingmarketing.co.uk
                $default_prefix = 'local_'; // <<----------------------------------needs changing!
                $config['database']['username'] = 'campaign_leadfar';
                $config['database']['password'] = 'DMmanch35';
                $config['database']['database'] = 'campaign_leadfarm';
		break;
            
case 'production':  //on CampaignDashboard.co.uk
                $default_prefix = 'local_'; // <<----------------------------------needs changing!
                $config['database']['username'] = 'campaign_leadfar';
                $config['database']['password'] = 'DMmanch35';
                $config['database']['database'] = 'campaign_leadfarm';
		break;

		default:
			exit('The application environment is not set correctly.');
}


/* End of file database.php */
/* Location: ./application/config/database.php */