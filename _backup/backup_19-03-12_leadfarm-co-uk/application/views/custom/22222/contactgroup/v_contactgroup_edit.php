<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Edit/Create a Tag</h2>
            <div class="widget_inside">
                <h3>Create/edit a Task for this contact</h3>
                <div class="form">
                    <?php echo form_open(DATAOWNER_ID . "/contactgroup/add/edit/$rID") ; ?>
                        <?php //echo display_field($fields['Id']); ?>
                        <?php echo display_field($fields['GroupName']); ?>
                        <?php echo display_field($fields['GroupDescription']); ?> 
                        <div class="clearfix">
                            <input name='submit' type='submit' class='button blue right large ' style='float:right' value='Save'></input>
                        </div>                            
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>