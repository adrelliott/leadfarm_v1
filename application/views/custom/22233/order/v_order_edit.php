<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Add a Purchase</a></h2></li>
                    <li><h2><a href="#tab-2">Add a Purchase</a></h2></li>
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
                     <div id="tab-2"><!-- Start of tab 2 -->
                         <?php echo form_open( "/order/add/edit/$rID/$ContactId", 'class="ajax"' ) ; ?>
                         <div class="page-header">
                             <div id="alert"></div>
                            <div class="span6 left">
                                <h4>FirstName LastName</h4>
                                <p>Address 1</p>
                                <p>Address 2</p>
                                <p>Address 3</p>
                                <p>City, Postcode, Countrynamelong</p>
                            </div>
                            <div class="span5 right last">
                                <p><?php echo form_label('Shipping Method & Cost:'); ?> <?php echo form_dropdown('name', array('Fed-Ex' => 'Fed-Ex', 'Royal Mail' => 'Royal mail')); ?></p>
                                <p>Cost of Shipping: <?php echo form_input('name', 'val'); ?></p>
                                <p>Sage invoice Number: <?php echo form_input('name', 'val', 'class="small" '); ?>(Order Id: 23232)</p>
                                <p>Payment Method: <?php echo form_dropdown('name', array('Cash' => 'Cash', 'Invoice' => 'Invoice')); ?></p>
                                <p>Date of Order: <?php echo form_input('name', 'val'); ?></p>
                            </div>
                         </div>
                         <div class="row-fluid">
                             <form id="itemsForm">

                                 <table class="table table-striped" id="itemsTable">
                                     <thead>
                                         <tr>
                                             <th></th>
                                             <th>Item Code</th>
                                             <th>Description</th>
                                             <th>Qty</th>
                                             <th>Net Price</th>
                                             <th>VAT</th>
                                             <th>Total</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr class="item-row">
                                             <td></td>
                                             <td><input type="text" name="itemCode[]" value="" class="input-mini mini" id="itemCode"
                                                        tabindex="1"/>
                                             </td>
                                             <td><input type="text" name="itemDesc[]" value="" class="input-large xlarge" id="itemDesc"
                                                        readonly="readonly"/></td>
                                             <td><input type="text" name="itemQty[]" value="" class="input-mini  mini" id="itemQty" tabindex="2"/>
                                             </td>
                                             <td>
                                                 <div class="input-prepend input-append"><span class="add-on">£ </span><input
                                                         name="itemPrice[]"
                                                         class=" input-small small"
                                                         id="itemPrice"
                                                         type="text"></div>
                                             </td>
                                             <td>
                                                 <input name="vatRate[]" id="vatRate" type="hidden">
                                                 <div class="input-prepend input-append"><span class="add-on">£ </span><input
                                                         name="itemVatTotal[]"
                                                         class=" input-small small"
                                                         id="itemVatTotal"
                                                         type="text" readonly="readonly"></div>
                                             </td>
                                             <td>
                                                 <div class="input-prepend input-append"><span class="add-on">£ </span><input
                                                         name="itemLineTotal[]" class="small input-small" id="itemLineTotal" type="text"
                                                         readonly="readonly"></div>
                                                 
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>

                             </form>

                             <a href="#" id="addRow" class="btn btn-primary"><i class="icon-plus icon-white"></i> Add Item</a>

                             <hr class="">

                         </div>


                         <div class="row">
                             <div>
                                 <div class="alert alert-info"> </div>
                             </div>
                             <div class="col_7 ">
                                 order notes
                             </div>
                             <div class="col_5 last ">
                                 <table id="grand_totals">
                                     <thead>
                                         <tr>
                                             <th></th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <tr>
                                             <td>
                                                 <span>Net Price</span>
                                                <?php echo form_input('TotalPrice_A', '', 'id="invSubTotal" class="subtotal"  readonly="readonly"'); ?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                <span>Total VAT</span>
                                                <?php echo form_input('totalVat', '', 'id="invTotalVat" class="subtotal"  readonly="readonly"'); ?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <span>Postage & packing:</span>
                                                 <?php echo form_input('postage', '', 'id="invPostage" class="subtotal" '); ?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                <span>Discount</span>
                                                <?php echo form_input('discount', '', 'id="invDiscount" 
                                                    class="subtotal" '); ?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                <span>Total invoice</span>
                                                <?php echo form_input('total', '', 'id="invGrandTotal" class=""  readonly="readonly"'); ?>
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>
                             </div>
                         </div>
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

<?php 
/*
 var rowTemp = [
           '<tr class = "item-row">',
            '<td><i id="deleteRow" class="icon-remove"></i></td>',
                '<td><input type="text" name="itemCode[]" value="" class="input-mini mini" id="itemCode" tabindex="1" /></td>',
                '<td><input type="text" name="itemDesc[]" value="" class="input-large xlarge" id="itemDesc" readonly="readonly" /> </td>',
                '<td> <input type="text" name="itemQty[]" value="" class="input-mini  mini" id="itemQty" tabindex="2" /></td>',
                '<td><div class="input-prepend input-append"> <span class="add-on"> £ </span><input name="itemPrice[]" class="input-small small" id="itemPrice" type="text"> </div></td>',
                
                '<td><div class="input-prepend input-append"> <span class="add-on"> £ </span><input name="itemVat[]" class="input-small small" id="itemVat" type="text"> </div></td>',
                '<td ><div class="input-prepend input-append"> <span class="add-on"> £ </span><input name="itemLineTotal[]" class="small input-small" id="itemLineTotal" type="text" readonly="readonly" > </div></td>',
                '</tr>'
       ].join('');
 * 
 */