
<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix tabs">
            <ul>
                <li><h2><a href='#tab-1'>Follow-Up Campaign</a></h2></li>
                <li><h2><a href='#tab-2'>Broadcast Campaign</a></h2></li>
            </ul>
            <div class="widget_inside">
                <div id="tab-1">
                    <?php
                    $this->table->set_template_custom(array('anchor_uri' => 'campaign/view/edit'));
                    $this->table->set_heading_custom($tables['campaigns']['table_headers']);
                    echo $this->table->generate_custom($tables['campaigns']['table_data']);
                    ?>
                    <div class="margin_top_15"></div>
                    <div class="clearfix">
                        <a href="<?php echo site_url('/campaign/view/edit/new'); ?>" class="large red button right"><span>Create New Campaign</span></a>
                    </div>
                </div>
                <div id="tab-2">
                    <?php
                    $this->table->set_template_custom(array('anchor_uri' => 'broadcast/view/edit'));
                    $this->table->set_heading_custom($tables['broadcasts']['table_headers']);
                    echo $this->table->generate_custom($tables['broadcasts']['table_data']);
                    ?>
                    <div class="margin_top_15"></div>
                    <div class="clearfix">
                        <a href="<?php echo site_url('/broadcast/view/edit/new'); ?>" class="large red button right"><span>Create New Broadcast Campaign</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<h3 class="index toggle_icon" id="option1_toggle">Looking for an Tags, Templates & Links?</h3>
<div class="hide_toggle" id="option1">                    
    <div class="col_12">
        <div class="row clearfix"> 
            <div class="row"><!-- Tabs begin -->
                <div class="widget clearfix tabs">
                    <ul>
                        <li><h2><a href='#tab-1'>Templates</a></h2></li>
                        <li><h2><a href='#tab-2'>Tags</a></h2></li>
                        <li><h2><a href='#tab-3'>Links</a></h2></li>
                    </ul>
                    <div class="widget_inside">
                        <div id="tab-1">
                            <div class="dataTable-container" data-table-source="<?php echo html_escape(base_url() . $this->uri->uri_string() . '/get_all_templates') ?>">
                                <?php //$this->load->view ('custom/' . DATAOWNER_ID . '/campaign/v_campaign_edit/get_all_templates') ?>
                                <?php include ('v_campaign_edit/get_all_templates.php') ?>
                            </div>
                            <div class="margin_top_15"></div>
                            <div class="clearfix">
                                <a href="<?php echo site_url('/template/view/edit/new'); ?>" class="large red button right iframe" data-table-id="tab-1"><span>Create New Template</span></a>
                            </div>
                        </div>
                        <div id="tab-2">
                            <div class="dataTable-container" data-table-source="<?php echo html_escape(base_url() . $this->uri->uri_string() . '/get_all_tags') ?>">
                                <?php //$this->load->view ('custom/' . DATAOWNER_ID . '/campaign/v_campaign_edit/get_all_tags') ?>
                                <?php include ('v_campaign_edit/get_all_tags.php') ?>
                            </div>
                            <div class="margin_top_15"></div>
                            <div class="clearfix">
                                <a href="<?php echo site_url('/tags/view/edit/new') ?>" class="large red button right iframe" data-table-id="tab-2"><span>Create New Tag</span></a>
                            </div>
                        </div>
                        <div id="tab-3">
                            <div class="dataTable-container" data-table-source="<?php echo html_escape(base_url() . $this->uri->uri_string() . '/get_all_links') ?>">
                                <?php //$this->load->view ('custom/' . DATAOWNER_ID . '/campaign/v_campaign_edit/get_all_links') ?>
                                <?php include ('v_campaign_edit/get_all_links.php') ?>
                            </div>
                            <div class="margin_top_15"></div>
                            <div class="clearfix">
                                <a href="<?php echo site_url('/links/view/edit/new'); ?>" class="large red button right iframe" data-table-id="tab-3"><span>Create New Link</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
    </div>    
</div>

