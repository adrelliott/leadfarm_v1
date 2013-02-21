<div class="col_6"><!-- Start Column 1-->	
    <?php foreach($notifications as $vehicle) { foreach ($vehicle as $n => $html) { echo $html; }} ?>
    <div class="row clearfix">
        <div class="row"><!-- Tabs begin -->
            <div class="widget clearfix tabs">
                <ul>
                    <li>
                        <h2><a href="#tab-1">Details</a></h2>
                    </li>
                    <li style="<?php echo $display_none; ?>"">
                        <h2><a href="#tab-2">Notes</a></h2>
                    </li>
                    <li style="<?php echo $display_none; ?>">
                        <h2><a href="#tab-3">Links</a></h2>
                    </li>
                    </li>
                    <li style="<?php echo $display_none; ?>">
                        <h2><a href="#tab-4">Vehicles</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <div class="form">
                            <?php echo form_open(DATAOWNER_ID . '/contact/add/0/' . $rID . '/' . $ContactId . '/0'); ?>
                            <?php include("fieldsets/v_contact_$fieldset.php");
                                //v_contact_0 = contact, ..._1  org ?>
                        </div><!-- End of form div-->
                        <p id="option1_toggle" class="button left">
                            <span>View Opt In Settings</span>
                        </p> 
                        <div class="hide_toggle" id="option1">
                            <div class="form margin_top_30">
                                <?php display_field($fields['_OptinEmailYN']); ?>
                                <?php display_field($fields['_OptinSmsYN']); ?>
                                <?php display_field($fields['_OptinSurfaceMailYN']); ?>
                                <?php display_field($fields['_OptinNewsletterYN']); ?>
                                <?php display_field($fields['_OptinPref']); ?>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-2">
                         <?php echo form_open(DATAOWNER_ID . '/contact/append_note/0/' . $rID . '/' . $ContactId . '/' . $fieldset); ?>
                            <p>These are the notes for this record.</p>
                            <?php echo display_field($fields['ContactNotes']); ?>
                           <!-- Start field "Add a Note:" -->
                           <div class="clearfix">
                               <h4>Add your new note below</h4>
                               <div class="input">
                                   <textarea class="xxxxlarge green-highlight" type="text"  name="add_a_note" rows="5" placeholder="Your note will be automatically datestamped & appended to the notes above" /></textarea>
                               </div>
                           </div>
                           <!-- End field "Add a Note:" -->	
                           <div class="clearfix margin_top_15">
                               <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                           </div>
                        <?php echo form_close(); ?>	
                    </div>
                    <div id="tab-3">
                        <div class="dataTable-container">
                        <?php $this->load->view ('custom/22222/contact/v_contact_edit/relationships') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                           <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contactjoin/view/edit/new/<?php echo $ContactId; ?>" class="large blue button right iframe" data-table-id="tab-3" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/relationships') ?>"><span>Create New Relationship</span></a>
                       </div>
                    </div>
                    <div id="tab-4">
                        <div class="dataTable-container">
                        <?php $this->load->view ('custom/22222/contact/v_contact_edit/vehicles') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                           <a href="<?php echo site_url() . DATAOWNER_ID; ?>/vehicles/view_modal/edit_modal/new/<?php echo $ContactId; ?>" class="large blue button right iframe" data-table-id="tab-4" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/vehicles') ?>"><span>Create New Vehicle</span></a>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Column 2-->
<div class="col_6 last" style="<?php echo $display_none; ?>">
    
<span class="notification information">
    <h4><strong>Transferring</strong> this contact? Quote Contact Id <strong><?php echo $ContactId; ?></strong></h4>
</span>
    <div class="row clearfix"> 
        <div class="row"><!-- Tabs begin -->
            
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href='#tab-5'>Actions</a></h2></li>
                    <li><h2><a href='#tab-6'>Bookings</a></h2></li>
                    <li><h2><a href='#tab-7'>Comms</a></h2></li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-5">
                        <div class="dataTable-container">
                            <?php $this->load->view ('custom/22222/contact/v_contact_edit/all_actions') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                           <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contactaction/view/edit_action/new/<?php echo $ContactId; ?>" class="large blue button right iframe" data-table-id="tab-5" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/all_actions') ?>"><span>Create New Action</span></a>
                       </div>
                    </div>
                    <div id="tab-6">
                        <div class="dataTable-container">
                            <?php $this->load->view ('custom/22222/contact/v_contact_edit/bookings') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                           <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contactaction/view/edit_booking/new/<?php echo $ContactId; ?>" class="large blue button right iframe" data-table-id="tab-6" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/bookings') ?>"><span>Create New Booking</span></a>
                       </div>
                    </div>
                    <div id="tab-7">
                        <div class="dataTable-container">
                        <?php
                            $this->table->set_template_custom(array ('anchor_uri' => 'contactjoin/view/edit', 'anchor_uri_append' => $ContactId, 'anchor_attr' => 'class="iframe"'));    
                            $this->table->set_heading_custom($tables['relationships']['table_headers']);
                            echo $this->table->generate_custom($tables['relationships']['table_data']); 
                        ?>
                        </div>
                        <code>This section shows details of emails/texts & letters sent to this contact</code>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class="widget clearfix  form">
                <h2>Quick Actions</h2>
                <div class="clearfix">
                    <div class="input">
                        <label>Choose an action:</label>
                        <select id="quick_action">
                            <option value=""></option>
                            <option value="1">Send Email</option>
                            <option value="2">Send membership Enquiry Pack</option>
                            <option value="3">Send membership pack</option>
                            <option value="4">Send service pack (via email)</option>
                        </select>
                        <input type="hidden" id="quick_action_url" value="<?php echo site_url() . DATAOWNER_ID; ?>/quickaction/action/edit/<?php echo $rID . '/' . $ContactId; ?>/" />
                        <a id="quick_action_button" href="<?php echo site_url() . DATAOWNER_ID; ?>/quickaction/action/edit/<?php echo $rID . '/' . $ContactId; ?>/0" class="large blue button iframe">GO!</a>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>
