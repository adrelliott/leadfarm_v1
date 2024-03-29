$(document).ready(function () {

    // We are overriding the autocomplete UI menu styles to create our own.
    // You can add information from the returned json array as needed
    // Just be sure that your array contains the correct value when returned
    // You'll want to modify the data/item-data.php file for the returned values

    $.ui.autocomplete.prototype._renderItem = function (ul, item) {
        return $("<li></li>")
            .data("item.autocomplete", item)

            // This is the autocomplete list that is generated
            .append("<a class='additionalInfo'>" + item.jItemCode + " - [" + item.jItemType + "] " + item.jItemDesc + 

            // This is the hover box that is generated when you hover over an item in the list
            "<span class='additionalInfoColor'>" +
            /*"<div><h4>Item Information</h4></div>" +
            "<div><strong>Item Code:</strong> " + item.jItemCode + "</div>" +
            "<div><strong>Qty on Hand:</strong> " + item.jQtyOnHand + "</div>" +
            "<div><strong>Merchant:</strong> $" + item.jItemPrice + "</div>" +
            "<div><strong>Wholesale:</strong> $" + item.jItemWholesale + "</div>" +
            "<div><strong>Retail:</strong> $" + item.jItemRetail + "</div>" + 
                 */
            "</span> </a>")

            .appendTo(ul);
    };

    // We don't want the user to leave the page if they have started working with it so we set the
    // onbeforeload method
    $('#itemCode').focus(function () {
        window.onbeforeunload = function () {
            return "You haven't saved your data.  Are you sure you want to leave this page without saving first?";
        };
    });

    // Update invoice total when item Qty or Price inputs have been updated
    $("#itemQty, #itemPrice").on('keyup', function () {
        // Locate the row we are working with
        var $itemRow = $(this).closest('tr');
        // Update the price.
        updatePrice($itemRow);
    });
    
    
    
    
    // Update invoice totals when discount or P&P inputs have been updated
    $("#invPostage, #invDiscount").on('keyup', function () {
        var $discount = $("#invDiscount").val();
        
        //check that the discount is negative
        if($discount > 0) {
         $discount = 0 - $discount;
        }
        $("#invDiscount").val($discount);
       
        // Update the totals.
        update_grand_total();
    });



    // Use the .autocomplete() method to compile the list based on input from user
    $('#itemCode').autocomplete({
        //source: 'services/fetch-item-data.php',
        source: 'http://localhost:8888/projects/leadfarm_v1/public_html/product/ajax_products',
        //source: 'http://mymarketingcentre.co.uk/product/ajax_products',
        minLength: 1,
        select:function (event, ui) {
            var $itemrow = $(this).closest('tr');
            // Populate the input fields from the returned values
            $itemrow.find('#itemCode').val(ui.item.jItemCode);
            $itemrow.find('#itemDesc').val(ui.item.jItemDesc);
            $itemrow.find('#itemPrice').val(ui.item.jItemPrice);
            $itemrow.find('#vatRate').val(ui.item.jItemVatRate);

            // Give focus to the next input field to recieve input from user
            $('#itemQty').focus();
            return false;
        }
    });

    /*
     * Here's where we start adding rows to the invoice
     */

    // Add row to list and allow user to use autocomplete to find items.
    $("#addRow").on('click', function () {

        // Get the table object to use for adding a row at the end of the table
        var $itemsTable = $('#itemsTable');

        // Create an Array to for the table row. ** Just to make things a bit easier to read.
        /*var rowTemp = [
            '<tr class="item-row">',
            '<td><i id="deleteRow" class="icon-remove"></i></td>',
            '<td><input type="text" name="itemCode[]" class="input-mini" value="" id="itemCode" /> </td>',
            '<td><input type="text" name="itemDesc[]" class="input-large" value="" id="itemDesc"  readonly="readonly" /></td>',
            '<td><input type="text" name="itemQty[]" class="input-mini" value="" id="itemQty" /></td>',
            '<td><div class="input-prepend input-append"><span class="add-on">£</span><input name="itemPrice[]" class=" input-small" id="itemPrice" type="text"></div></td>',
            '<td><div class="input-prepend input-append"><span class="add-on">£</span><input name="itemLineTotal[]" class=" input-small" id="itemLineTotal" type="text" readonly="readonly"></div></td>',
            '</tr>'
        ].join('');
        */
       
       var rowTemp = [
           '<tr class = "item-row">',
            '<td><i id="deleteRow" class="icon-remove">X</i></td>',
                '<td><input type="text" name="itemCode[]" value="" class="input-mini mini" id="itemCode" tabindex="1" /></td>',
                '<td><input type="text" name="itemDesc[]" value="" class="input-large xlarge" id="itemDesc" readonly="readonly" /> </td>',
                '<td> <input type="text" name="itemQty[]" value="" class="input-mini  mini" id="itemQty" tabindex="2" /></td>',
                '<td><div class="input-prepend input-append"> <span class="add-on"> £ </span><input name="itemPrice[]" class="input-small small" id="itemPrice" type="text"> </div></td>',
                
                '<td><input name="vatRate[]" id="vatRate" type="hidden"><div class="input-prepend input-append"> <span class="add-on"> £ </span><input name="itemVatTotal[]" class="input-small small" id="itemVatTotal" type="text"  readonly="readonly"> </div></td>',
                '<td><div class="input-prepend input-append"> <span class="add-on"> £ </span><input name="itemLineTotal[]" class="small input-small" id="itemLineTotal" type="text" readonly="readonly" > </div>',
                //'<input name="itemVatTotal[]" id="itemVatTotal" type="hidden"></td>',
                
                '</tr>'
       ].join('');
        
       
       

        var $row = $(rowTemp);

        // save reference to inputs within row
        var $itemCode = $row.find('#itemCode');
        var $itemDesc = $row.find('#itemDesc');
        var $itemPrice = $row.find('#itemPrice');
        var $itemQty = $row.find('#itemQty');
        var $itemVat = $row.find('#vatRate');

        // If the last row itemCode is empty then don't let the user continue adding a row
        if ($('#itemCode:last').val() != '') {

            // Add row after the first row in table
            $('.item-row:last', $itemsTable).after($row);
            $($itemCode).focus();

            // apply autocomplete method to newly created row
            $row.find('#itemCode').autocomplete({
                //source:'services/fetch-item-data.php',
                source: 'http://localhost:8888/projects/leadfarm_v1/public_html/product/ajax_products',
                //source: 'http://mymarketingcentre.co.uk/product/ajax_products',
                minLength:1,
                select:function (event, ui) {
                    $itemCode.val(ui.item.jItemCode);
                    $itemDesc.val(ui.item.jItemDesc);
                    $itemPrice.val(ui.item.jItemPrice);
                    $itemVat.val(ui.item.jItemVatRate);
                    // Give focus to the next input field to receive input from user
                    $itemQty.focus();
                    return false;
                }
            });

            // Remove row when clicked
            $row.find("#deleteRow").on('click', function () {
                // Remove this row we clicked on
                $(this).parents('.item-row').remove();
                // Show alert we removed the row
                updateMessage('.alert', 'Item was removed!', 2000);
                // Hide delete Icon if we only have one row in the list.
                if ($(".item-row").length < 2) $("#deleteRow").hide();
                // Update total
                update_total();
                update_total_vat();
                update_grand_total();
            });

            // Update the invoice total on keyup when the user updates the item qty or price input
            // ** Note: This is for the newly created row
            $row.find("#itemQty, #itemPrice").on('keyup', function () {
                // Locate the row we are working with
                var $itemRow = $(this).closest('tr');
                // Update the price.
                updatePrice($itemRow);
            });


       } else {
           $('.alert').fadeIn('slow').html('You need to complete the item inputs');
      }

        // End if last itemCode input is empty
        return false;
    });

}); // End DOM


