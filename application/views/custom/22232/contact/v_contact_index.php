<div class="row clearfix">
    <div class="col_12">
        <div class="margin_bottom_30 clearfix">
            <?php include ( APPPATH . 'views/default/common/display_message.php' );?>
        </div>
        <div class="widget clearfix">            
            <h2>Find Fans</h2>
            <div class="widget_inside">  
                 <h4>You can search by any of the columns you see below in the table:</h4>
               <?php //print_r($tables['contacts']);
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '0', 'ContactId_name' => 'Id'));    
                   $this->table->set_heading_custom($tables['contacts']['table_headers']);
                    //echo $this->table->generate_custom($tables['contacts']['table_data']); 
                ?> 
                 <?php 
                 $this->table->set_template_custom(array('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '0', 'ContactId_name' => 'Id', 'table_open' => '<table class="ajax_table">'));
                $this->table->set_heading_custom($tables['contacts']['table_headers']);
                //$this->table->set_heading_custom(array('Id', 'FirstName', 'LastName'));
                echo $this->table->generate_custom();
                ?>
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <a href="<?php echo site_url( '/contact/view/edit/new/new/0' ); ?>" class="large red button right"><span>Create New Fan</span></a>
                </div>
                <h3 class="index toggle_icon" id="option1_toggle">Looking for an Organisation?</h3>
                <div class="hide_toggle" id="option1">
                 <h4>You can search by any of the columns you see below in the table:</h4>
                    <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '0', 'ContactId_name' => 'Id'));    
                    $this->table->set_heading_custom($tables['organisations']['table_headers']);
                    echo $this->table->generate_custom($tables['organisations']['table_data']); 
                    ?> 
                    <div class="margin_top_15"></div>
                    <div class="clearfix">
                        <a href="<?php echo site_url( 'contact/view/edit/new/new/1' ); ?>" class="large red button right"><span>Create New Organisation</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>