<?php

$this->table->set_template_custom(array (
    'anchor_uri' => 'contactaction/view/edit_booking', 
    'anchor_uri_append' => $ContactId, 
    'anchor_attr' => 'class="iframe"  data-table-id="tab-6"'
    ));    
$this->table->set_heading_custom($tables['bookings']['table_headers']);
echo $this->table->generate_custom($tables['bookings']['table_data']);
