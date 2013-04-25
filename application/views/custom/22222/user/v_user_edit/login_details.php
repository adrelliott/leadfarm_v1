<h3 class="index toggle_icon" id="option1_toggle">Edit login Details</h3>
<div class="widget_inside " id="option1" >
    <h4>Create/Edit your username & password here</h4>
    <div class="form">
        <?php echo form_open('/user/change_password/edit/' . $rID); ?>
        <?php if (isset($view_setup['message'])) echo $view_setup['message']; ?>
        <?php display_field($fields['Username'], array('label' => 'Your Username:')); ?>
        <div class="clearfix" id="">
            <label class="" id="">Your new Password:</label>
            <div class="input">
                <input class="" type="password" name="New_Password">
            </div>
        </div>
        <div class="clearfix" id="">
            <label class="" id="">Your new Password Again:</label>
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