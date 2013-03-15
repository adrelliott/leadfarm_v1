<?php

$this->table->set_template_custom(array ('anchor_uri' => 'vehicles/view/edit', 'anchor_uri_append' => $ContactId, 'primary_key_fieldname' => '__Id'));    
$this->table->set_heading_custom($tables['vehicles']['table_headers']);
echo $this->table->generate_custom($tables['vehicles']['table_data']);
