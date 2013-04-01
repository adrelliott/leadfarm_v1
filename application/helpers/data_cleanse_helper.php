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
        
        if (isset($retval['submit'])) unset($retval['submit']);
        
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
                        //gives us [0] = colname, [1]= fieldname piece
                        //e.g. [0] = time, [1]= 21
                        if (isset($value))
                        {
                            $retval['timestamps'][$array[0]][$array[1]] = $value; 
                        }
                        
                        unset($retval[$key]);
                    }
                    elseif (substr($key, 0, 3) == '_:_') //prepended with this...
                    {
                        unset($retval[$key]);   //...ignore it
                    }
                    elseif (substr($key, 0, 3) == '___') //prepended with 3 underscores...
                    {
                        unset($retval[$key]);   //...ignore it
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
        
        
        return $retval;
    }
    
    function cleanse_timestamps($data) {   
        //if (empty($data)) return ;
        if ( ! is_array($data))  //Turn separate fields into a timestamp!
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
            //print_array($retval, 1, 'retval');
        }
        
        return $retval;
    }
    
    function generate_dropdown($options, $value = NULL, $blank_entry) {
        $html = '';
        if ($blank_entry == 'yes') $html = '<option value=""></option>';
        foreach ($options as $k => $v)
        {
            $selected = ''; 
            if ($v == $value) 
            {
                $selected = 'selected="selected"';
            }
            $html .= '<option value="' . $v . '" ' . $selected . '>' . $k . '</option>';
        }
        
        return $html;
    }
    
    
    
    //generate HTML when passed config & value
function display_field($attributes, $new_attributes = NULL, $value = NULL)  {
        //Override configred attributes of field with the passed array
    $attributes['before_field'] = '';  
    $attributes['after_field'] = '';  
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
         $retval .= $attributes['before_field'];
         $retval .= '<div class="input ' . $attributes['cssClassInputDiv'] . '" id="' . $attributes['cssIdInputDiv'] . '">';
        //switch each type of input
        switch ($attributes['type'])
        {
            case 'select':
                $retval .= '<select class="' . $attributes['cssClassInput'] . '" id=" ' . $attributes['cssIdInput'] . '" name="' . $attributes['name'] . '">';
                if ( !isset($attributes['blank_entry'])) $attributes['blank_entry'] = 'yes';    //defaults to blank entry
                $retval .= generate_dropdown($attributes['options'], $attributes['value'],$attributes['blank_entry'] );
                $retval .= '</select>';
                break;
            case 'radio':                
                foreach ($attributes['options'] as $k => $v)
                {
                    if ($attributes['value'] == NULL && isset($attributes['defaultvalue']))   //set default val
                    {
                        $attributes['value'] = $attributes['defaultvalue'];
                    }
                    
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
                if ( empty($attributes['value']) )
                {
                    if ( ! empty($attributes['defaultvalue']) )
                        $timestamp_array = cleanse_timestamps($attributes['defaultvalue']);
                    else $timestamp_array = array( 'date' => date('d/m/Y'), 'hours' => '10', 'mins' => '00');                        
                }
                else $timestamp_array = cleanse_timestamps($attributes['value']);
                
                //now create the 3 fields
                 $retval .= '<input class="' . $attributes['cssClassInput'] . '" id="' . $attributes['cssIdInput'] . ' datepicker" type="text"  name=":::' . $attributes['name'] . ':date" length="' . $attributes['length'] . '" ' . $attributes['helpText'] . ' ' . $attributes['extraHTMLInput'] . '  value="' . $timestamp_array['date'] . '"  />';
                 
                  $retval .= '<select class="' . $attributes['cssClassInput'] . '" id=" ' . $attributes['cssIdInput'] . '" name=":::' . $attributes['name'] . ':hours">';
                  if (empty($attributes['options'])) 
                      $attributes['options'] = array('08','09','10','11','12','13','14','15','16','17');
                foreach ($attributes['options'] as $k => $v)
                {
                    $selected = ''; 
                    if ($v == $timestamp_array['hours']) 
                    {
                        $selected = 'selected="selected"';
                    }
                    $retval .= '<option value="' . $v . '" ' . $selected . '>' . $v . '</option>';
                }
                $retval .= '</select>';
                
                //Set up minutes drop down
                $retval .= '<select class="' . $attributes['cssClassInput'] . '" id=" ' . $attributes['cssIdInput'] . '" name=":::' . $attributes['name'] . ':mins">';
                $attributes['options'] = array('00', '15', '30','45');
                foreach ($attributes['options'] as $k => $v)
                {
                    $selected = ''; 
                    if ($v == $timestamp_array['mins']) 
                    {
                        $selected = 'selected="selected"';
                    }
                    $retval .= '<option value="' . $v . '" ' . $selected . '>' . $v . '</option>';
                }
                $retval .= '</select>';
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
      
        $retval .= $attributes['after_field'];
        $retval .= '</div>';
        
        
        $retval .= '</div>' . $attributes['HTML_after'];
        $retval .= "\n" . '<!-- End field "' . $attributes['name'] . '" -->' . "\n";
        echo $retval;
   }
        
    
   function get_notifications($notifications, $rID, $output = 'all') {
    //output can be 'all' (every notification), 'this' (just notirifcations for this vehicle) and 'related' (notitifcations for related cars only)

        $html = array();
        $retval = '';
        switch ($output)
        {
            case 'all':                                    
                foreach ($notifications as $VehicleId => $array) 
                { 
                    foreach ($array as $n => $h) 
                    { 
                        $html[] = $h;                            
                    }                            
                }
                break;
            case 'this':
                foreach($notifications as $VehicleId => $array) 
                {
                    if ($VehicleId == $rID)
                    {
                        foreach ($array as $n => $h) 
                        { 
                            $html[] = $h;                            
                        }
                    }
                }
                break;
            case 'related':
                foreach($notifications as $VehicleId => $array) 
                {
                    if ($VehicleId != $rID)
                    {
                        foreach ($array as $n => $h) 
                        { 
                            $html[] = $h;                            
                        }
                    }
                }
                break;                                    
        }    

        //force all notificatiosn into one html block
        foreach ($html as $row => $value)
        {
            $retval .= $value;
        }
        echo $retval;

    }
    
    function concatenate_fields($array, $fields_array = array()) {
        //takes fields passed and puts inot an address style format
        $retval = '';
        foreach ($fields_array as $field)
        {
            if (isset($array['$fields_array'])) $retval .= $array[$fields_array].",/n";
        }
        
        return $retval;
    }