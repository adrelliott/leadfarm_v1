<?php
/*
 * A form to search for contacts
 */



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

$order_row = '<tr>
        <td>'
             . form_dropdown('order_type_operator[]',array('equalor' => 'OR have got', 'equaland' => 'AND have ALSO got', 'notequal' => 'AND have not got'), 'equalor') .
        '</td>
        <td>'
             . form_dropdown('order_type[]', $order_types, '0') .
        '</td>
        <td>
             in season' . form_dropdown('order_expire[]', array('0' => 'Any', '2005/06' => '2005/06', '2006/07' => '2006/07', '2007/08' => '2007/08', '2008/09' => '2008/09', '2009/10' => '2009/10', '2010/11' => '2011/12', '2012/13' => '2012/13', '2013/14' => '2013/14'), '0') .
        '</td>
        <td>
            <button class="del_row">Del</button>
        </td>
      </tr>';


echo form_open(site_url('broadcast/search'));
?><table  id="never_ending_table">
    <thead>
      <tr>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
   
    <tbody>
        
    <h3>Let's see all contacts that...</h3>
      <tr id="row_1">
        <td>
             <?php echo form_dropdown('order_type_operator[]',array('equal' => 'have got', 'notequal' => 'have not got'), 'equal'); ?>
        </td>
        <td>
             <?php echo form_dropdown('order_type[]', $order_types, '0'); ?>
        </td>
        <td>
             in season <?php echo form_dropdown('order_expire[]', array('0' => 'Any', '2005/06' => '2005/06', '2006/07' => '2006/07', '2007/08' => '2007/08',  '2008/09' => '2008/09','2009/10' => '2009/10', '2010/11' => '2011/12', '2012/13' => '2012/13', '2013/14' => '2013/14'), '0'); ?>
        </td>
        <td>
            
        </td>
      </tr>
    </tbody>
  </table>
<button id="add_rows">Add more rows</button>

<div class="clearfix">
    <input name='submit' type='submit' class='button red right large' style='float:right' value='Start Search'></input>
</div>

<?php
echo form_close();?>
<script>
$(document).ready(function($)
{
  // trigger event when button is clicked
  $("#add_rows").click(function()
  {
    // add new row to table using addTableRow function
    addTableRow($("#never_ending_table"));
 
    // prevent button redirecting to new page
    return false;
  });
   
  // function to add a new row to a table by cloning the last row and
  // incrementing the name and id values by 1 to make them unique
  function addTableRow(table)
  {
    // add a new row
    var $tr2 = <?php echo json_encode($order_row); ?>
         
    // append the new row to the table
    $(table).find("tbody tr:last").after($tr2);
  };
  
  //remove rows when button clicked
  $("#never_ending_table button.del_row").live("click", function() {
      $(this).parents("tr").remove();
  });
 });
  
</script> 
