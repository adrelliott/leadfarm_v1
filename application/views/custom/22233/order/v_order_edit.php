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
                            <?php echo form_open( "/order/add/edit/$rID/$ContactId", 'class="ajax"' ) ; ?>
                                <?php echo display_field($fields['DateCreated']); ?>
                                <?php echo display_field(
                                        $fields['_ItemBought'], 
                                        array('options' => array(
                                            '--- BOOKS ---' => 'no1',
                                            'Childhood Days' => 'Childhood Days',
                                            'The Countryside' => 'The Countryside',
                                            'Women’s Work' => 'Women’s Work',
                                            'A Funny Old World' => 'A Funny Old World',
                                            'Beside the Seaside' => 'Beside the Seaside',
                                            'A Sporting Life' => 'A Sporting Life',
                                            'In The Garden' => 'In The Garden',
                                            'Pets' => 'Pets',
                                            'Shopping' => 'Shopping',
                                            'Travelling' => 'Travelling',
                                            'Family Life' => 'Family Life',
                                            'A World of Work' => 'A World of Work',
                                            'Proverbs and Sayings' => 'Proverbs and Sayings',
                                            '--- DVDs ---' => 'no2',
                                            'Childhood Days' => 'Childhood Days',
                                            'World of Work' => 'World of Work',
                                            'Twin Pack' => 'Twin Pack',
                                            '--- PICTURES FOR WALLS ---' => 'no3',
                                            '001' => '001',
                                            '002' => '002',
                                            '003' => '003',
                                            '004' => '004',
                                            '005' => '005',
                                            '006' => '006',
                                            '007' => '007',
                                            '008' => '008',
                                            '009' => '009',
                                            '010' => '010',
                                            'and so on' => 1,
                                            ))); ?>
                                <?php echo display_field($fields['TotalPrice_A']); ?>
                                <?php echo display_field($fields['PaymentMethod']); ?>
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