<?php

//$saved_searches = array('0' => 'Everyone who has opted into emails',);
$saved_searches = array();
$dropdown = $this->data['view_setup']['tables']['get_all_saved_searches']['table_data'];
foreach ($dropdown as $k => $array)
{
    $saved_searches[$array['Id']] = $array['Name'];
}

?>

<h3 class="index toggle_icon">Step 1: Choose Recipients...</h3>

<div class="widget_inside" id="">
    <div class="form">
        <?php echo form_open(site_url('broadcast/add/edit/' . $view_setup['rID'] . '/2')); ?>
        <div class="clearfix">
            <label>What's this broadcast called?</label>
            <div class="input">
               <?php echo form_input('BroadcastName', element('value', $fields['BroadcastName'], ''), 'class="large" rel="tooltip" title="E.g. Email Update of Latest match" '); ?>
            </div>
        </div>
        <div class="clearfix">
            <label>Who's getting this email?</label>
            <div class="input">
               <?php echo form_dropdown('SavedSearchId', $saved_searches, element('value', $fields['SavedSearchId'], ''), 'class="large" rel="tooltip" title="Choose a Saved Search" '); ?>
            </div>
        </div>
        <div class="clearfix">
            <a href="<?php echo site_url('/search_page'); ?>" target="_blank" class="grey button left"><span>Create A New Search</span></a>
             <input name='submit' type='submit' class='button red right large' value='Save'></input>
        </div>
    </div>
    

    <?php echo form_close(); ?>

</div>
