<?php
$display_none = '';
?>

<div class="col_6"><!-- Start Column 1-->	
    <?php foreach($notifications as $n => $html) { echo $html; } ?>
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
                        <h2><a href="#tab-3">Health Check</a></h2>
                    </li>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <div class="form">
                            <?php //echo form_open('vehicles/add'); ?>
                            <?php display_field($fields['__Registration']); ?>
                            <?php display_field($fields['__Make']); ?>
                            <?php display_field($fields['__Model']); ?>
                            <?php display_field($fields['__MOT_expiry']); ?>
                            <?php display_field($fields['__Service_expiry']); ?>
                            <?php display_field($fields['__ActiveYN']); ?>
                            <div class="clearfix">
                                <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-2">
                        <?php echo form_open(DATAOWNER_ID . '/contact/append_note/' . $rID . '/' . $fieldset); ?>
                            <p>These are the notes for this record.</p>
                            <?php //echo display_field($fields['ContactNotes']); ?>
                           <!-- Start field "Add a Note:" -->
                           <div class="clearfix">
                               <h4>Add your new note below</h4>
                               <div class="input">
                                   <textarea class="xxlarge" type="text"  name="add_a_note" rows="5" placeholder="Your note will be automatically datestamped & appended to the notes above" /></textarea>
                               </div>
                           </div>
                           <!-- End field "Add a Note:" -->	
                           <div class="clearfix margin_top_15">
                               <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                           </div>
                        <?php echo form_close(); ?>	
                    </div>
                    <div id="tab-3">
                         <div class="form">
                            <?php display_field($fields['__Date_of_healthcheck']); ?>
                            <?php display_field($fields['__Mileage']); ?>
                            <?php display_field($fields['__Tyre_osf']); ?>
                            <?php display_field($fields['__Tyre_nsf']); ?>
                             <div class="clearfix margin_top_15">
                                <a href="" class="large blue button right iframe"><span>Create New Relationship</span></a>
                            </div>
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
    <h4><strong>Discussing</strong> this Vehicle? Quote Vehicle Id <strong><?php echo $rID; ?></strong></h4>
</span>
    <div class="row clearfix">
        <div class='row'>
            <div class="widget clearfix  form">
                <h2>Other Vehicles</h2>
                <div class="clearfix">
                    
                    <div class="clearfix margin_top_15">
                        <a href="" class="large blue button right iframe">
                        <span>Create New Vehicle</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>  
        <div class="row"><!-- Tabs begin -->
            
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href='#tab-1'>Actions</a></h2></li>
                    <li><h2><a href='#tab-2'>Bookings</a></h2></li>
                    <li><h2><a href='#tab-3'>Other Vehicles</a></h2></li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        
                        <div class="clearfix margin_top_15">
                           <a href="" class="large blue button right iframe"><span>Create New Action</span></a>
                       </div>
                    </div>
                    <div id="tab-2">
                        
                        <div class="clearfix margin_top_15">
                           <a href="" class="large blue button right iframe"><span>Create New Booking</span></a>
                       </div>
                    </div>
                    <div id="tab-3">
                       
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
    </div>
</div>