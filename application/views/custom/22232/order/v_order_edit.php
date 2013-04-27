<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Add a Purchase</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Create/edit a Purchase for this contact</h3>
                        <div class="form">
                            <?php echo form_open( "/order/add/edit/$rID/$ContactId") ; ?>
                                <?php echo display_field($fields['DateCreated']); ?>
                                <?php echo display_field(
                                        $fields['_ItemBought'], 
                                        array('options' => array(
                                            '--- Membership/Season Tickets ---' => 'no2',
                                            'Adult Membership' => 'Adult Membership', 
                                            'Junior Membership' => 'Junior Membership', 
                                            'Season Ticket (Adult)' => 'Season Ticket (Adult)', 
                                            'Season Ticket (Junior)' => 'Season Ticket (Junior) ', 
                                            'Community Shares' => 'Community Shares',
                                            '--- Draws & Raffles ---' => 'no4',
                                            'TreasureLine' => 'TreasureLine', 
                                            'Holiday Draw' => 'Holiday Draw',
                                            '--- Sponsorship ---'  => 'no6',
                                            '127' => '127',
                                            'Match Sponsor' => 'Match Sponsor',
                                            'Matchball Sponsor' => 'Matchball Sponsor',
                                            'Matchday Programme Sponsor' => 'Matchday Programme Sponsor',
                                            'Programme Adverts' => 'Programme Adverts',
                                            'Pitchside Hording' => 'Pitchside Hording',
                                            'Pink Sponsorship' => 'Pink Sponsorship',
                                            'Newsletter Sponsor' => 'Newsletter Sponsor',
                                            'Community Sponsor' => 'Community Sponsor',
                                            'Youth Team Sponsor' => 'Youth Team Sponsor',
                                            'Women Team Sponsor' => 'Women Team Sponsor',
                                            'Player Sponsor' => 'Player Sponsor',
                                            '--- Others ---' => 'no8',
                                            'Club Donations' => 'Club Donations', 
                                            'DF Donations' => 'DF Donations', 
                                            'Club Events' => 'Club Events', 
                                            'Merchanidise' => 'Merchanidise', 
                                            'Away Match Travel' => 'Away Match Travel', 
                                            ))); ?>
                                <?php echo display_field($fields['_ValidUntil']); ?>
                                <?php echo display_field($fields['TotalPrice_A']); ?>
                                <?php echo display_field($fields['PaymentMethod']); ?>
                                <?php echo display_field($fields['Source']); ?>
                                <?php echo display_field($fields['OrderNotes']); ?> 
                                <?php echo display_field($fields['OrderTitle'], array('value' => 'Other')); ?> 
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button red right large' style='float:right' value='Save'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 