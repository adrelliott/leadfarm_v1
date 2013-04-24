<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">User's Profile</a></h2></li>
                    <li><h2><a href="#tab-2">Login Details</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h4>Profile Details:</h4>
                        <div class="form">
                            <?php echo form_open('/user/add/edit_modal/' . $rID . '/' . $rID); ?>
                            <?php display_field($fields['Title']); ?>
                            <?php display_field($fields['FirstName']); ?>
                            <?php display_field($fields['LastName']); ?>
                            <?php display_field($fields['Nickname']); ?>
                            <?php display_field($fields['Email']); ?>
                            <?php display_field($fields['_Signature']); ?>
                            <?php display_field($fields['_IsCrmUserYN'], array('value' => 1)); ?>
                            <div class="clearfix">
                                <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                            </div>
                        </div><!-- End of form div-->
                        <p id="option1_toggle" class="button left">
                            <span>View Opt In Settings</span>
                        </p> 
                        <div class="hide_toggle" id="option1">
                            <div class="form margin_top_30">
                                <?php display_field($fields['_OptinEmailYN']); ?>
                                <?php display_field($fields['_OptinSmsYN']); ?>
                                <?php display_field($fields['_OptinSurfaceMailYN']); ?>
                                <?php display_field($fields['_OptinNewsletterYN']); ?>
                                <?php display_field($fields['_OptinPref']); ?>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-2"><!-- Start of tab 2 -->
                        <h4>Profile Details:</h4>
                        <div class="form">
                            <?php echo form_open('/user/change_password/edit/' . $rID); ?>
                            <?php if (isset($view_setup['message'])) echo $view_setup['message']; ?>
                            <?php display_field($fields['Username']); ?>
                            <div class="clearfix" id="">
                                <label class="" id="">What's your current Password?</label>
                                <div class="input">
                                    <input class="" type="password" name="Password">
                                </div>
                            </div>
                            <div class="clearfix" id="">
                                <label class="" id="">New Password:</label>
                                <div class="input">
                                    <input class="" type="password" name="New_Password">
                                </div>
                            </div>
                            <div class="clearfix" id="">
                                <label class="" id="">Password Again:</label>
                                <div class="input">
                                    <input class="" type="password" name="New_Password_2">
                                </div>
                            </div>
                            <div class="clearfix">
                                <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 