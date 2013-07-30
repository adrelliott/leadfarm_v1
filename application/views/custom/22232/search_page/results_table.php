<?php

if (count($tables['search_results']['table_data']))
{
    $headings = array();
    $headings = array_keys($tables['search_results']['table_data'][0]);
    Foreach ($headings as $k => $v)
    {
        $headings['table_headers'][$v] = $v;
    }

    //print_array($headings);
    $this->table->set_template_custom(array (
        //'anchor_uri' => 'contactjoin/view/edit', 
        'anchor_uri' => 'contact/view/edit',
        'anchor_uri_append_primaryidYN' => FALSE,
        //'anchor_uri_append' => $ContactId, 'anchor_attr' => 
        'class="iframe" ' ,
        //'primary_key_fieldname' => 'Id',
        'ContactId_name' => 'Id',   //
        //'delete_button_flag' => TRUE,
        //'delete_button_uri' => 'contactjoin/delete_record/' . $ContactId,
        ));    
    $this->table->set_heading_custom($headings['table_headers']);
    echo $this->table->generate_custom($tables['search_results']['table_data']);
}
