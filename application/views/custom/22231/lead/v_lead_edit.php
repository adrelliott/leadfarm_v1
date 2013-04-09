<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Create An Action</a></h2></li>
                    <li><h2><a href="#tab-2">Products</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Create/edit an Opportunity for this contact</h3>
                        <div class="form">
                            <?php echo form_open( "/lead/add/edit/$rID/$ContactId", 'class="ajax"') ; ?>
                                <?php echo display_field($fields['OpportunityTitle']); ?>
                                <?php echo display_field($fields['ContactID'], array('type'=> 'hidden', 'value' => $ContactId)); ?>
                                <?php echo display_field($fields['__LeadType'] ); ?>
                                <?php echo display_field($fields['OpportunityNotes']); ?>
                                <?php echo display_field($fields['UserID'], array('options' => $dropdowns['users'])); ?>     
                            <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-2"><!-- Start of tab 1 -->
                        <h3>What is this contact interested in?</h3>
                        <div class="form">
                            <?php foreach ( $tables['products']['table_data'] as $k => $array ) : ?>
                            <p>The product is <?php echo $array['ProductName']; ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 