<?php

$this->table->set_template_custom(array (
    'anchor_uri' => 'links/view/edit', 
    'anchor_attr' => 'class="iframe" data-table-id="tab-3"', 
    'primary_key_fieldname' => '__Id'
    )); 
$this->table->set_heading_custom($tables['get_all_links']['table_headers']);
echo $this->table->generate_custom($tables['get_all_links']['table_data']); 