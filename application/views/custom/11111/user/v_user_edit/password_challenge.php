<?php echo form_open('/user/password_challenge/edit_modal/' . $rID); ?>
<?php if (isset($view_setup['message'])) echo $view_setup['message']; ?>
<div class="clearfix" id="">
    <label class="" id="">Enter your password</label>
    <div class="input">
        <input class="" type="password" name="Password">
    </div>
</div>
<?php echo form_hidden('Id', $view_setup['user_data']['Id']); ?>
<div class="clearfix">
    <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
</div>
<?php echo form_close(); ?>