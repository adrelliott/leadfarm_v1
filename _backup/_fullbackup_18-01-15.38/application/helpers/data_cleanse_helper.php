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

