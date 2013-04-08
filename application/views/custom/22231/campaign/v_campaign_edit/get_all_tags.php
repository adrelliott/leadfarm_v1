<?php

$this->table->set_template_custom(array (
    'anchor_uri' => 'tags/view/edit', 
    'anchor_attr' => 'class="iframe" data-table-id="tab-2"'
    ));
$this->table->set_heading_custom($tables['get_all_tags']['table_headers']);
echo $this->table->generate_custom($tables['get_all_tags']['table_data']); 