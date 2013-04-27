<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Roles</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Create/edit a role for this contact</h3>
                        <div class="form">
                            <?php echo form_open("contactaction/add/edit_role/$rID/$ContactId") ; ?>
                                <?php //echo display_field($fields['Id'], array('type' => 'hidden'));  ?>
                                <?php //echo display_field($fields['ContactId'], array('type' => 'hidden', 'value' => $ContactId));  ?>
                                <?php echo display_field($fields['ActionType'], array('type' => 'hidden', 'value' => 'Role')); ?>
                                <?php echo display_field($fields['_ActionSubtype'], array('label' => 'Role', 'type' => 'select', 'options' => array(
                                    '' => '', 
                                    'Volunteer (Office)' => 'Volunteer (Office)', 
                                    'Volunteer (Matchday)' => 'Volunteer (Matchday)', 
                                    'Paid Office Staff' => 'Paid Office Staff', 
                                    'Community Staff' => 'Community Staff', 
                                    'Board Member' => 'Board Member', 
                                    'External Supplier' => 'External Supplier', 
                                    'Coaching Staff' => 'Coaching Staff', 
                                    '1st Team Player' => '1st Team Player', 
                                    'Youth Team Player' => 'Youth Team Player', 
                                    'Women\'s Team Player' => 'Women\'s Team Player',
                                    ))); ?>
                                <?php display_field($fields['ActionDescription'], array( 'label' => 'Full description')); ?>
                                <?php echo display_field($fields['CreationNotes'], array('label' => 'Notes')); ?>
                                <?php echo display_field($fields['_ValidUntil'], array('label' => 'Season')); ?>
                               
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button red right large' style='float:right' value='Save'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 
        
