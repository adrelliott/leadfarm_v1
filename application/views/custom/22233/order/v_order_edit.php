<?php 
$contact_info = $this->data['view_setup']['tables']['contact_info']['table_data'];
$order_info = $this->data['view_setup']['fields'];
$payment_options = array('Cash' => 'Cash', 'Invoice' => 'Invoice');
$shipping_options = array(
    'Royal Mail' => 'Royal Mail',
    'DPD' => 'DPD',
    'UPS' => 'UPS',
);
$shipping_info = array();
foreach ($this->data['view_setup']['fields'] as $field => $array)
    $shipping_info[$field] = $array['value'];
 ?>
<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Add a Purchase</a></h2></li>
                    <li><h2><a href="#tab-2" >Add a Purchase</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                       
                    </div>
                     <div id="tab-2"><!-- Start of tab 2 -->
                         <?php echo form_open( "/order/add_order/edit/$rID/$ContactId" ) ; ?>
                         <div class="page-header">
                             <div id="alert"></div>
                            <div class="span6 left">
                                <h4>Enter Shipping Info</h4>
                                    <?php 
                                    echo form_input('ShipFirstName', element('ShipFirstName', $shipping_info, $contact_info['FirstName']));
                                    echo form_input('ShipLastName', element('ShipLastName', $shipping_info, $contact_info['LastName'])); 
                                    ?><br />
                                        <?php echo form_input('ShipStreet1', element('ShipStreet1', $shipping_info, $contact_info['StreetAddress1']), "class='xxlarge'");?><br />
                                <?php echo form_input('ShipStreet2', element('ShipStreet2', $shipping_info, $contact_info['StreetAddress2']), "class='xxlarge'");?><br />
                                <?php echo form_input('_ShipStreet3', element('_ShipStreet3', $shipping_info, $contact_info['_StreetAddress3']));?>, <?php echo form_input('ShipCity', element('ShipCity', $shipping_info, $contact_info['City']));?><br />
                               <?php echo form_input('ShipState', element('ShipState', $shipping_info, $contact_info['State']));?>, <?php echo form_input('ShipZip', element('ShipZip', $shipping_info, $contact_info['PostalCode']));?><br />
                                <p><?php echo form_input('ShipCountry', element('ShipCountry', $shipping_info, $contact_info['Country']));?></p>
                            </div>
                            <div class="span5 right last">
                                <p><?php echo form_label('Shipping Method & Cost:'); ?> <?php echo form_dropdown('_ShippingMethod', $shipping_options, element('_ShippingMethod', $shipping_info, '')); ?></p>
                                <p>Cost of Shipping: £<?php echo form_input('_CostOfShipping', element('_CostOfShipping', $shipping_info, ''), "class='small'"); ?></p>
                                <p>Sage invoice Number: <?php echo form_input('_LegacyOrderId', element('_LegacyOrderId', $shipping_info, ''), 'class="small" '); ?>(Order Id: 23232)</p>
                                <p>Payment Method: <?php echo form_dropdown('PaymentMethod', $payment_options, element('PaymentMethod', $shipping_info, '')); ?></p>
                                <p>Date of Order: <?php echo form_input('DateCreated', element('DateCreated', $shipping_info, ''), "class='datepicker mask_date small' "); ?></p>
                            </div>
                         </div>
                         <div class="row-fluid">
                             <form id="itemsForm">

                                 <table class="table table-striped" id="itemsTable" data-source="http://localhost:8888/projects/leadfarm_v1/public_html/product/ajax_products">
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
                                             <td><input type="text" name="orderItem_ProductId[]" value="" class="input-mini mini" id="itemCode"
                                                        tabindex="1"/>
                                             </td>
                                             <td><input type="text" name="orderItem_ItemName[]" value="" class="input-large xlarge" id="itemDesc"
                                                        readonly="readonly"/></td>
                                             <td><input type="text" name="orderItem_Qty[]" value="" class="input-mini  mini" id="itemQty" tabindex="2"/>
                                             </td>
                                             <td>
                                                 <div class="input-prepend input-append"><span class="add-on">£ </span><input
                                                         name="orderItem_PPU[]"
                                                         class=" input-small small"
                                                         id="itemPrice"
                                                         type="text"></div>
                                             </td>
                                             <td>
                                                 <input name="orderItem_vat_rate[]" id="vatRate" type="hidden">
                                                 <div class="input-prepend input-append"><span class="add-on">£ </span><input
                                                         name="orderItem_itemVatTotal[]"
                                                         class=" input-small small"
                                                         id="itemVatTotal"
                                                         type="text" readonly="readonly"></div>
                                             </td>
                                             <td>
                                                 <div class="input-prepend input-append"><span class="add-on">£ </span><input
                                                         name="orderItem_itemLineTotal[]" class="small input-small" id="itemLineTotal" type="text"
                                                         readonly="readonly"></div>
                                                 
                                             </td>
                                         </tr>
                                     </tbody>
                                 </table>

                             <a href="#" id="addRow" class="btn btn-primary"><i class="icon-plus icon-white"></i> Add Item</a>

                             <hr class="">

                         </div>


                         <div class="row">
                             <div>
                                 
                                 <span class="alert alert-info notification undone hidden margin_bottom_30"> </span>
                             </div>
                             <div class="col_7 margin_top_30">
                                 <h4>Order Notes</h4>
                                 <?php echo form_textarea('OrderNotes', element('OrderNotes', $shipping_info, ''), "class='xxlarge' rows=5"); ?>
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
                                                <?php echo form_input('_NetTotalPrice', element('_NetTotalPrice', $shipping_info, ''), 'id="invSubTotal" class="subtotal"  readonly="readonly"'); ?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                <span>Total VAT</span>
                                                <?php echo form_input('_TotalVat', element('_TotalVat', $shipping_info, ''), 'id="invTotalVat" class="subtotal"  readonly="readonly"'); ?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <span>Postage & packing:</span>
                                                 <?php echo form_input('_ShippingCharges', element('_ShippingCharges', $shipping_info, ''), 'id="invPostage" class="subtotal " '); ?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                <span>Discount</span>
                                                <?php echo form_input('_Discount', element('_Discount', $shipping_info, ''), 'id="invDiscount" class="subtotal " '); ?>
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>
                                                 <h3><span>Total invoice</span>
                                                <?php echo form_input('_GrandTotal', element('_GrandTotal', $shipping_info, ''), 'id="invGrandTotal" class="large"  readonly="readonly"'); ?></h3>
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

<?php  print_array($this->data);