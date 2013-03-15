<?php

$this->table->set_template_custom(array ('anchor_uri' => 'vehicles/view/edit', 'ContactId_name' => '__ContactId' , 'primary_key_fieldname' => '__Id'));
$this->table->set_heading_custom($tables['vehicles']['table_headers']);
echo $this->table->generate_custom($tables['vehicles']['table_data']);

/* End of file vehicles.php */
/* Location: ./application/views/custom/22222/vehicles/v_vehicles_edit/vehicles.php */