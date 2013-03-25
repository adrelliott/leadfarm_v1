<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*  use this file to determine if we use the standard, default cotrollers, 
 *  or if we have written any bespoke controllers for this user
 * 
 *  NOTE: The array needs to be set as TRUE in order for the bespoke file to be called
 *  NOTE: You MUST also put the controller class in the right folder of 
 *  controllers//bespoke_controllers. 
 * 
 *  e.g. if dID = 12345, and you wnat to use a bespoke 'Contact' controller then:
 *      1. Make sure there is class defined in controllers/bespoke_controllers/12345/Contact.php
 *      2. Make sure it follows the ocnvenstions of the default class
 *      3. Set a flag below like this:
 *  $controller_config = array
 * (
 *      '12345' => array
 *      (
 *          'Contact' => TRUE,      //CAPITALISE THE FIRST LETTER!!!!!!
 *      )
 * );
 * 
 * If the flag is either FALSE or the array is not set (e.g no 'contact' key exists) 
 * then the  default contreoller is called
 * 
 * 
 */

$controller_config = array
(
    //e.g. 
    //  '12345' => array
    //    (
    //          'Dashboard' => TRUE,    //capitalise the key! TRUE = yes, there is a bespoke
    //    )
    
    '22222' => array 
    (
        //'Dashboard' => TRUE,
        //'Contact' => TRUE,
    ),
    
);

