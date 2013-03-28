<?php

$this->table->set_template_custom(array ('anchor_uri' => 'contactaction/view/edit_action', 'anchor_uri_append' => $ContactId, 'anchor_attr' => 'class="iframe"'));    
$this->table->set_heading_custom($tables['all_actions']['table_headers']);
echo $this->table->generate_custom($tables['all_actions']['table_data']);