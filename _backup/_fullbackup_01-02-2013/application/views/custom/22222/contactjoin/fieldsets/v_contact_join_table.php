<?php
    $this->table->set_template_custom(array ('anchor_uri' => '', 'radio_flag' => 1, 'radio_name' => '__ContactId2', 'radio_value_is_id' => 1 ));    
    $this->table->set_heading_custom($tables['contacts']['table_headers']);
    echo $this->table->generate_custom($tables['contacts']['table_data']);
?>