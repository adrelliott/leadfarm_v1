<h3 class="index toggle_icon margin_top_45" id="option3_toggle">Step 3 - Send the Email</h3>
<H3>Either send a test email or send for real.</h3>
<div class="form">
    <?php echo form_open('broadcast/send/test/edit/' . $view_setup['rID']); ?>
    <div class="clearfix">
        <label>First Name of Recipient (for mailmerge - optional)</label>
        <div class="input">
            <?php echo form_input('FirstName', '', 'title="Write recipient\'s first name here" rel="tooltips" class="xlarge" '); ?>
        </div>
    </div>
    <div class="clearfix">
        <label>Last Name of Recipient (for mailmerge - optional)</label>
        <div class="input">
            <?php echo form_input('LastName', element('LastName', $user_data, ''), 'title="Write recipient\'s last name here" rel="tooltips" class="xlarge" '); ?>
        </div>
    </div>
    <div class="clearfix">
        <label>Nickname of Recipient (for mailmerge - optional)</label>
        <div class="input">
            <?php echo form_input('Nickname', '', 'title="Write recipient\'s nickname here" rel="tooltips" class="xlarge" '); ?>
        </div>
    </div>
    <div class="clearfix">
        <label>Email of Recipient</label>
        <div class="input">
            <?php echo form_input('Email', '', 'title="Email address - name@domain.com" rel="tooltips"  class="xxxlarge"'); ?>
        </div>
    </div>
    <div class="clearfix">
        <?php echo form_submit('submit', 'Send Test Email', 'class="button blue right"'); ?>
        <a href="<?php echo base_url('/broadcast/send/actual/edit/' . $view_setup['rID']); ?>" class="button   red large left">
            Send the Broadcast now!
        </a>
    </div>
    <?php echo form_close(); ?>
</div>