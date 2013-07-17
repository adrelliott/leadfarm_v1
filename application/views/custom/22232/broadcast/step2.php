<?php
$options = array(
    '' => 'None',
    'FC_Red' => 'FC Utd red',
    'FC_Pink' => 'FC Utd Pink',
    'FC_Black' => 'FC Utd Black'
);
$from_email = array(
    'al@fc-utd.co.uk' => 'al@FC-Utd.co.uk',
    'paul@fc-utd.co.uk' => 'paul@FC-Utd.co.uk',
    'no-reply@fc-utd.co.uk' => 'no-reply@FC-Utd.co.uk',
);
?>
<div class="clearfix margin_top_15"></div>
<h3 class="index toggle_icon">Step 2 - Write the Email</h3>
<div class="widget_inside" id="">
    <div class="form">
        <?php echo form_open('broadcast/add/edit/' . $view_setup['rID'] . '/2'); ?>
        <div class="clearfix">
            <input name='submit' type='submit' class='button red right ' value='Save email'></input>
        </div>
        <?php echo element('message', $view_setup, '');?>
        <div class="clearfix">
            <label>Template to use</label>
            <div class="input">
                <?php echo form_dropdown('PA_TemplateName', $options, element('value', $fields['PA_TemplateName'], ''), 'class="large" rel="tooltip" title="Who is the email from?" '); ?>
            </div>
        </div>
        <div class="clearfix">
            <label>From (Name & Email)</label>
            <div class="input">
                <?php echo form_input('From_name', element('value', $fields['From_name'], ''), 'class="large" rel="tooltip" title="Who is the email from?" '); ?>
                <?php echo form_dropdown('From_email', $from_email, element('value', $fields['From_email'], ''), 'class="large" rel="tooltip" title="What Email address does it come from?" '); ?>
            </div>
        </div>
        <div class="clearfix">
            <label>Subject Line</label>
            <div class="input">
                <?php echo form_input('Subject', element('value', $fields['Subject'], ''), 'class="xxxlarge" '); ?>
            </div>
        </div>
        <div class="clearfix">
            <div class="input">
                <?php //echo form_textarea('Content', element('value', $fields['Content'], ''), 'rows ="40" class="cleditor xxxxlarge"'); ?>
                <?php echo form_textarea('Content', element('value', $fields['Content'], ''), 'rows ="40" cols="100" class=" xxlarge mceEditor" '); ?>
                <?php //echo display_ckeditor($ckeditor); ?>
            </div>
        </div>
        <div class="clearfix">
            <input name='submit' type='submit' class='button red right large' value='Save Email'></input>
        </div>
        <?php echo form_close(); ?>
    </div>
    <h3 class="index toggle_icon margin_top_45" id="option3_toggle">Step 3 - Send the Email</h3>

    <div class="widget_inside hidden" id="option3">
        <H3>Either send a test email or send for real.</h3>
        <div class="form">
            <?php echo form_open('broadcast/send/test/edit/' . $view_setup['rID']); ?>
            <div class="clearfix">
                <label>First Name of Recipient</label>
                <div class="input">
                    <?php echo form_input('FirstName', '', 'title="Write recipient\'s first name here" rel="tooltips" class="xlarge" '); ?>
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
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
    <div class="clearfix margin_top_15">
        <a href="<?php echo base_url('/broadcast/view/edit/' . $view_setup['rID'] . '/1'); ?>" class="button   left">
            << Choose Recipients...
        </a>
        <a href="<?php echo base_url('/broadcast/send/actual/edit/' . $view_setup['rID']); ?>" class="button   red large right">
            Send the Broadcast!
        </a>
    </div>

</div>

<script type="text/javascript">
tinymce.init({
   selector: "textarea.mceEditor",
   width: "740",
    height: "800",
    plugins : ' autolink autosave link image lists paste preview fullscreen'
});
</script>

<?php print_array($this->data); ?>