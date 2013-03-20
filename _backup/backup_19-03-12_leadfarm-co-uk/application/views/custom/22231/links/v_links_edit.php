<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Edit/Create an Automation Link</h2>
            <div class="widget_inside">
                <h3>Choose a sequence to start when a user clicks on a link</h3>
                <div class="form">
                    <?php echo form_open(DATAOWNER_ID . "/links/add/edit/$rID") ; ?>
                        <?php //echo display_field($fields['__Id']); ?>
                        <?php echo display_field($fields['__LinkName']); ?>
                        <?php echo display_field($fields['__LinkDescription']); ?>
                        <?php echo display_field($fields['__SequenceId'], array('options' => $this->data['view_setup']['dropdowns']['campaign_dropdown'])); ?>
                        <?php echo display_field($fields['__DestinationURL']); ?>
                        <div class="clearfix">
                            <input name='submit' type='submit' class='button blue right large ' style='float:right' value='Save'></input>
                        </div>                            
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>