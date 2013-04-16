<div class="row clearfix">
    <div class="col_12">
        <div class="margin_bottom_30 clearfix">
            <?php include ( APPPATH . 'views/default/common/display_message.php' );?>
        </div>
        <div class="widget clearfix">            
            <h2>Find Customers</h2>
            <div class="widget_inside">                
               <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '0', 'ContactId_name' => 'Id'));    
                    $this->table->set_heading_custom($tables['contacts']['table_headers']);
                    echo $this->table->generate_custom($tables['contacts']['table_data']); 
                ?> 
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <a href="<?php echo site_url( '/contact/view/edit/new/new/0' ); ?>" class="large blue button right"><span>Create New Customer</span></a>
                </div>
                <h3 class="index toggle_icon" id="option1_toggle">Looking for an Organisation?</h3>
                <div class="hide_toggle" id="option1">
                    <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '1', 'ContactId_name' => 'Id'));    
                    $this->table->set_heading_custom($tables['organisations']['table_headers']);
                    echo $this->table->generate_custom($tables['organisations']['table_data']); 
                    ?> 
                    <div class="margin_top_15"></div>
                    <div class="clearfix">
                        <a href="<?php echo site_url( 'contact/view/edit/new/new/1' ); ?>" class="large blue button right"><span>Create New Organisation</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>