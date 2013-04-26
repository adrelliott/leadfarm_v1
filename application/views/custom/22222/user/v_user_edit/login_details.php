<?php if ( ! empty($view_setup['message']) ) echo $view_setup['message']; ?>
<h3 class="index toggle_icon" id="option1_toggle">Edit login Details</h3>
<div class="widget_inside <?php if ($rID != 'new' && strpos($view_setup['message'],'done') ) echo 'hide_toggle'; ?>" id="option1" >
    strpos result  = <?php if (strpos($view_setup['message'],'done')) echo 'true'; else echo 'false'; ?>
    <div class="form">
        <?php echo form_open('/user/edit_login/edit_modal/' . $rID . '/' . $rID); ?>
        <?php if ($rID == 'new') display_field($fields['Username'], array('value' => set_value('Username'))); 
        else display_field($fields['Username'], array('name' => '_:_username', 'extraHTMLInput' => ' autocomplete="off" title="You cannot change your username" rel="tooltips" readonly="true"')); ?>
        <div class="clearfix" id="">
            <label class="" id="">Your new Password:</label>
            <div class="input">
                <input class="" type="password" name="Password" autocomplete="off"  value="">
            </div>
        </div>
        <div class="clearfix" id="">
            <label class="" id="">Your new Password Again:</label>
            <div class="input">
                <input class="" type="password" name="___Passconf" autocomplete="off" value="">
            </div>
        </div>
        <div class="clearfix">
            <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div class="widget_inside <?php if ($rID == 'new') echo 'hide_toggle'; ?>">
    <div class="form">
        <?php echo form_open('/user/add/edit_modal/' . $rID . '/' . $rID); ?>
        <?php display_field($fields['Title']); ?>
        <?php display_field($fields['FirstName']); ?>
        <?php display_field($fields['LastName']); ?>
        <?php display_field($fields['_AdminLevel']); ?>
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
            <div class="form">
                <?php display_field($fields['_OptinEmailYN']); ?>
                <?php display_field($fields['_OptinSmsYN']); ?>
                <?php display_field($fields['_OptinSurfaceMailYN']); ?>
                <?php display_field($fields['_OptinNewsletterYN']); ?>
                <?php display_field($fields['_OptinPref']); ?>
                <div class="clearfix">
                    <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>