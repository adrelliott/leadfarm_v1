<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Membership/ST</a></h2></li>
                    <li><h2><a href="#tab-2">Draws/Raffles</a></h2></li>
                    <li><h2><a href="#tab-3">Sponsorship</a></h2></li>
                    <li><h2><a href="#tab-4">Other</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Create/edit a Purchase for this contact</h3>
                        <div class="form">
                            <?php echo form_open( "/order/add/edit/$rID/$ContactId", 'class="ajax"' ) ; ?>
                                <?php echo display_field(
                                        $fields['_ItemBought'], 
                                        array('options' => array(
                                            'Adult Membership' => 'Adult Membership', 
                                            'Junior Membership' => 'Junior Membership', 
                                            'Season Ticket Holder' => 'Season Ticket Holder', 
                                            'Community Shares' => 'Community Shares')
                                            )); ?>
                                <?php echo display_field($fields['TotalPrice_A']); ?>
                                <?php echo display_field($fields['_ValidUntil']); ?>
                                <?php echo display_field($fields['OrderNotes']); ?> 
                                <?php echo display_field($fields['OrderTitle'], array('value' => 'Membership')); ?> 
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-2"><!-- Start of tab 1 -->
                        <h3>Create/edit a Purchase for this contact</h3>
                        <div class="form">
                            <?php echo form_open( "/order/add/edit/$rID/$ContactId", 'class="ajax"' ) ; ?>
                                <?php echo display_field(
                                        $fields['_ItemBought'], 
                                        array('options' => array(
                                            'TreasureLine' => 'TreasureLine', 
                                            'Holiday Draw' => 'Holiday Draw',
                                            ))); ?>
                                <?php echo display_field($fields['TotalPrice_A']); ?>
                                <?php echo display_field($fields['_ValidUntil']); ?>
                                <?php echo display_field($fields['OrderNotes']); ?> 
                                <?php echo display_field($fields['OrderTitle'], array('value' => 'Draws/Raffles')); ?> 
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-3"><!-- Start of tab 1 -->
                        <h3>Create/edit a Purchase for this contact</h3>
                        <div class="form">
                            <?php echo form_open( "/order/add/edit/$rID/$ContactId", 'class="ajax"' ) ; ?>
                                <?php echo display_field(
                                        $fields['_ItemBought'], 
                                        array('options' => array(
                                            '127' => '127',
                                            'Match Sponsor' => 'Match Sponsor',
                                            'Matchday Programme Sponsor' => 'Matchday Programme Sponsor',
                                            'Programme Adverts' => 'Programme Adverts',
                                            'Pitchside Hording' => 'Pitchside Hording',
                                            'Newsletter Sponsor' => 'Newsletter Sponsor',
                                            'Community Sponsor' => 'Community Sponsor',
                                            'Youth Team Sponsor' => 'Youth Team Sponsor',
                                            'Women Team Sponsor' => 'Women Team Sponsor',
                                            'Player Sponsor' => 'Player Sponsor',
                                            ))); ?>
                                <?php echo display_field($fields['TotalPrice_A']); ?>
                                <?php echo display_field($fields['_ValidUntil']); ?>
                                <?php echo display_field($fields['OrderNotes']); ?> 
                                <?php echo display_field($fields['OrderTitle'], array('value' => 'Sponsorship')); ?> 
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-4"><!-- Start of tab 1 -->
                        <h3>Create/edit a Purchase for this contact</h3>
                        <div class="form">
                            <?php echo form_open( "/order/add/edit/$rID/$ContactId", 'class="ajax"' ) ; ?>
                                <?php echo display_field(
                                        $fields['_ItemBought'], 
                                        array('options' => array(
                                            'Club Donations' => 'Club Donations', 
                                            'DF Donations' => 'DF Donations', 
                                            'Club Events' => 'Club Events', 
                                            'Merchanidise' => 'Merchanidise', 
                                            'Away Match Travel' => 'Away Match Travel', 
                                            ))); ?>
                                <?php echo display_field($fields['TotalPrice_A']); ?>
                                <?php echo display_field($fields['_ValidUntil']); ?>
                                <?php echo display_field($fields['OrderNotes']); ?> 
                                <?php echo display_field($fields['OrderTitle'], array('value' => 'Other')); ?> 
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 
        