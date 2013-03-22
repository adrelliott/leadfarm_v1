<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h3 class="index speech_icon">"Hello <?php echo $this->session->userdata('Nickname');?> . What's on your mind...?"</h3>
            <h3 class="index toggle_icon" id="option1_toggle">Fans...</h3>
            <div class="widget_inside hide_toggle" id="option1">
                <h4>You can search by <em>Name</em>, or <em>Postcode</em>, or <em>Company Name</em>, or <em>Phone Number</em></h4>
                <div class="margin_top_15"></div>
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => 'unknown', 'ContactId_name' => 'Id'));    
                    $this->table->set_heading_custom($tables['master_search']['table_headers']);
                    echo $this->table->generate_custom($tables['master_search']['table_data']); 
                ?> 
                <div class="col_5 last clearfix margin_top_15 right">                    
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/new/new/0" class="large blue button right"><span>Create New Fan</span></a>
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/new/new/1" class="large button left"><span>Create New Organisation</span></a>
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
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/campaign/view/edit/new" class="large blue button right"><span>Create New Campaign</span></a>
                </div>
            </div>
            <div class="clearfix"></div>
            <h3 class="index toggle_icon" id="option2_toggle">Stats & Reports...</h3>
            <div class="widget_inside hide_toggle" id="option2">
                 <table class="regular">
                    <thead>
                        <tr>
                            <th class="align-left"><h4>Metric</h4></th>
                    <th class="align-left"><h4>Value</h4></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Number of members</td>
                            <td><h4><?php echo $stats['count_all_records']; ?></h4></td>
                        </tr>
                        <tr>
                            <td>Number of Adult members</td>
                            <td><h4><?php echo $stats['count_all_records']; ?></h4></td>
                        </tr>
                        <tr>
                            <td>Number of Junior members</td>
                            <td><h4><?php echo $stats['count_all_records']; ?></h4></td>
                        </tr>
                    </tbody>
                </table>
                <div class="margin_top_15"></div>
                <h4>Reports:</h4>
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'reports/view/edit'));    
                    $this->table->set_heading_custom($tables['reports']['table_headers']);
                    echo $this->table->generate_custom($tables['reports']['table_data']); 
                ?>
                
            </div>
            <div class="clearfix"></div>
        </div>        
    </div>
</div>