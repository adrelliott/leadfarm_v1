<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Vehicles</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Create/edit a vehicles for this contact</h3>
                        <div class="form">
                            <?php echo form_open( "/vehicles/add/edit_modal/$rID/$ContactId", 'class="ajax"' ) ; ?>
                                <?php //echo display_field($fields['__Id'], array('type' => 'hidden'));  ?>
                                <?php //echo display_field($fields['__ContactId'], array('type' => 'hidden', 'value' => $ContactId));  ?>                                
                                <?php echo display_field($fields['__Make']); ?>
                                <?php echo display_field($fields['__Model']); ?>
                                <?php display_field($fields['__Registration']); ?>
                                <?php echo display_field($fields['__ActiveYN']); ?>
                                <?php echo display_field($fields['__MOT_expiry']); ?>
                                <?php echo display_field($fields['__Service_expiry']); ?>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        </div>
                        <?php if ( $rID != 'new') : ?>
                        <span class="notification information margin_top_25">Looking for all the details of this vehicle? <a href="<?php echo site_url( "vehicles/view/edit/$rID/$ContactId" ); ?>" target="_blank"><strong>Full  vehicle details here</strong></a></span>
                        <?php endif;?>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 
        