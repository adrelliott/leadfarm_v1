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



function clean_data($input, $cleanse_type = NULL){
        $retval = $input;
        
        if (isset($retval['submit']))   //remove the 'submit' key
        {
            unset($retval['submit']);
        }
        
        switch ($cleanse_type)
        {
            
            case 'infusionsoft':    //remove fields prepended with double underscore
                foreach ($retval as $key => $value)
                {
                    if (substr($key, 0, 2) == '__')
                    {
                        unset($retval[$key]);
                    }
                }
                break;
            case NULL:  //Re-write timestamps
                foreach ($retval as $key => $value)
                {
                    if (substr($key, 0, 3) == ':::') //prepended with double underscore?
                    {
                                         
                        $array = explode(':', substr($key, 3));
                        //gives us [0] = colname, [1]= filedname piece
                        if (isset($value))
                        {
                            $retval['timestamps'][$array[0]][$array[1]] = $value; 
                        }
                        
                        unset($retval[$key]);
                    }
                }
                
                //now convert any timestamp arrays into a timestamp
                if (isset($retval['timestamps']))
                {
                    foreach ($retval['timestamps'] as $timestamp => $array)
                    {
                        $retval[$timestamp] = cleanse_timestamps($array);
                    }
                    unset($retval['timestamps']);
                }
                
                break;   
        }
 //print_array($retval, 1, 'here is data to be inserted');    
        return $retval;
    }
    
    function cleanse_timestamps($data) {   
        
        if (! is_array($data))  //Turn separate fields into a timestamp!
        {
            $retval = array();
            $data = explode(' ', $data); 
                //...creates $data[0]=YYYY-MM-DD, $data[1]=HH:MM:SS
            
            //create the date field
            $retval['date'] = explode('-', $data[0]); 
                //...creates $retval[date][0] = YYYY, [1]=MM, [2]=DD
            $retval['date'] = $retval['date'][2] . '/' . $retval['date'][1] . '/' . $retval['date'][0];
            
            //create the time fields
            $retval['time'] = explode(':', $data[1]);
                //...creates $retval[time][0] = HH, [1]=MM, [2]=SS
            $retval['hours'] = $retval['time'][0];
            $retval['mins'] = $retval['time'][1];
            
            unset($retval['time']); //Tidy up
        }
        else   //Turn a timestamp into separate fields
        {    
            
            $data['date'] = explode('/', $data['date']); //creates $retval['date'][0]=DD, [1]=MM, [2]=YYYY
            $retval = $data['date'][2] . '-' . $data['date'][1] . '-' . $data['date'][0];
            $retval .= ' ' . $data['hours'] . ':' . $data['mins'] . ':00';
        }
        
        return $retval;
    }
    
    //generate HTML when passed config & value
