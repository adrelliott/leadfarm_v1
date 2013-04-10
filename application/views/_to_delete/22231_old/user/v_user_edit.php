<div class="col_12"><!-- Start Column 1-->	
    <div class="row clearfix">
        <div class="row"><!-- Tabs begin -->
            <div class="widget clearfix tabs">
                <ul>
                    <li>
                        <h2><a href="#tab-1">My Profile</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        
                        <div class="col_6">
                            <h4>Profile Details:</h4>
                            <div class="form">
                                <?php echo form_open(DATAOWNER_ID . '/user/add/edit/' . $rID . '/' . $rID); ?>
                                <?php display_field($fields['Title']); ?>
                                <?php display_field($fields['FirstName']); ?>
                                <?php display_field($fields['LastName']); ?>
                                <?php display_field($fields['Nickname']); ?>
                                <?php display_field($fields['Email']); ?>
                                <?php display_field($fields['_Signature']); ?>
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
                        <div class="col_5 last">
                            <h4>Login Details:</h4>
                            <div class="form">
                                <?php echo form_open(DATAOWNER_ID . '/user/change_password/edit/' . $rID); ?>
                                <?php if (isset($view_setup['message'])) echo $view_setup['message']; ?>
                                <?php display_field($fields['Username'], array('extraHTMLInput' => 'disabled="disabled"')); ?>
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
                            <?php if( isset($show_user_table) ) include('v_user_edit/all_users_table.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>