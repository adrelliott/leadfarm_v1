<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h3 class="index speech_icon">"Hello. Have we seen your car before...?"</h3>
            <h3 class="index toggle_icon" id="option1_toggle">Yes...</h3>
            <div class="widget_inside hide_toggle" id="option1">
                <h4>"Can we take your <em>Registration</em>, or <em>Name</em>, or <em>Postcode</em>, or <em>Company Name</em>, or <em>Phone Number</em> please...?"</h4>
                <div class="margin_top_15"></div>
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => 'unknown', 'ContactId_name' => 'Id'));    
                    $this->table->set_heading_custom($tables['master_search']['table_headers']);
                    echo $this->table->generate_custom($tables['master_search']['table_data']); 
                ?> 
                <div class="col_5 last clearfix margin_top_15 right">                    
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/new/new/0" class="large blue button right"><span>Create New Contact</span></a>
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/new/new/1" class="large button left"><span>Create New Organisation</span></a>
                </div>
            </div>
            <h3 class="index toggle_icon" id="option2_toggle">No...</h3>
            <div class="widget_inside hide_toggle" id="option2">
                <?php echo form_open(DATAOWNER_ID . '/contact/add/0/new/new/unknown'); ?>
                <div class="col_6">
                    <h3>Can I take your number in case we get cut off?</h3>
                    <div class="form">
                        <div class="clearfix" id="">
                            <div class="input " id="">
                                <input class="larger" style="" id="" type="text" name="Phone2" placeholder="Put MOBILE number here" length="" value=""> or 
                                <input class="larger" style="" id="" type="text" name="Phone1" placeholder="Put LANDLINE number here" length="" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col_6 last">
                    <h3>And can I take your name?</h3>
                    <div class="form">
                        <div class="clearfix" id="">
                            <div class="input " id="">
                                <input class="larger" style="" id="" type="text" name="FirstName" placeholder="FIRST NAME goes here" length="" value=""> & 
                                <input class="larger" style="" id="" type="text" name="LastName" placeholder="LAST NAME goes here" length="" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_hidden('_IsOrganisationYN', 0); ?>
                <div class="col_4 last clearfix margin_top_15 right">
                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='View Contact/Transfer'></input>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>        
    </div>
</div>
<div class="row clearfix">
    <div class="col_12">
        <?php 
            $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => 'unknown', 'ContactId_name' => 'Id'));    
            $this->table->set_heading_custom($tables['master_search']['table_headers']);
            echo $this->table->generate_custom($tables['master_search']['table_data']); 
        ?> 
    </div>
</div>