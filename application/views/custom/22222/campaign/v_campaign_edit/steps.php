<div class="clearfix" id="">
    <?php echo form_open(DATAOWNER_ID . '/steps/add/edit/campaign/' . $rID); ?>
    <table id="never_ending_table">
    <thead>
      <tr>
          <th scope="col"><strong>Step</strong></th>
        <th scope="col"><strong>Action & Template Name</strong></th>
        <th scope="col"><strong>Delay</strong></th>
        <th scope="col"><strong>Apply Tag?</strong></th>
      </tr>
    </thead>
   
    <tbody>
      <?php foreach($this->data['view_setup']['tables']['steps']['table_data'] as $step => $attributes) { ; ?>
        <tr>
            <td>
                <span id="<?php echo 'stepno_' . $step; ?>"><?php echo $step; ?></span>
            </td>
            <td>  
              <select name="<?php echo 'StepName_' . $step; ?>" id="<?php echo 'StepName_' . $step; ?>" class="large">
                <?php echo generate_dropdown($this->data['view_setup']['dropdowns']['template_dropdown'], $attributes['__StepName']); ?>
              </select>
            </td>
            <td>
                <select name="<?php echo 'Delay_' . $step; ?>" id="<?php echo 'Delay_' . $step; ?>" class="small">
                    <?php echo generate_dropdown(array(''=>0, 'No Delay'=>1,'1 Hr'=>3600,'2 Hr'=>7200,'6 Hr'=>21600,'12 Hr'=>43200,'1 Day'=>86400,'2 Days'=>172800,'3 Days'=>259200,'4 Days'=>345600,'5 Days'=>432000,'6 Days'=>518400,'7 Days'=>604800,'10 Days'=>864000,'14 Days'=>1209600,'21 Days'=>1814400,'28 Days'=>2419200,'5 Weeks'=>3024000,'6 Weeks'=>3628800), $attributes['__Delay']); ?>
              </select>
            </td>           
            <td>
                <select name="<?php echo 'TagId_' . $step; ?>" id="<?php echo 'TagId_' . $step; ?>" class="medium">
                    <?php echo generate_dropdown($this->data['view_setup']['dropdowns']['tag_dropdown'], $attributes['__TagId']); ?>
              </select>
                 <input name="<?php echo 'Id_' . $step; ?>" id="<?php echo 'Id_' . $step; ?>" value="<?php echo $attributes['__Id']; ?>" type="hidden" >
            </td>
      </tr>
      <?php } //this ends the foreach started above ?>
    </tbody>
  </table>
  <button id="add_row">Add A New Step</button>
  <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save Sequence'></input>
   <?php echo form_close(); ?>
</div>

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
 
    // get the name attribute for the input and select fields
    $tr.find("input,select").attr("name", function()
    {
      // break the field name and it's number into two parts
      var parts = this.id.match(/(\D+)(\d+)$/);
 
      // create a unique name for the new field by incrementing
      // the number for the previous field by 1
      return parts[1] + ++parts[2];
      
      //if parts[1] = stepno_ then change the value too
    // repeat for id attributes
    }).attr("id", function()
    {
      var parts = this.id.match(/(\D+)(\d+)$/);
      return parts[1] + ++parts[2];
    }).val(0);
    
    $tr.find("span").attr("id", function()
    {
      var parts = this.id.match(/(\D+)(\d+)$/);
      window.globalStorage = ++parts[2];
      return parts[1] + globalStorage;
    }).html(globalStorage);
         
    // append the new row to the table
    $(table).find("tbody tr:last").after($tr);
  };
});
</script> 