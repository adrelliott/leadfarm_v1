<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h3 class="index speech_icon">"Hello <?php echo $this->session->userdata('Nickname');?> . What's on your mind...?"</h3>
            <a href="<?php echo site_url('contact'); ?>" style="text-decoration: none"><h3 class="index toggle_icon">Contacts...</h3></a>
            <?php /*<div class="widget_inside hide_toggle" id="option1">
                <h4>You can search by <em>Name</em>, or <em>Postcode</em>, or <em>Company Name</em>, or <em>Phone Number</em></h4>
                <div class="margin_top_15"></div>
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '0', 'ContactId_name' => 'Id'));    
                    $this->table->set_heading_custom($tables['master_search']['table_headers']);
                    echo $this->table->generate_custom($tables['master_search']['table_data']); 
                ?> 
                <div class="col_5 last clearfix margin_top_15 right">                    
                    <a href="<?php echo site_url( '/contact/view/edit/new/new/0' ); ?>" class="large blue button right"><span>Create New Contact</span></a>
                </div>
            </div> */ ?>
            <div class="clearfix"></div>
            <h3 class="index toggle_icon" id="option3_toggle">Leads...</h3>
            <div class="widget_inside hide_toggle" id="option3">
                <h4>You can search by <em>Name</em>, or <em>Postcode</em>, or <em>Company Name</em>, or <em>Phone Number</em></h4>
                <div class="margin_top_15"></div>
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'lead/view/edit', 'ContactId_name' => 'ContactID', 'anchor_attr' => 'class="iframe"'));    
                    $this->table->set_heading_custom($tables['leads']['table_headers']);
                    echo $this->table->generate_custom($tables['leads']['table_data']); 
                ?>
            </div>
            <div class="clearfix"></div>
            <h3 class="index toggle_icon" id="option2_toggle">Tasks...</h3>
            <div class="widget_inside hide_toggle" id="option2">
                <div class="margin_top_15"></div>
                <?php 
                    if (isset($_GET['all_tasks'])) $table_data = 'all_tasks';
                    else $table_data = 'users_tasks';
                    
                    $this->table->set_template_custom(array ('anchor_uri' => 'contactaction/view/edit', 'ContactId_name' => 'ContactId', 'anchor_attr' => 'class="iframe" '));    
                    $this->table->set_heading_custom($tables[$table_data]['table_headers']);
                    
                    echo $this->table->generate_custom($tables[$table_data]['table_data']); 
                ?> 
                <div class="clearfix margin_top_15">
                    <a href="<?php echo site_url( '/dashboard?all_tasks' ); ?>" class="blue button right"><span>View All Tasks</span></a>
                    <a href="<?php echo site_url( '/dashboard' ); ?>" class="blue button right"><span>View My Tasks</span></a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>        
    </div>
</div>
<div class="row clearfix">
    <div class="col_12">
        <?php 
            //$this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => 'unknown', 'ContactId_name' => 'Id'));    
            //$this->table->set_heading_custom($tables['master_search']['table_headers']);
            //echo $this->table->generate_custom($tables['master_search']['table_data']); 
        ?> 
    </div>
</div>