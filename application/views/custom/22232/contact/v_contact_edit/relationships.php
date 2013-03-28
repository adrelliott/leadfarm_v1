<?php

$this->table->set_template_custom(array (
    'anchor_uri' => 'contactjoin/view/edit', 
    'anchor_uri_append' => $ContactId, 'anchor_attr' => 
    'class="iframe" data-table-id="tab-3"' ,
    'primary_key_fieldname' => '__Id'));    
$this->table->set_heading_custom($tables['relationships']['table_headers']);
echo $this->table->generate_custom($tables['relationships']['table_data']);