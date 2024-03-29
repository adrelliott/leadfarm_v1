<div class="col_6"><!-- Start Column 1-->
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
                        <h2><a href="#tab-3">Relationships</a></h2>
                    </li>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <?php echo form_open(DATAOWNER_ID . '/contact/add/0/' . $rID . '/' . $ContactId . '/0', 'class="ajax"' ); ?>
                            <div class="form">
                                <?php include("fieldsets/v_contact_$fieldset.php");
                                    //v_contact_0 = contact, ..._1  org ?>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'>
                                    </input>
                                </div>
                                <span class="notification done" style="display:none">Record Updated!</span>
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
                                    <?php display_field($fields['__ClubEventsYN']); ?>
                                    <?php display_field($fields['__AwayMatchYN']); ?>
                                    <div class="clearfix">
                                        <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>

                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div id="tab-2">
                         <?php echo form_open(DATAOWNER_ID . '/contact/append_note/0/' . $rID . '/' . $ContactId . '/' . $fieldset, 'class="ajax"'); ?>
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
                        <div class="dataTable-container" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/relationships') ?>">
                        <?php $this->load->view ('custom/22222/contact/v_contact_edit/relationships') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                           <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contactjoin/view/edit/new/<?php echo $ContactId; ?>" class="large blue button right iframe" data-table-id="tab-3"><span>Create New Relationship</span></a>
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
    <h4><strong>Discussing</strong> this contact? Quote Contact Id <strong><?php echo $ContactId; ?></strong></h4>
</span>
    <div class="row clearfix"> 
        <div class="row"><!-- Tabs begin -->
            
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href='#tab-6'>Purchases</a></h2></li>
                    <li><h2><a href='#tab-7'>Comms</a></h2></li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-6">
                        <div class="dataTable-container" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/all_purchases') ?>">
                            <?php $this->load->view ('custom/22232/contact/v_contact_edit/all_purchases') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                           <a href="<?php echo site_url() . DATAOWNER_ID; ?>/order/view/edit/new/<?php echo $ContactId; ?>" class="large blue button right iframe" data-table-id="tab-5"><span>Create New Order</span></a>
                       </div>
                    </div>
                    
                    <div id="tab-7">
                        <div class="dataTable-container" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/comms') ?>">
                             <?php $this->load->view ('custom/22232/contact/v_contact_edit/comms') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                       <a href="<?php echo site_url() . DATAOWNER_ID; ?>/comms/view/new/new/<?php echo $ContactId; ?>" class="large blue button right iframe" data-table-id="tab-7"><span>Create New Comm</span></a>
                        </div>
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
