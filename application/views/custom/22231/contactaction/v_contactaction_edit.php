<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Create An Action</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Create/edit an Action for this contact</h3>
                        <div class="form">
                            <?php echo form_open("contactaction/add/edit/$rID/$ContactId", 'class=""') ; ?>
                                <?php echo display_field($fields['ActionType'], array('label' => 'What type of Action?', 'blank_entry' => FALSE)); ?>
                                <?php echo display_field($fields['ActionDescription'], array('label' => 'Give it a Title')); ?>
                                <?php echo display_field($fields['CreationNotes']); ?>
                                <?php echo display_field($fields['_CompletedYN']); ?>                                
                                <?php echo display_field($fields['UserID'], array('options' => $dropdowns['users'])); ?>                                
                                <?php echo display_field($fields['ActionDate'], array('label'=> 'Due Date')) ?>
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
<?php print_array($this->data); ?>
        