
<div class="" id="option1">
<?php
/*
 * A form to search for contacts
 */

$seasons = array(
    '0' => 'Any', 
    '2005/06' => '2005/06', 
    '2006/07' => '2006/07', 
    '2007/08' => '2007/08',  
    '2008/09' => '2008/09',
    '2009/10' => '2009/10', 
    '2010/11' => '2010/11', 
    '2011/12' => '2011/12', 
    '2012/13' => '2012/13', 
    '2013/14' => '2013/14'
    );

$criteria = array(
    '0' => 'Any',
    'equal' => 'Equals',
    'notequal' => "Doesn't equal",
    'greaterthan' => 'Is greater than',
    'lessthan' => 'Is less than'
);

$order_types = array(
                0 => '',
                'Adult Membership' => 'Adult Membership', 
                'Junior Membership' => 'Junior Membership', 
                'Season Ticket (Adult)' => 'Season Ticket (Adult)', 
                'Season Ticket (Junior)' => 'Season Ticket (Junior) ', 
                'Community Shares' => 'Community Shares',
                'TreasureLine' => 'TreasureLine', 
                'Holiday Draw' => 'Holiday Draw',
                '127 Club' => '127 Club',
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
                'Club Donations' => 'Club Donations', 
                'DF Donations' => 'DF Donations', 
                'Club Events' => 'Club Events', 
                'Merchanidise' => 'Merchanidise', 
                'Away Match Travel' => 'Away Match Travel'
    );
$role_types = array(
        'Volunteer (Office)' => 'Volunteer (Office)', 
        'Volunteer (Matchday)' => 'Volunteer (Matchday)', 
        'Paid Office Staff' => 'Paid Office Staff', 
        'Community Staff' => 'Community Staff', 
        'Board Member' => 'Board Member', 
        'External Supplier' => 'External Supplier', 
        'Coaching/Backroom Staff' => 'Coaching/Backroom Staff', 
        '1st Team Player' => '1st Team Player', 
        'Youth Team Player' => 'Youth Team Player', 
        'Women\'s Team Player' => 'Women\'s Team Player',
    );

$saved_searches = array();
foreach ($tables['get_all_saved_searches']['table_data'] as $row => $array)
{
    $saved_searches[$array['Id']] = substr($array['Name'], 0, 52);
}

//create the load form - load a saved search?
//echo form_open(site_url('broadcast/do_saved_search/s1'));
//echo '<h4>Load recipients from a saved search: ' . form_dropdown('saved_search_id', $saved_searches);
//echo form_submit('submit', 'Go!') . '</h4>';
//echo form_close();

echo form_open(site_url('broadcast/search')); ?>
    <h3>
        <?php echo form_radio('search_type', 'everyone', TRUE) ?>
        I want to send to everyone
    </h3>
    <h3>
        <?php echo form_radio('search_type', 'specific', FALSE) ?>
        I want to send to specific group(s) of fans
    </h3>
    <div id="specific" class="hidden margin_bottom_30">
        <table  id="never_ending_table" style="border: 0">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
      <tr id="row_1">
        <td>
             <h4>I'm looking for contacts that have got </h4>
        </td>
        <td>
             <?php echo form_dropdown('item_bought[]', $order_types, '0'); ?>
        </td>
        <td>
             in season <?php echo form_dropdown('season[]', $seasons, 0); ?>
        </td>
      </tr>
      <tr id="row_2">
        <td>
             <h4>OR...</h4>
        </td>
        <td>
             <?php echo form_dropdown('item_bought[]', $order_types, '0'); ?>
        </td>
        <td>
             in season <?php echo form_dropdown('season[]', $seasons, 0); ?>
        </td>
      </tr>
      <tr id="row_3">
        <td>
             <h4>OR... </h4>
        </td>
        <td>
             <?php echo form_dropdown('item_bought[]', $order_types, '0'); ?>
        </td>
        <td>
             in season <?php echo form_dropdown('season[]', $seasons, 0); ?>
        </td>
      </tr>
    </tbody>
  </table>
       
    </div>
    <h3>
        <?php echo form_radio('search_type', 'upsell', FALSE) ?>
        I want to encourage sales of a product
    </h3>
    <div id="upsell" class="hidden margin_bottom_30">
        upsell
    </div>
    
<div class="clearfix margin_top_15">
    <input name='submit' type='submit' class='button red right large' style='float:right' value='Start Search'></input>
</div>

<?php echo form_close();?>
</div>

<?php $new_row = '<tr id="row_1">
        <td>
             <h4>I\'m looking for contacts that have got </h4>
        </td>
        <td>
             ' . form_dropdown('order_type[]', $order_types, '0') . '
        </td>
        <td>
             in season ' . form_dropdown('order_expire[]', $seasons, 0) . '
        </td>
      </tr>'; ?>
<script>
$(document).ready(function($)
{
  // trigger event when button is clicked
  $('#add_row').click(function()
  {
    // add new row to table using addTableRow function
    addTableRow($('#never_ending_table'));
 
    // prevent button redirecting to new page
    return false;
  });
   
  // function to add a new row to a table by cloning the last row and
  // incrementing the name and id values by 1 to make them unique
  function addTableRow(table)
  {
    // clone the last row in the table
    var $tr = $(table).find("tbody tr:last").clone();
 
         
    // append the new row to the table
    $(table).find("tbody tr:last").after($tr);
  };
});
</script> 