<h3 class="index toggle_icon" id="option1_toggle">Step 1 - Choose Recipients</h3>
<div class="widget_inside hide_toggle" id="option1">
    <?php
    if (isset($tables['recipients']['table_data']))
        include('recipients_table.php');
    else
        include('search_form.php');
    ?>
</div>

<div class="clearfix margin_top_15"></div>
<h3 class="index toggle_icon" id="option2_toggle">Step 2 - Write the Email</h3>
<div class="widget_inside hide_toggle" id="option2">
    <div class="form">
        <?php echo form_open('broadcast/add/edit/' . $view_setup['rID']); ?>
        <div class="clearfix">
            <label>From (Name & Email)</label>
            <div class="input">
                <?php echo form_input('From_name', element('value', $fields['From_name'], ''), 'class="large" rel="tooltip" title="Who is the email from?" '); ?>
                <?php echo form_input('From_email', element('value', $fields['From_email'], ''), 'class="large" rel="tooltip" title="What Email address does it come from?" '); ?>
            </div>
        </div>
        <div class="clearfix">
            <label>Subject Line</label>
            <div class="input">
                <?php echo form_input('Subject', element('value', $fields['Subject'], ''), 'class="xxxlarge" '); ?>
            </div>
        </div>
        <div class="clearfix">
            <label>Load a Template?</label>
            <div class="input">
                <?php
                $options = array('FC_Red' => 'FC Utd red');
                echo form_dropdown('PA_TemplateName', $options, 'FC_Red');
                ?>
            </div>
        </div>
        <div class="clearfix">
            <div class="input">
<?php echo form_textarea('Content', element('value', $fields['Content'], ''), 'rows ="40" class=" xxxxlarge" Id="write_email"'); ?>
                <?php echo display_ckeditor($ckeditor); ?>
            </div>
        </div>
        <div class="clearfix grey-highlight">
            <div class="input no-label">
<?php echo form_submit('submit', 'Save Email', 'class="button blue"'); ?>
            </div>
        </div>
<?php echo form_close(); ?>
    </div>
</div>
<div class="clearfix margin_top_15"></div>
<h3 class="index toggle_icon" id="option3_toggle">Step 3 - Send the Email</h3>
<div class="widget_inside" id="option3">
    <H3>Either send a test email or send for real. (<a href="#" target="_blank">Preview email</a>)</h3>
    <div class="form">
        <?php //echo form_open('broadcast/send/test/' . $view_setup['rID']); ?>
        <div class="clearfix">
            <label>First Name of Recipient</label>
            <div class="input">
                <?php echo form_input('FirstName', '', 'title="Write recipient\'s first name here" rel="tooltips" class="xlarge" '); ?>
            </div>
        </div>
        <div class="clearfix">
            <label>Email of Recipient</label>
            <div class="input">
                <?php echo form_input('Email', '', 'title="Email address - name@domain.com" rel="tooltips"'); ?>
            </div>
        </div>
        <div class="clearfix">
            <div class="input no-label">
                <?php echo form_submit('submit', 'Send Test Email', 'class="button blue right"'); ?>
            </div>
        </div>
        <?php //echo form_close(); ?>
    </div>
    
</div>


<div class="clearfix">
    <a href="<?php echo base_url('/broadcast/advance_step/2/edit/' . $view_setup['rID']); ?>" class="button large red left">
        Back to Step 2...
    </a>

</div>
<div class="clearfix">
    <a href="<?php echo base_url('broadcast/send/actual/' . $view_setup['rID']); ?>" class="button large green right">
        Send this Broadcast Now
    </a>

</div>