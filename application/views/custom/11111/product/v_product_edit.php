<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Edit/Create A Product</h2>
            <div class="widget_inside">
                <div class="form">
                    <?php echo form_open( "product/add/edit/$rID", 'class="ajax"' ) ; ?>
                        <?php //echo display_field($fields['__Id']); ?>
                        <?php echo display_field($fields['Id']); ?>
                        <?php echo display_field($fields['ItemType']); ?>
                        <?php echo display_field($fields['ProductName']); ?>
                        <?php echo display_field($fields['ShortDescription']); ?>
                        <?php //echo display_field($fields['ProductPrice'], array('options' => $this->data['view_setup']['dropdowns']['campaign_dropdown'])); ?>
                        <?php echo display_field($fields['ProductPrice']); ?>
                        <div class="clearfix">
                            <input name='submit' type='submit' class='button blue right large ' style='float:right' value='Save'></input>
                        </div>                            
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>