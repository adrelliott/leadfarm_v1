<div class="col_6"><!-- Start Column 1-->
    <div class="row clearfix">
        <div class="widget clearfix">
            <h2>Edit Campaign</h2>
            <div class="widget_inside">
                <h3>Campaign Details:</h3>
                <div class="form">
                    <?php echo form_open(DATAOWNER_ID . '/campaign/add/edit/' . $rID, 'class="ajax"'); ?>
                        <?php display_field($fields['_Type']); ?>
                        <?php display_field($fields['Name']); ?>
                        <?php display_field($fields['__CampaignDescription']); ?>
                        <div class="clearfix" id="">
                            <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
                        </div>                                 
                    <?php echo form_close(); ?>
                </div>
                    <h3 class="margin_top_45">Edit the steps for this Campaign:</h3>
                <div class="form">
                    <?php $this->load->view ('custom/' . DATAOWNER_ID . '/campaign/v_campaign_edit/steps') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Column 2-->
<div class="col_6 last" style="<?php echo $display_none; ?>">
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
                        <div class="dataTable-container" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/get_all_templates') ?>">
                        <?php $this->load->view ('custom/' . DATAOWNER_ID . '/campaign/v_campaign_edit/get_all_templates') ?>
                        </div>
                        <div class="margin_top_15"></div>
                        <div class="clearfix">
                            <a href="<?php echo site_url() . DATAOWNER_ID; ?>/template/view/edit/new" class="large blue button right iframe" data-table-id="tab-1"><span>Create New Template</span></a>
                        </div>
                    </div>
                    <div id="tab-2">
                        <div class="dataTable-container" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/get_all_tags') ?>">
                        <?php $this->load->view ('custom/' . DATAOWNER_ID . '/campaign/v_campaign_edit/get_all_tags') ?>
                        </div>
                        <div class="margin_top_15"></div>
                        <div class="clearfix">
                            <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contactgroup/view/edit/new" class="large blue button right iframe" data-table-id="tab-2"><span>Create New Tag</span></a>
                        </div>
                    </div>
                    <div id="tab-3">
                        <div class="dataTable-container" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/get_all_links') ?>">
                        <?php $this->load->view ('custom/' . DATAOWNER_ID . '/campaign/v_campaign_edit/get_all_links') ?>
                        </div>
                        <div class="margin_top_15"></div>
                        <div class="clearfix">
                            <a href="<?php echo site_url() . DATAOWNER_ID; ?>/links/view/edit/new" class="large blue button right iframe" data-table-id="tab-3"><span>Create New Link</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>
