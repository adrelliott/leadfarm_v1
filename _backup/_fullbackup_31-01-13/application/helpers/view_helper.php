<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
                $attributes['value'] = convert_timestamp($attributes['value'],'statement');
                 $retval .= '<input class="' . $attributes['cssClassInput'] . '" id="' . $attributes['cssIdInput'] . '" type="text"  name="' . $attributes['name'] . '" length="' . $attributes['length'] . '" ' . $attributes['helpText'] . ' ' . $attributes['extraHTMLInput'] . '  value="' . $attributes['value'] . '"  />';
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