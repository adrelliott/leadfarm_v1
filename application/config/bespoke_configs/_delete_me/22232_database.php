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
	
case 'al-development':
		//$config['database']['username'] = 'p3_user1';
		//$config['database']['password'] = 'DMmanch35';
		//$config['database']['database'] = '22231_leadfarm_data';
    		$config['database']['username'] = $default_prefix . 'superadmin';
		$config['database']['password'] = $default_password;
		$config['database']['database'] = $default_prefix . '22232';
		break;
            
case 'staging': //leadfarm.co.uk
		//$config['database']['username'] = 'leadfar2_admin';
		//$config['database']['password'] = 'DMmanch35';
		//$config['database']['database'] = 'leadfar2_22222_1';
                $config['database']['username'] = $default_prefix . 'admin';
		$config['database']['password'] = $default_password;
		$config['database']['database'] = $default_prefix . '22232';
		break;
					
case 'demo':  //automatingmarketing
                $config['database']['username'] = 'campaign_leadfar';
                $config['database']['password'] = 'DMmanch35';
                $config['database']['database'] = 'campaign_leadfarm';
		break;
					
case 'production':
                $config['database']['username'] = 'campaign_leadfar';
                $config['database']['password'] = 'DMmanch35';
                $config['database']['database'] = 'campaign_leadfarm';
		break;

		default:
			exit('The application environment is not set correctly.');
}


/* End of file xxxx_database.php */
/* Location: ./application/config/bespoke_config/ */
