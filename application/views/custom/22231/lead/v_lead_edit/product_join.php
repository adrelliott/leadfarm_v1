<?php

$this->table->set_template_custom(array (
    'ContactId_name' => 'ContactID',
    'anchor_attr' => 'class="iframe"'));    
$this->table->set_heading_custom($tables['product_join']['table_headers']);
echo $this->table->generate_custom($tables['product_join']['table_data']);