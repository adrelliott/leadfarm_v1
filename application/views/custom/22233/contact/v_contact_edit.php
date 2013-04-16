 <?php //include("v_contact_edit/deleteme.php"); ?>

 
<div class="col_6"><!-- Start Column 1-->	
    <?php foreach($notifications as $vehicle) { foreach ($vehicle as $n => $html) { echo $html; }} ?>
    <div class="row clearfix">
        <div class="row"><!-- Tabs begin -->
            <div class="widget clearfix tabs">
                <ul>
                    <li>
                        <h2><a href="#tab-1">Details</a></h2>
                    </li>
                    <li style="<?php echo $display_none; ?>">
                        <h2><a href="#tab-2">Notes</a></h2>
                    </li>
                    <li style="<?php echo $display_none; ?>">
                        <h2><a href="#tab-3">Relationships</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <?php //echo form_open('contact/add/0/' . $rID . '/' . $ContactId . '/0', 'class="ajax"' ); ?>
                        <?php echo form_open('contact/add/edit/' . $rID . '/' . $ContactId . '/0', 'class="ajax form_val"'); ?>
                        <!-- Form opened in fieldset file -->
                                <?php include("fieldsets/v_contact_$fieldset.php");
                                    //v_contact_0 = contact, ..._1  org ?>
                                
                                <span class="notification done" style="display:none">Record Updated!</span>
                                <div class="clearfix">
                                        <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
                                        <a href="<?php echo site_url("/contact/delete_record/$ContactId"); ?>" class="small button red left" onclick="return deletechecked();">
                                        <span>Delete this Fan</span>
                                    </a>
                                </div>
                            </div><!-- End of form div-->
                            <p id="option1_toggle" class="button left">
                                <span>View Opt In Settings</span>
                            </p> 
                            <div class="hide_toggle" id="option1">
                                <div class="form margin_top_30">
                                    <?php display_field($fields['_OptinEmailYN']); ?>
                                    <?php display_field($fields['_OptinSmsYN']); ?>
                                    <?php display_field($fields['_OptinSurfaceMailYN']); ?>
                                    <?php //display_field($fields['_OptinNewsletterYN']); ?>
                                    <?php display_field($fields['_OptinMerchandiseYN']); ?>
                                    <?php display_field($fields['__ClubEventsYN']); ?>
                                    <?php display_field($fields['__AwayMatchYN']); ?>
                                    <?php display_field($fields['_OptinPref']); ?>
                                    <div class="clearfix">
                                        <input name='submit' type='submit' class='button blue right small' style='float:right' value='Save'></input>

                                    </div>
                                </div>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div id="tab-2">
                         <?php echo form_open('contact/append_note/0/' . $rID . '/' . $ContactId . '/' . $fieldset, 'class="ajax"'); ?>
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
                        <?php include ('v_contact_edit/relationships.php') ?>
                        <?php //$this->load->view ('custom/22222/contact/v_contact_edit/relationships') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                           <a href="<?php echo site_url("/contactjoin/view/edit/new/$ContactId"); ?>" class="large blue button right iframe" data-table-id="tab-3">
                               <span>Create New Relationship</span>
                           </a>
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
                    <li><h2><a href='#tab-5'>Purchases</a></h2></li>
                    <li><h2><a href='#tab-6'>Comms</a></h2></li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-5">
                        <div class="dataTable-container" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/orders') ?>">
                            <?php include ('v_contact_edit/orders.php') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                           <a href="<?php echo site_url("order/view/edit/new/$ContactId"); ?>" class="large blue button right iframe" data-table-id="tab-5">
                               <span>Create New Purchase</span>
                           </a>
                       </div>
                    </div>
                    <div id="tab-6">
                        <div class="dataTable-container" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/comms') ?>">
                            <?php include ('v_contact_edit/comms.php') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                            <a href="<?php echo site_url("comms/view/new/new/$ContactId"); ?>" class="large blue button right iframe" data-table-id="tab-6">
                                <span>Create New Comm</span>
                            </a>
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
                            <option value="1">Send Email</option>
                            <option value="2">Send membership Enquiry Pack</option>
                            <option value="3">Send membership pack</option>
                        </select>
                        <input type="hidden" id="quick_action_url" value="<?php echo site_url() ; ?>/quickaction/action/edit/<?php echo $rID . '/' . $ContactId; ?>/" />
                        <a id="quick_action_button" href="<?php echo site_url(); ?>/quickaction/action/edit/<?php echo $rID . '/' . $ContactId; ?>/0" class="large blue button iframe">GO!</a>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>


		<!-- validation init -->
<script type="text/javascript">
        $(function()
        {
            //Add bespoke masks to overide the defaults set in app.js    
            //$(".mask_date").mask('99/99/99', {placeholder:'x'});
                
        });			
</script>
<!--/ validation init -->