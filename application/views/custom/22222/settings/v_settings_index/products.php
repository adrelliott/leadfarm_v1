<?php

$this->table->set_template_custom(array (
    'anchor_uri' => 'product/view/edit', 
    'anchor_attr' => 'class="iframe" data-table-id="tab-1"'
    ));    
$this->table->set_heading_custom($tables['products']['table_headers']);
echo $this->table->generate_custom($tables['products']['table_data']);