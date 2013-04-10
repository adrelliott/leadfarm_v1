<?php

$this->table->set_template_custom(array ('anchor_uri' => 'lead/view/edit', 'anchor_uri_append' => $ContactId, 'anchor_attr' => 'class="iframe"'));    
$this->table->set_heading_custom($tables['leads']['table_headers']);
echo $this->table->generate_custom($tables['leads']['table_data']);