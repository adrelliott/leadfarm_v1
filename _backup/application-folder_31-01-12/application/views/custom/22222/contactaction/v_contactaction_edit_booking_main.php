<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">View Booking</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Edit a booking for this contact</h3>
                        <div class="form">
                            <?php //echo form_open('contactaction/add/') ; ?>
                                <?php echo display_field($fields['Id'], array('type' => 'hidden'));  ?>
                                <?php echo display_field($fields['ContactId'], array('type' => 'hidden'));  ?>
                                <?php echo display_field($fields['ActionType'], array('type' => 'hidden', 'value' => 'Booking')); ?>
                                <?php echo display_field($fields['ActionDescription'], array('label' => 'Booking Type', 'type' => 'select', 'options' => array('' => '', 'MOT' => 'MOT', 'Service' => 'Service', 'Interim service' => 'Interim service', 'Diagnosis' => 'Diagnosis'))); ?>
                                <?php echo display_field($fields['CreationNotes']); ?>
                                <?php echo display_field($fields['_CompletedYN']); ?>                                
                                <?php echo display_field($fields['UserID'], array('options' => $dropdowns['users'])); ?>                                
                                <?php echo display_field($fields['ActionDate'], array('label'=> 'Due Date')) ?>
                                <?php //echo display_field($this->data['results']['EndDate']) ?>
                            <code>Put an end date for meetings in here</code>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                                </div>                            
                            <?php //echo form_close(); ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 
<?php //print_array($this->data); ?>
        