/* Description: Update price function
*  @param: $itemRow - Row Object
* */

 var updatePrice = function($itemRow){
    // Calculate the price of the row.  Remove and $ so the calculation doesn't break
    var price = $itemRow.find('#itemPrice').val().replace("£", "") * $itemRow.find('#itemQty').val();
    price = roundNumber(price, 2);
    isNaN(price) ? $itemRow.find('#itemLineTotal').val("N/A") : $itemRow.find('#itemLineTotal').val(price);
    
    //Update the vat on this product
    var indiv_vat = $itemRow.find('#vatRate').val() * $itemRow.find('#itemPrice').val() * $itemRow.find('#itemQty').val() / 100;
    indiv_vat = roundNumber(indiv_vat, 2);
    isNaN(indiv_vat) ? $itemRow.find('#itemVatTotal').val("N/A") : $itemRow.find('#itemVatTotal').val(indiv_vat);
    
    //Update the total vat on this row
    //var vat = $itemRow.find('#itemVat').val() * $itemRow.find('#itemQty').val();
    //vat = roundNumber(vat, 2);
    //isNaN(vat) ? $itemRow.find('#itemVatTotal').val("N/A") : $itemRow.find('#itemVatTotal').val(vat);
    
    update_total();
    update_total_vat();
    update_grand_total();
};

