<?php

$this->table->set_template_custom(array (
    'anchor_uri' => 'contactaction/view/edit_role', 
    'anchor_uri_append' => $ContactId, 
    'anchor_attr' => 'class="iframe"  data-table-id="tab-7"'
    ));    
$this->table->set_heading_custom($tables['roles']['table_headers']);
echo $this->table->generate_custom($tables['roles']['table_data']);
