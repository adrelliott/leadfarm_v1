<?php

/**
 * Model used to connect to API of external CRM (infusionsoft in this case)
 * 
 * note:
 *  - The connection details for our application are in libraries/infusionsoft/conn.cfg.php
 *  - This model extends the Infusionsoft class (libraries/Infusionsoft.php)
 *  - The library above initiates a connection with Infusionsoft on instantiation
 *
 * Simply define new methods here like this:
 *      public function infusion_add($par1, $para2) {
 *          //all the method gubbins
 *      }
 * and call them in the controller like this:
 *      $this->load->model('inf_model'); //LOAD THE MODEL
        $this->inf_model->infusion_add({PARAMS});
 * 
 * 
 * @author Al Elliott
 */

class Crm_model  extends Infusionsoft { //extends libraries/Infusionsoft
    
    public function __construct (){
        parent::__construct();  //this forms a connection with Infusion   
        //Set constants here
        
    }

        //gets a record by ID, array of ID's or if no ID passed, gets all records
    public function infusion_get($table_name, $Id, $returnFields) {           
       /* switch ($Id)
        {
            case //isarray:
                //get each ID
                break;
            case //is_int:
                //Get one ID
                break;
            case //NULL:
                //get all records that belong to this dID
                //DATAOWNER_ID
                break;
        }
        */
        $result = $this->app->dsLoad($table_name, $Id, $returnFields);

        //do some error reporting here 
        return $result;
    }
    
    public function infusion_opt_in ($email) {
        return $this->app->optIn($email, OPT_IN_REASON);        
    }
    
    
    public function infusion_add($table_name, $data, $Id = NULL) {
        //If ID is NULL then it creates a new record, otherwise it updates record
        //with given Id
        switch ($Id)
        {
            case NULL:  //insert the data
                
                $result = $this->app->dsAdd($table_name, $data); 
                   //Returns the ID of the newly created record
                //now opt in the email
                if (isset($data['Email'])) 
                {
                    $optin_inresult = $this->infusion_opt_in($data['Email']);
                }
                
                //put some error reporting in here.
                /*foreach ($result as $action)
                {
                    if ( ! is_int($action) )
                    {
                        echo "Error: $action";
                        die;
                    }
                }*/
                return $result;
                break;
            //case //is_int:
                //update one ID
                //break;
            //case //is_array:
                //update all records in this array 
                //break;
        }
    }    
        
        
        
        
        
        
    }
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
