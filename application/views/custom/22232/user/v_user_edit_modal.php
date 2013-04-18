<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Create New User</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <?php if(isset($view_setup['success'])): ?>
                        <span class="notification done"><h4>User created Successfully!</h4> Close this window and choose the user from the User's Table to make further changes</span>
                        <?php else : ?>
                        <h3>Create Profile</h3>
                        <?php 
                        echo validation_errors('<span class="notification undone">', '</span>'); 
                        if( isset($view_setup['message']) ) echo $view_setup['message'];
                        ?>
                        <div class="form">
                            
                            <?php echo form_open( '/user/add_new_user/edit_modal/' . $rID ); ?>
                            <?php display_field($fields['Title'], array('value' => set_value('Title'))); ?>
                            <?php display_field($fields['FirstName'], array('value' => set_value('FirstName'))); ?>
                            <?php display_field($fields['LastName'], array('value' => set_value('LastName'))); ?>
                            <?php display_field($fields['Email'], array('value' => set_value('Email'))); ?>
                            <?php display_field($fields['Username'], array('label' => 'Choose a username (4-8 characters)', 'value' => set_value('Username'))); ?>
                            <div class="clearfix" id="">
                                <label class="" id="">Choose a Password:</label>
                                <div class="input">
                                    <input class="" type="password" name="Password" value="<?php echo set_value('Password'); ?>">
                                </div>
                            </div>
                            <div class="clearfix" id="">
                                <label class="" id="">Type your password again:</label>
                                <div class="input">
                                    <input class="" type="password" name="___passconf" value="<?php echo set_value('___passconf'); ?>">
                                </div>
                            </div>
                            <div class="clearfix">
                                <input name='submit' type='submit' class='button red right medium' style='float:right' value='Save'></input>
                            </div>
                            
                                <?php echo form_hidden('_IsCrmUserYN', 1) ; ?>
                            <?php echo form_close(); ?>
                        </div><!-- End of form div-->
                        <?php endif; ?>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 
        