<?php

$this->table->set_template_custom(array (
    'anchor_uri' => 'vehicles/view_modal/edit_modal', 
    'anchor_uri_append' => $ContactId, 
    'primary_key_fieldname' => '__Id', 
    'anchor_attr' => 'class="iframe"  data-table-id="tab-4"'));    
$this->table->set_heading_custom($tables['vehicles']['table_headers']);
echo $this->table->generate_custom($tables['vehicles']['table_data']);
