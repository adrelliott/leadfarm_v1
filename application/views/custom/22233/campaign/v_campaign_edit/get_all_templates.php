<?php

$this->table->set_template_custom(array (
    'anchor_uri' => 'template/view/edit', 
    'anchor_attr' => 'class="iframe" data-table-id="tab-1"', 
    'primary_key_fieldname' => '__Id'));
$this->table->set_heading_custom($tables['get_all_templates']['table_headers']);
echo $this->table->generate_custom($tables['get_all_templates']['table_data']); 