function display_field($attributes, $new_attributes = NULL, $value = NULL)  {
        //Override configred attributes of field with the passed array
        if ($new_attributes && is_array($new_attributes))
        {
            foreach ($new_attributes as $key => $new_value)
            {
                if (isset($attributes[$key]))  //replaces old attributes with new
                {
                    $attributes[$key] = $new_value;                     
                }
            }
        }
        
        //override the retrieved valuer with a the passed value
        if ($value)
        {
            $attributes['value'] = $value;
        }
        
        $retval = "\n" . '<!-- Start field "' . $attributes['name'] . '" -->' . "\n" . $attributes['HTML_before'];
        $retval .= '<div class="clearfix' . $attributes['cssClassContainingDiv'] . '" id="' . $attributes['cssIdContainingDiv'] . '"><label class="' . $attributes['cssClassLabel'] . '" id="' . $attributes['cssIdLabel'] . '">' . $attributes['label'] . '</label>';
         $retval .= '<div class="input ' . $attributes['cssClassInputDiv'] . '" id="' . $attributes['cssIdInputDiv'] . '">';
        //switch each type of input
        switch ($attributes['type'])
        {
            case 'select':
                $retval .= '<select class="' . $attributes['cssClassInput'] . '" id=" ' . $attributes['cssIdInput'] . '" name="' . $attributes['name'] . '">';
                foreach ($attributes['options'] as $k => $v)
                {
                    $selected = ''; 
                    if ($v == $attributes['value']) 
                    {
                        $selected = 'selected="selected"';
                    }
                    $retval .= '<option value="' . $v . '" ' . $selected . '>' . $k . '</option>';
                }
                $retval .= '</select>';
                break;
            case 'radio':                
                foreach ($attributes['options'] as $k => $v)
                {
                    $checked = '';
                    if ($v == $attributes['value']) 
                    {
                        $checked = 'checked="checked"';
                    }
                    $retval .= '<input class="" type="radio"  name="' . $attributes['name'] . '" value="' . $v . '" ' . $checked . '>' . $k;
                }
                break;
            case 'checkbox':                
                foreach ($attributes['options'] as $k => $v)
                {
                    $checked = '';
                    if ($v == $attributes['value']) 
                    {
                        $checked = 'checked="checked"';
                    }
                    $retval .= '<input class="" type="checkbox"  name="' . $attributes['name'] . '" value="' . $v . '" ' . $checked . '>' . $k;
                }
                break;
                case 'textarea':                
                $retval .= '<textarea class=" ' . $attributes['cssClassInput'] . '" id=" ' . $attributes['cssIdInput'] . '" type="textarea"  name="' . $attributes['name'] . '" length="' . $attributes['length'] . '" ' . $attributes['extraHTMLInput'] . '  />' . $attributes['value'] . '</textarea>';
                break;
                case 'timestamp': 
                $timestamp_array = cleanse_timestamps($attributes['value']);
                //set up the date field   
                $retval .= '<input class="' . $attributes['cssClassInput'] . '" id="' . $attributes['cssIdInput'] . ' datepicker" type="text"  name=":::' . $attributes['name'] . ':date" length="' . $attributes['length'] . '" ' . $attributes['helpText'] . ' ' . $attributes['extraHTMLInput'] . '  value="' . $timestamp_array['date'] . '"  />';
                
                //set up the hours drop down (the value are taken form the attr for this field in XXXXX_Config
                $retval .= '<select class="' . $attributes['cssClassInput'] . '" id=" ' . $attributes['cssIdInput'] . '" name=":::' . $attributes['name'] . ':hours">';
                foreach ($attributes['options'] as $k => $v)
                {
                    $selected = ''; 
                    if ($v == $timestamp_array['hours']) 
                    {
                        $selected = 'selected="selected"';
                    }
                    $retval .= '<option value="' . $v . '" ' . $selected . '>' . $k . '</option>';
                }
                $retval .= '</select>';
                
                //Set up minutes drop down
                $retval .= '<select class="' . $attributes['cssClassInput'] . '" id=" ' . $attributes['cssIdInput'] . '" name=":::' . $attributes['name'] . ':mins">';
                $attributes['options'] = array
                (
                    '00' => '00',
                    '15' => '15',
                    '30' => '30',
                    '45' => '45',
                );
                foreach ($attributes['options'] as $k => $v)
                {
                    $selected = ''; 
                    if ($v == $timestamp_array['mins']) 
                    {
                        $selected = 'selected="selected"';
                    }
                    $retval .= '<option value="' . $v . '" ' . $selected . '>' . $k . '</option>';
                }
                $retval .= '</select>';
                
                /*$retval .= '<input class="' . $attributes['cssClassInput'] . '" id="' . $attributes['cssIdInput'] . '" type="text"  name=":::' . $attributes['name'] . ':hours" length="' . $attributes['length'] . '" ' . $attributes['helpText'] . ' ' . $attributes['extraHTMLInput'] . '  value="' . $timestamp_array['hours'] . '"  />';*/
                /*$retval .= '<input class="' . $attributes['cssClassInput'] . '" id="' . $attributes['cssIdInput'] . '" type="text"  name=":::' . $attributes['name'] . ':mins" length="' . $attributes['length'] . '" ' . $attributes['helpText'] . ' ' . $attributes['extraHTMLInput'] . '  value="' . $timestamp_array['mins'] . '"  />';*/
                break;
            case 'hidden':
                    //NOTE The first defition of $retval is not a concatenation, like the others, 
                    //but actually overwrites all the default values set at the beginning 
                    //of this method. We set double <div> to balance up the 2 closing divs set 
                    //at the end of this method
                $retval = "\n" . '<!-- Start field "' . $attributes['name'] . '" -->' . "\n";
                $retval .= '<div><div><input class="' . $attributes['cssClassInput'] . '" id="' . $attributes['cssIdInput'] . '" type="hidden"  name="' . $attributes['name'] . '" length="' . $attributes['length'] . '" ' . $attributes['helpText'] . ' ' . $attributes['extraHTMLInput'] . '  value="' . $attributes['value'] . '"  />';
                break;
            default:
                $retval .= '<input class="' . $attributes['cssClassInput'] . '" id="' . $attributes['cssIdInput'] . '" type="text"  name="' . $attributes['name'] . '" length="' . $attributes['length'] . '" ' . $attributes['helpText'] . ' ' . $attributes['extraHTMLInput'] . '  value="' . $attributes['value'] . '"  />';
                break;
        }
       $retval .= '</div>';
        
        
        $retval .= '</div>' . $attributes['HTML_after'];
        $retval .= "\n" . '<!-- End field "' . $attributes['name'] . '" -->' . "\n";
        echo $retval;
   }
        
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
/*function swap_placeholders($array) {
    $placeholders = array
    (
        '??rID' => $this->data['view_setup']['??'],
    );
    if (! is_array($array))
    {
        //
    }
    
    return $array;
}*/
