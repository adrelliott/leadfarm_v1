<?php

$this->table->set_template_custom(array (
    'anchor_uri' => 'user/view/edit_modal', 
    'anchor_attr' => 'class="iframe" data-table-id="tab-2"'
    ));    
$this->table->set_heading_custom($tables['users']['table_headers']);
echo $this->table->generate_custom($tables['users']['table_data']);