var update_total = function() {
    var total = 0;
    $('input#itemLineTotal').each(function (i) {
        price = $(this).val().replace("£", "");
        if (!isNaN(price)) total += Number(price);
    });

    total = roundNumber(total, 2);
    $('#invGrandTotalTop, #invGrandTotal').html("<h4>£" + total + "</h4>");
    //$('input#invGrandTotal1').val(total);
    $('input[name="TotalPrice_A"]').val(total);

};

var update_total_vat = function() {
    var total_vat = 0;
    $('input#itemVatTotal').each(function (i) {
        vat = $(this).val().replace("£", "");
        if (!isNaN(vat)) total_vat += Number(vat);
    });
    
    total_vat = roundNumber(total_vat, 2);
     $('input[name="totalVat"]').val(total_vat);
};

var update_grand_total = function() {
    grand_total = 0;
    running_total = 0;
     $('input.subtotal').each(function (i) {
        running_total = $(this).val().replace("£", "");
        if (!isNaN(running_total)) grand_total += Number(running_total);
    });
    grand_total = roundNumber(grand_total, 2);
     $('input[name="total"]').val(grand_total);
};

// Update message
var updateMessage = function(msgType, message, delay){
    $('#alert').fadeIn('slow').addClass(msgType).html(message).delay(delay).fadeOut('slow');
};


//########################################################################################################################

// from http://www.mediacollege.com/internet/javascript/number/round.html
function roundNumber(number, decimals) {
    var newString;// The new rounded number
    decimals = Number(decimals);
    if (decimals < 1) {
        newString = (Math.round(number)).toString();
    } else {
        var numString = number.toString();
        if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
            numString += ".";// give it one at the end
        }
        var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
        var d1 = Number(numString.substring(cutoff, cutoff + 1));// The value of the last decimal place that we'll end up with
        var d2 = Number(numString.substring(cutoff + 1, cutoff + 2));// The next decimal, after the last one we want
        if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
            if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
                while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
                    if (d1 != ".") {
                        cutoff -= 1;
                        d1 = Number(numString.substring(cutoff, cutoff + 1));
                    } else {
                        cutoff -= 1;
                    }
                }
            }
            d1 += 1;
        }
        if (d1 == 10) {
            numString = numString.substring(0, numString.lastIndexOf("."));
            var roundedNum = Number(numString) + 1;
            newString = roundedNum.toString() + '.';
        } else {
            newString = numString.substring(0, cutoff) + d1.toString();
        }
    }
    if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
        newString += ".";
    }
    var decs = (newString.substring(newString.lastIndexOf(".") + 1)).length;
    for (var i = 0; i < decimals - decs; i++) newString += "0";
    //var newNumber = Number(newString);// make it a number if you like
    return newString; // Output the result to the form field (change for your purposes)
}

