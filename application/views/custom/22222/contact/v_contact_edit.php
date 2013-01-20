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
                        <h2><a href="#tab-3">Links</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <div class="form">
                            <?php include("fieldsets/$fieldset.php"); ?>
                        </div>
                    </div>
                    <div id="tab-2">
                        <?php echo form_open(DATAOWNER_ID . '/contact/append_note/' . $ContactId); ?>
                            <p>These are the notes for this record.</p>
                            <?php echo display_field($fields['ContactNotes']); ?>
                           <!-- Start field "Add a Note:" -->
                           <div class="clearfix">
                               <h4>Add your new note below</h4>
                               <div class="input">
                                   <textarea class="xxlarge" type="text"  name="add_a_note" rows="5" placeholder="Your note will be automatically datestamped & appended to the notes above" /></textarea>
                               </div>
                           </div>
                           <!-- End field "Add a Note:" -->	
                           <div class="clearfix">
                               <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                           </div>
                        <?php echo form_close(); ?>	
                    </div>
                    <div id="tab-3">
                        <?php 
                            $this->table->set_template_custom(array ('anchor_uri' => 'contactjoin/view/edit', 'anchor_attr' => 'class="iframe"'));    
                            $this->table->set_heading_custom($tables['relationships']['table_headers']);
                            echo $this->table->generate_custom($tables['relationships']['table_data']); 
                        ?> 
                    </div>
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
                    <li><h2><a href='#tab-1'>Actions</a></h2></li>
                    <li><h2><a href='#tab-2'>Bookings</a></h2></li>
                    <li><h2><a href='#tab-3'>Comms</a></h2></li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <?php 
                            $this->table->set_template_custom(array ('anchor_uri' => 'contactaction/view/edit', 'anchor_attr' => 'class="iframe"'));    
                            $this->table->set_heading_custom($tables['all_actions']['table_headers']);
                            echo $this->table->generate_custom($tables['all_actions']['table_data']); 
                        ?> 
                    </div>
                    <div id="tab-2">
                        <?php 
                            $this->table->set_template_custom(array ('anchor_uri' => 'contactaction/view/edit', 'anchor_attr' => 'class="iframe"'));    
                            $this->table->set_heading_custom($tables['bookings']['table_headers']);
                            echo $this->table->generate_custom($tables['bookings']['table_data']); 
                        ?> 
                    </div>
                    <div id="tab-3">
                        <?php 
                            $this->table->set_template_custom(array ('anchor_uri' => 'contactjoin/view/edit', 'anchor_attr' => 'class="iframe"'));    
                            $this->table->set_heading_custom($tables['relationships']['table_headers']);
                            echo $this->table->generate_custom($tables['relationships']['table_data']); 
                        ?>
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
                        <select>
                            <option class="large">Send Email</option>
                            <option>Send membership Enquiry Pack</option>
                            <option>Send membership pack</option>
                            <option>Send service pack (via email)</option>
                        </select>
                        <a href="#" class="large blue button iframe">GO!</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
             <div class="widget clearfix  form">
                 <h2>Preferences</h2>
                 <div class="clearfix">
                     <div class="form no-border ">
                         <div class="form">
                            <?php echo form_open(DATAOWNER_ID . '/contact/add/' . $ContactId); ?>
                            <div class="clearfix">
                                <h4>Opt-in Settings:</h4>
                            </div>
                                <?php display_field($fields['_Optin_Email']); ?>
                                <?php display_field($fields['_Optin_SMS']); ?>
                                <?php display_field($fields['_Optin_SurfaceMail']); ?>
                                <?php display_field($fields['_Optin_Pref_Method']); ?>
                             <div class="clearfix">
                                <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                     </div>
                 </div>
             </div>											
         </div>
    </div>
</div>