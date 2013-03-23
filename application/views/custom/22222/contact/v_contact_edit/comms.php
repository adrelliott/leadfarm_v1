<?php

$this->table->set_template_custom(array 
    (
        'anchor_uri' => 'comms/view/view', 
        'anchor_uri_append' => $ContactId, 
        'primary_key_fieldname' => '__Id', 
        'anchor_attr' => 'class="iframe" data-table-id="tab-7"'    //open in modal, and refresh tab-3 when closed
    ));    
$this->table->set_heading_custom($tables['comms']['table_headers']);
echo $this->table->generate_custom($tables['comms']['table_data']);
