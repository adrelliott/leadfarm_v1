<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Edit the Job</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h4>
                                This is a job described as <em>type</em>, for a FORD FIESTA (REG), for FirstName LastName
                            </h4>
                        <div class="form">
                            <?php echo form_open(DATAOWNER_ID . "/booking/add/edit_workshop/$rID") ; ?>
                            
                                <?php echo display_field($fields['Id'], array('type' => 'hidden'));  ?>
                                <?php echo display_field($fields['_ActionSubtype']);  ?>
                                <?php echo display_field($fields['ActionDescription']);  ?>
                                <?php echo display_field($fields['UserID'], array('cssClassInputDiv' => ' largePrint', 'cssClassInput' => ' largePrint', 'label' => 'Who\'s on this Job?', 'options' => $dropdowns['users']));  ?>
                                <?php echo display_field($fields['_EstimatedDuration'], array('cssClassInputDiv' => ' largePrint', 'cssClassInput' => ' largePrint'));  ?>
                               
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='giant button blue right large' style='float:right' value='SAVE!'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 
        