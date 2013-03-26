<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Create An Action</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Create a New Relationship</h3>
                        <div class="form">
                            <?php echo form_open("contactjoin/add/edit/$rID/$ContactId") ; ?>
                            <?php if($rID == 'new') {include('fieldsets/v_contact_join_table.php');} ?>
                                <?php echo display_field($fields['__Reason']); ?> 
                                <?php echo display_field($fields['__ActiveYN']); ?> 
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
        