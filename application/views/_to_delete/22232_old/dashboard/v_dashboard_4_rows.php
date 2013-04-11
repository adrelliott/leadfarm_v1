<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>What now..?</h2>            
            <h3 class="index" id="option1_toggle">Find/create a contact...</h3>
            <div class="widget_inside hide_toggle" id="option1">
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '0'));    
                    $this->table->set_heading_custom($tables['contacts']['table_headers']);
                    echo $this->table->generate_custom($tables['contacts']['table_data']); 
                ?> 
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/new/0" class="large blue button right"><span>Create New Contact</span></a>
                </div>
            </div>
            <h3 class="index" id="option2_toggle">Find/create an organisation...</h3>
            <div class="widget_inside hide_toggle" id="option2">
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '1'));    
                    $this->table->set_heading_custom($tables['organisations']['table_headers']);
                    echo $this->table->generate_custom($tables['organisations']['table_data']); 
               ?> 
               <div class="margin_top_15"></div>
              <div class="clearfix">
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/new/1" class="large blue button right"><span>Create New Organisation</span></a>
                </div>
            </div>
            <h3 class="index" id="option3_toggle">Find a vehicle...</h3>
            <div class="widget_inside hide_toggle" id="option3">
            <?php 
                $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit/view', 'anchor_attr' => 'class="iframe"', 'primary_key_fieldname' => '__Id'));    
                $this->table->set_heading_custom($tables['vehicles']['table_headers']);
                echo $this->table->generate_custom($tables['vehicles']['table_data']); 
            ?>   			
            </div>
            <h3 class="index" id="option4_toggle">Find a Booking...</h3>
            <div class="widget_inside hide_toggle" id="option4">
            <?php 
                $this->table->set_template_custom(array ('anchor_uri' => 'pricelist/view', 'anchor_attr' => 'class="iframe"'));    
                $this->table->set_heading_custom($tables['bookings']['table_headers']);
                echo $this->table->generate_custom($tables['bookings']['table_data']); 
            ?>   	
            </div> 
        </div>        
    </div>
</div>
<div class="row clearfix">
    <?php 
        $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '0'));    
        $this->table->set_heading_custom($tables['master_search']['table_headers']);
        echo $this->table->generate_custom($tables['master_search']['table_data']); 
    ?> 
</div>