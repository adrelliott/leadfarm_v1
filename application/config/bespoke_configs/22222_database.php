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
if (!isset($config['database']['prefix'])) $config['database']['prefix'] = '';
$default_prefix = $config['database']['prefix'];

switch (ENVIRONMENT) 
{
case 'hn-development':
		$config['database']['username'] = 'root';
		$config['database']['password'] = '';
		$config['database']['database'] = 'leadfarm';
		break;
	
case 'al-development':  //on al's Desktop
		$config['database']['username'] = $default_prefix . 'superadmin';
		$config['database']['password'] = $default_password;
		$config['database']['database'] = $default_prefix . '22222';
		break;
	
case 'staging': //On leadfarm.co.uk
		$config['database']['username'] = $default_prefix . 'admin';
		$config['database']['password'] = $default_password;
		$config['database']['database'] = $default_prefix . '22222';
		break;
					
case 'demo':  // on automatingmarketing.co.uk
                $config['database']['username'] = 'campaign_leadfar';
                $config['database']['password'] = 'DMmanch35';
                $config['database']['database'] = 'campaign_leadfarm';
		break;
            
case 'production':  //on CampaignDashboard.co.uk
                $config['database']['username'] = 'campaign_leadfar';
                $config['database']['password'] = 'DMmanch35';
                $config['database']['database'] = 'campaign_leadfarm';
		break;

		default:
			exit('The application environment is not set correctly.');
}


/* End of file xxxx_database.php */
/* Location: ./application/config/bespoke_config/ */