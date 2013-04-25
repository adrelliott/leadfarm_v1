<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">User's Profile</a></h2></li>
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
                        <p id="option2_toggle" class="button right">
                            <span>View Opt In Settings</span>
                        </p> 
                        <div class="hide_toggle" id="option2">
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
                        <?php
                        if ($rID == 'new' OR $correct_password == 1 )
                            include('v_user_edit/login_details.php');
                        else
                            include('v_user_edit/password_challenge.php');
                        ?>
                    </div>
                </div>
            </div>                
        </div>
    </div>      
</div>   