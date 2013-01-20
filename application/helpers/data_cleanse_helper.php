<?php

/* Define functions in herer that help to clane, alter or amend data
 
 * 
 */

//Checks to see if $data exists, or is an array - rteuns FALSE ifd not
function if_exists($data, $type = 'array') {
    $retval = FALSE;
    switch ($type)
    {
        case 'array':
            //is this an array? $data if it is, FALSE if its not
            if (is_array($data) OR isset($data))
            {
                $retval = $data;
            }
        case 'var':
            //is this set? $data if it is, FALSE if its not
            if (isset($data) && $data != NULL && $data != '')
            {
                $retval = $data;
            }
        default: 
            $retval = $data;
    }

    return $retval; //Either FALSE or $data or $data=array();
}

function swap_placeholders($array) {
    $placeholders = array
    (
        '??rID' => $this->data['view_setup']['??'],
    );
    if (! is_array($array))
    {
        //
    }
    
    return $array;
}

function clean_data($input, $cleanse_type = NULL){
        //
        //  NOTE: Hidden fields are prepended with 'hidden_' 
        $retval = array();
        
        foreach ($input as $key => $val)
        {
            if ($key == 'submit')   
            {
                unset($input[$key]);
            }
        }
        $retval = $input;
        
        
    /*
        $field_cleansing = array //list all fields that have timestamps here
        (
            'date_fields' => array ('CreationDate', 'ActionDate')
        ); 
        
        
        switch ($cleanse_type)
        {
            case 'flashdata':   //swap '??' for flashdata
                //is_array($input) || $input = array($input); //should always be an array
                //echo "herecomes input"; print_r($input);
                foreach ($input as $key => $value)
                {
                    if (strpos($value, '??'))
                    {
                        $flashdata_item = explode('??', $value);
                        $input[$key] = $flashdata_item[1];
                    }                    
                }
                print_r($input);
                $retval = $input;
                break;
            case 'infusionsoft':   //removes any fields prepended with '__' (double underscore)
                //is_array($input) || $input = array($input); //should always be an array
                //echo "herecomes input"; print_r($input);
                foreach ($input as $key => $value)
                {
                    if (strpos($value, '__'))
                    {
                        unset($input[$key]);
                    }                                  
                }                
                $retval = $input;
                break;
            case 'after_retrieval':   
                //converts any columns into the format required to display 
  //print_array($input);die;
                $retval = array();
                    foreach ($input as $key => $val)
                    {
                        if (in_array($key, $field_cleansing['date_fields']))
                        {
                            //This deals with all date/time/timestamp fields
                            switch ($key)
                            {
                                case 'ActionDate':
                                    //get the date                                    
        //echo "val = $val, key=$key";
                                    $retval[$key] = convert_timestamp(
                                    $val, 'date_time', 'timestamp_to_date_and_time'
                                    );
                                    //print_array($retval, 1);
                                    break;
                                case 'CreationDate':
                                    $retval[$key] = $val;
                                    break;
                                default:
                                    break;
                            }
                        }
                        else
                        {
                            $retval[$key] = $val;
                        }
                    }         
                //$retval = $input;
                break;
           case 'before_insertion':
                // Cleans the $_POST array ready for update/insert
                //print_array($field_cleansing['date_fields'], 1);
                $retval = array();
                    foreach ($input as $key => $val)
                    {
                        if ($key == 'submit')   
                        {
                            unset($input[$key]);
                        }
                        elseif (in_array($key, $field_cleansing['date_fields']))
                        {
                            //This deals with all date/time/timestamp fields
                            switch ($key)
                            {
                                case 'ActionDate':
                                    //get the date                                    
  //echo "val = $val, key=$key";
                                    $retval[$key] = convert_timestamp(
                                    $val, 'timestamp', 'date_and_time_to_timestamp'
                                    );
                                    //print_array($retval, 1);
                                    break;
                                case 'CreationDate':
                                    unset($retval[$key]);
                                    break;
                                default:
                                    break;
                            }
                        }
                        else
                        {
                            if (substr($key, 0, 7) != 'ignore-')    //prepend with ignore- to exclude
                            {
                                //$retval[$key] = alter_data($key, $val);
                                $retval[$key] = $val;
                            }
                        }
                    }
                break;
            default:    //default
                break;
            }
     * */
        return $retval;
    }

