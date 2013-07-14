<?php 
$options = array(
    'FC_Red' => 'FC Utd red',
    'FC_Pink' => 'FC Utd Pink'
    );
?>
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
<div class="widget_inside" id="option2">
    <div class="form">
        <div class="clearfix">
            <label>Load a Template?</label>
            <div class="input">
                <?php
                    echo form_open(site_url('broadcast/load_template/edit/' . $view_setup['rID']));
                        echo form_dropdown('PA_TemplateName', $options, 'FC_Red');
                        echo form_submit('Load Template');
                    echo form_close();
                ?>
            </div>
        </div>
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
            <div class="input">
                <?php //echo form_textarea('Content', element('value', $fields['Content'], ''), 'rows ="40" class="cleditor xxxxlarge"'); ?>
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


    <div class="clearfix margin_top_15">
        <a href="<?php echo base_url('/broadcast/advance_step/1/edit/' . $view_setup['rID']); ?>" class="button large red left">
            Back to Step 1...
        </a>
        <a href="<?php echo base_url('/broadcast/advance_step/3/edit/' . $view_setup['rID']); ?>" class="button large red right">
            Go to Step 3...
        </a>
    </div>
</div>

<div class="clearfix margin_top_15"></div>
<h3 class="index toggle_icon" id="option3_toggle">Step 3 - Send the Email</h3>