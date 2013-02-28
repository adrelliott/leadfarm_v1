<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Define database settings for this user
|--------------------------------------------------------------------------
|
| We define standard DB settings here. This ifile is 'included' by the main 
| XXXXX_config.php file and is set up to serve both dev, staging and prod environs
*/



switch (ENVIRONMENT) 
{
case 'hn-development':
		$config['database']['username'] = 'root';
		$config['database']['password'] = '';
		$config['database']['database'] = 'leadfarm';
		break;
	
case 'development':
		$config['database']['username'] = 'p3_user1';
		$config['database']['password'] = 'DMmanch35';
		$config['database']['database'] = '22231_leadfarm_data';
		break;
	
/*case 'development': //????? depends on the test!
		$config['database']['username'] = 'leadfarm_22222';
		$config['database']['password'] = 'DMmanch35';
		$config['database']['database'] = '22222_leadfarm_data';
                break;*/
            
case 'staging': //????? depends on the test!
		$config['database']['username'] = 'leadfar2_admin';
		$config['database']['password'] = 'DMmanch35';
		$config['database']['database'] = 'leadfar2_22222_1';
		break;
					
case 'pre-production':  //automatingmarketing
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
