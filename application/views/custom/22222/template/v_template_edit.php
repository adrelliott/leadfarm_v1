<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Edit/Create a Template</h2>
            <div class="widget_inside">
                <div class="form">
                    <?php echo form_open(DATAOWNER_ID . "/template/add/edit/$rID") ; ?>
                        <?php echo display_field($fields['__Id']); ?>
                        <?php echo display_field($fields['__Name']); ?>
                        <?php echo display_field($fields['__FromEmail']); ?>
                        <?php echo display_field($fields['__FromName']); ?>
                        <?php echo display_field($fields['__Subject']); ?>
                        <?php echo display_field($fields['__TemplateName']); ?>
                        <?php echo display_field($fields['__Content']); ?>
                        <div class="clearfix">
                            <input name='submit' type='submit' class='button blue right large ' style='float:right' value='Save'></input>
                        </div>                            
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>