<div class="col_6"><!-- Start Column 1-->
    <div class="row clearfix">
        <div class="row"><!-- Tabs begin -->
            <div class="widget clearfix tabs">
                <ul>
                    <li>
                        <h2><a href="#tab-1">Email</a></h2>
                    </li>
                    <li style="<?php echo $display_none; ?>"">
                        <h2><a href="#tab-2">Notes</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <div class="form">
                            <?php echo form_open(DATAOWNER_ID . '/contact/add/0/' . $rID); ?>
                            <?php display_field($fields['Name']); ?>
                            <?php display_field($fields['Status']); ?>
                            
                            <?php $this->load->view ('custom/' . DATAOWNER_ID . '/campaign/v_campaign_edit/steps') ?>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-2">
                        //more stuff
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Column 2-->
<div class="col_6 last" style="<?php echo $display_none; ?>">
    
<span class="notification information">
    <h4><strong>Transferring</strong> this contact? Quote Contact Id <strong></strong></h4>
</span>
    <div class="row clearfix"> 
        <div class="row"><!-- Tabs begin -->
            
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href='#tab-1'>Actions</a></h2></li>
                    <li><h2><a href='#tab-2'>Bookings</a></h2></li>
                    <li><h2><a href='#tab-3'>Comms</a></h2></li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        
                       
                    </div>
                    <div id="tab-2">
                        
                    </div>
                    <div id="tab-3">
                        
                    </div>
                </div>
            </div>
        </div>       
    </div>
</div>