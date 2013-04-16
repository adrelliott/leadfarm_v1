<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
           <h3 class="index speech_icon">"Hello <?php echo $this->session->userdata('Nickname');?> . What's on your mind?"</h3>
            <h3 class="index toggle_icon" id="option1_toggle">Contacts...</h3>
            <div class="widget_inside hide_toggle" id="option1">
                <h4>"Psst...You can search by any of the columns you see below."</h4>
                <div class="margin_top_15"></div>
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '0', 'ContactId_name' => 'Id'));    
                    $this->table->set_heading_custom($tables['master_search']['table_headers']);
                    echo $this->table->generate_custom($tables['master_search']['table_data']); 
                ?> 
                <div class="col_5 last clearfix margin_top_15 right">                    
                    <a href="<?php echo site_url( '/contact/view/edit/new/new/0' ); ?>" class="large red button right"><span>Create New Customer</span></a>
                    <a href="<?php echo site_url( '/contact/view/edit/new/new/1' ); ?>" class="large button left"><span>Create New Organisation</span></a>
                </div>
            </div>
            <h3 class="index toggle_icon" id="option2_toggle">Orders...</h3>
            <div class="widget_inside hide_toggle" id="option2">
                <div class="margin_top_15"></div>
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'order/view/edit'));    
                    $this->table->set_heading_custom($tables['orders']['table_headers']);
                    echo $this->table->generate_custom($tables['orders']['table_data']); 
                ?>
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <h4>To create a new order, start by finding/creating the customer.</h4>
                </div>
            </div>
            <div class="clearfix"></div>
            <h3 class="index toggle_icon" id="option3_toggle">Campaigns...</h3>
            <div class="widget_inside hide_toggle" id="option3">
                <div class="margin_top_15"></div>
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'campaign/view/edit'));    
                    $this->table->set_heading_custom($tables['campaigns']['table_headers']);
                    echo $this->table->generate_custom($tables['campaigns']['table_data']); 
                ?>
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <a href="<?php echo site_url( '/campaign/view/edit/new' ); ?>" class="large red button right"><span>Create New Campaign</span></a>
                </div>
            </div>
            <div class="clearfix"></div>
                </div>        
    </div>
</div>