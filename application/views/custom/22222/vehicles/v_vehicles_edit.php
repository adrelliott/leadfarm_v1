<?php
$display_none = '';
?>

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
                        <h2><a href="#tab-3">Health Check</a></h2>
                    </li>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <?php get_notifications($notifications, $rID, 'this'); ?>
                        <div class="form">
                            <?php echo form_open(DATAOWNER_ID . "/vehicles/add/edit/$rID/$ContactId", 'class="ajax"'); ?>
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
                        <?php echo form_open(DATAOWNER_ID . '/vehicles/append_note/0/' . $rID . '/' . $ContactId, 'class="ajax"'); ?>
                        <?php //echo form_open(DATAOWNER_ID . '/vehicles/append_note/' . $rID . '/' . $ContactId); ?>
                        <p>These are the notes for this record.</p>
                        <?php echo display_field($fields['__VehicleNotes']); ?>
                        <!-- Start field "Add a Note:" -->
                        <div class="clearfix">
                            <h4>Add your new note below</h4>
                            <div class="input">
                                <textarea class="xxxxlarge" type="text"  name="add_a_note" rows="5" placeholder="Your note will be automatically datestamped & appended to the notes above" /></textarea>
                            </div>
                        </div>
                        <!-- End field "Add a Note:" -->	
                        <div class="clearfix margin_top_15">
                           <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                        </div>
                        <?php echo form_close(); ?>	
                    </div>
                    <div id="tab-3">
                         <?php echo form_open(DATAOWNER_ID . "/vehicles/add/edit/$rID/$ContactId", 'class="ajax"'); ?>
                         <div class="form">
                            <?php display_field($fields['__Date_of_healthcheck']); ?>
                            <?php display_field($fields['__Mileage']); ?>
                            <?php display_field($fields['__Tyre_osf'], array('after_field' => '<input class="small" id="" type="text" name="__Tyre_pressure_osf" length="" value="" placeholder="Tyre Press.">(tyre press dont work)')); ?>
                            <?php display_field($fields['__Tyre_nsf'], array('after_field' => '<input class="small" id="" type="text" name="__Tyre_pressure_nsf" length="" value="" placeholder="Tyre Press.">(tyre press dont work)')); ?>
                            <?php display_field($fields['__Tyre_osr'], array('after_field' => '<input class="small" id="" type="text" name="__Tyre_pressure_osr" length="" value="" placeholder="Tyre Press.">(tyre press dont work)')); ?>
                            <?php display_field($fields['__Tyre_nsr'], array('after_field' => '<input class="small" id="" type="text" name="__Tyre_pressure_nsr" length="" value="" placeholder="Tyre Press.">(tyre press dont work)')); ?>
                            <?php display_field($fields['__Tyre_notes']); ?>
                             <div class="clearfix"">
                                <input name='submit' type='submit' class='button right' style='float:right' value='Save'></input>
                             </div>
                         </div>
                         <div class="form margin_top_15">
                            <?php display_field($fields['__Check_lights']); ?>
                            <?php display_field($fields['__Check_horn_wipers_washers']); ?>
                            <?php display_field($fields['__Check_aircon']); ?>
                            <?php display_field($fields['__Electric_notes']); ?>
                             <div class="clearfix"">
                                <input name='submit' type='submit' class='button right' style='float:right' value='Save'></input>
                             </div>
                         </div>
                         <div class="form margin_top_15">
                            <?php display_field($fields['__Check_brakes']); ?>
                            <?php display_field($fields['__Check_clutch']); ?>
                            <?php display_field($fields['__Check_engine_noise']); ?>
                            <?php display_field($fields['__Check_glass']); ?>
                            <?php display_field($fields['__Check_seat_belts']); ?>
                            <?php display_field($fields['__Internal_notes']); ?>
                             <div class="clearfix"">
                                <input name='submit' type='submit' class='button right' style='float:right' value='Save'></input>
                             </div>
                         </div>
                         <div class="form margin_top_15">
                            <?php display_field($fields['__Check_fluid_levels']); ?>
                            <?php display_field($fields['__Check_fluid_leaks']); ?>
                            <?php display_field($fields['__Check_battery']); ?>
                            <?php display_field($fields['__Check_drive_belts']); ?>
                            <?php display_field($fields['__Bonnet_notes']); ?>
                            <div class="clearfix"">
                                <input name='submit' type='submit' class='button right' style='float:right' value='Save'></input>
                             </div>
                         </div>
                         <div class="form margin_top_15">
                            <?php display_field($fields['__Check_brake_fluid']); ?>
                            <?php display_field($fields['__Check_master_cylinder']); ?>
                            <?php display_field($fields['__Check_linings']); ?>
                            <?php display_field($fields['__Check_disc_drums']); ?>
                            <?php display_field($fields['__Check_hoses']); ?>
                            <?php display_field($fields['__Brakes_notes']); ?>
                            <div class="clearfix"">
                                <input name='submit' type='submit' class='button right' style='float:right' value='Save'></input>
                             </div>
                         </div>
                         <div class="form margin_top_15">
                            <?php display_field($fields['__Check_exhaust']); ?>
                            <?php display_field($fields['__Check_steering']); ?>
                            <?php display_field($fields['__Check_drive_shafts']); ?>
                            <?php display_field($fields['__Check_oil']); ?>
                            <?php display_field($fields['__Underside_notes']); ?>
                            <div class="clearfix"">
                                <input name='submit' type='submit' class='button right' style='float:right' value='Save'></input>
                             </div>
                         </div>
                        <?php echo form_close(); ?>
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
        <div class="row">            
            <div class="widget clearfix">
                <h2>All Vehicles</h2>
                <div class="widget_inside">
                    <h3>A list of all vehicles owned by this contact:</h3>
                    <?php get_notifications($notifications, $rID, 'related'); ?>
                    <?php 
                        $this->table->set_template_custom(array (
                            'anchor_uri' => 'vehicles/view/edit', 
                            'ContactId_name' => '__ContactId' ,
                            'primary_key_fieldname' => '__Id'
                            ));    
                        $this->table->set_heading_custom(
                                $tables['vehicles']['table_headers']
                                );
                        echo $this->table->generate_custom(
                                $tables['vehicles']['table_data']
                                ); 
                    ?>
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
