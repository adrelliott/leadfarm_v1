<?php
$options = array(
    '' => 'None',
    'FC_Red' => 'FC Utd Red',
    'FC_White' => 'FC Utd White',
    'FC_Pink' => 'FC Utd Pink',
    'FC_Black' => 'FC Utd Black'
);
$from_email = array(
    //'al@fc-utd.co.uk' => 'al@FC-Utd.co.uk',
   // 'paul@fc-utd.co.uk' => 'paul@FC-Utd.co.uk',
    'no-reply@fc-utd.co.uk' => 'no-reply@FC-Utd.co.uk',
);
?>
<div class="clearfix margin_top_15"></div>
<h3 class="index toggle_icon">Step 2 - Write the Email</h3>
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
                <h4>Don't forget: include a subject line to send a test email</h4>
            </div>
        </div>
        <div class="clearfix">
            <div class="input">
                <?php //echo form_textarea('Content', element('value', $fields['Content'], ''), 'rows ="40" class="cleditor xxxxlarge"'); ?>
                <span class="notification information clearfix"><h4>Personalisation of Emails:</h4>Use {{firstname}}, {{lastname}} or {{nickname}}</span>
                <?php echo form_textarea('Content', element('value', $fields['Content'], ''), 'rows ="40" cols="100" class=" xxlarge mceEditor" '); ?>
                <?php //echo display_ckeditor($ckeditor); ?>
            </div>
        </div>
        <div class="clearfix">
            <input name='submit' type='submit' class='button red right large' value='Save Email'></input>
        </div>
        <?php echo form_close(); ?>
    </div>
    


<script type="text/javascript">
tinymce.init({
   selector: "textarea.mceEditor",
   width: "840",
    height: "300",
    plugins : ' autolink autosave link image lists paste preview fullscreen'
});
</script>

<?php //ßprint_array($this->data); ?>