<?php 
    //if ($this->data['message']) {echo '<span class="notification information">'
    //    . $this->data['message'] . '</span>';} 
?>
<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Find a Vehicle</h2>
            <div class="widget_inside">                
               <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'vehicles/view/edit', 'primary_key_fieldname' => '__Id', 'ContactId_name' => '__ContactId'));    
                    $this->table->set_heading_custom($tables['vehicles']['table_headers']);
                    echo $this->table->generate_custom($tables['vehicles']['table_data']); 
                ?>
                <span class="notification information margin_top_25 col_6 right">
                    <h4>Creating a new vehicle?</h4>
                    <p>Firstly, search for the contact, then use the 'Create new Vehicle' button on the 'Vehicles' tab.</p>
            </span>
            </div>
            
        </div>
    </div>
</div>