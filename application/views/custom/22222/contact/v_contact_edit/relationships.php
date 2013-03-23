<?php

$this->table->set_template_custom(array 
    (
        'anchor_uri' => 'contactjoin/view/edit', 
        'anchor_uri_append' => $ContactId,
        'primary_key_fieldname' => '__Id',
        'anchor_attr' => 'class="iframe"  data-table-id="tab-3"'    //open in modal, and refresh tab-3 when closed
    ));    
$this->table->set_heading_custom($tables['relationships']['table_headers']);
echo $this->table->generate_custom($tables['relationships']['table_data']);