<?php 
    //if ($this->data['message']) {echo '<span class="notification information">'
    //    . $this->data['message'] . '</span>';} 
?>
<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Find Campaigns</h2>
            <div class="widget_inside">   
                 <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'campaign/view/edit'));    
                    $this->table->set_heading_custom($tables['campaigns']['table_headers']);
                    echo $this->table->generate_custom($tables['campaigns']['table_data']); 
                ?>
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <a href="<?php echo site_url('/campaign/view/edit/new'); ?>" class="large blue button right"><span>Create New Campaign</span></a>
                </div>
                <h3 class="index toggle_icon" id="option1_toggle">Looking for an Tags, Templates & Links?</h3>
                <div class="hide_toggle" id="option1">
                    <h3>Your Tags:</h3>
                    <?php 
                        $this->table->set_template_custom(array ('anchor_uri' => 'contactgroup/view/edit', 'anchor_attr' => 'class="iframe"'));    
                        $this->table->set_heading_custom($tables['get_all_tags']['table_headers']);
                        echo $this->table->generate_custom($tables['get_all_tags']['table_data']); 
                    ?> 
                    <div class="margin_top_15"></div>
                    <div class="clearfix">
                        <a href="<?php echo site_url('/contactgroup/view/edit/new'); ?>" class="large blue button right iframe"><span>Create New Tag</span></a>
                    </div>
                    <h3>Your Templates:</h3>
                    <?php 
                        $this->table->set_template_custom(array ('anchor_uri' => 'template/view/edit', 'primary_key_fieldname' => '__Id', 'anchor_attr' => 'class="iframe"'));    // 'anchor_attr' => 'class="iframe"',
                        $this->table->set_heading_custom($tables['get_all_templates']['table_headers']);
                        echo $this->table->generate_custom($tables['get_all_templates']['table_data']); 
                    ?> 
                    <div class="margin_top_15"></div>
                    <div class="clearfix">
                        <a href="<?php echo site_url('/template/view/edit/new'); ?>" class="large blue button right iframe"><span>Create New Template</span></a>
                    </div>
                    <h3>Your Links:</h3>
                    <?php 
                        $this->table->set_template_custom(array ('anchor_uri' => 'links/view/edit', 'anchor_attr' => 'class="iframe"', 'primary_key_fieldname' => '__Id'));    
                        $this->table->set_heading_custom($tables['get_all_links']['table_headers']);
                        echo $this->table->generate_custom($tables['get_all_links']['table_data']); 
                    ?> 
                    <div class="margin_top_15"></div>
                    <div class="clearfix">
                        <a href="<?php echo site_url('/links/view/edit/new'); ?>" class="large blue button right iframe"><span>Create New Link</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>