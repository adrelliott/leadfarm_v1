<div class="col_12"><!-- Start Column 1-->
    <div class="row clearfix">
        <div class="row"><!-- Tabs begin -->
            <div class="widget clearfix tabs">
                <ul>
                    <li>
                        <h2><a href="#tab-1">Users</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <h4>Add New user</h4>
                            <div class="form">
                                <?php echo form_open(DATAOWNER_ID . '/user/add/edit/' . $rID ); ?>
                                <?php display_field($fields['Title']); ?>
                                <?php display_field($fields['FirstName']); ?>
                                <?php display_field($fields['LastName']); ?>
                                <?php display_field($fields['Nickname']); ?>
                                <?php display_field($fields['Username']); ?>
                                <?php display_field($fields['Password'], array('type' => 'password')); ?>
                                <?php display_field($fields['Email']); ?>
                                <?php display_field($fields['Phone1']); ?>
                                <?php //display_field($fields['_Signature']); ?>
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
                </div>
            </div>
        </div>        
    </div>
</div>