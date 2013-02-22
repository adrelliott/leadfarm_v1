<div class="clearfix" id="">
    <label class="" id="">Campaign name</label>
    <div class="input " id="">
        <input class="" id="" type="text" name="Name" length="" value="Test camp 1">
    </div>
</div>
<div class="clearfix" id="">
    <table id="never_ending_table">
    <thead>
      <tr>
        <th scope="col">Step</th>
        <th scope="col">Action & Template Name</th>
        <th scope="col">Delay</th>
        <th scope="col">Apply Tag?</th>
      </tr>
    </thead>
   
    <tbody>
      <?php foreach($this->data['view_setup']['tables']['steps']['table_data'] as $step => $attributes) { ?>
        <tr>
            <td>
                <input name="<?php echo 'stepno_' . $attributes['__StepNo']; ?>" id="<?php echo 'stepno_' . $attributes['__StepNo']; ?>" value="<?php echo $attributes['__StepNo']; ?>" class="mini" type="text">
            </td>
            <td>  
              <select name="<?php echo 'action_' . $attributes['__StepNo']; ?>" id="<?php echo 'action_' . $attributes['__StepNo']; ?>" class="large">
                <?php echo generate_dropdown($this->data['view_setup']['dropdowns']['template_dropdown'], $attributes['__TemplateTagId']); ?>
              </select>
            </td>
            <td>
                <select name="delay_1" id="delay_1" class="small">
                    <option value=""></option>
                    <option value="0">Immediately</option>
                    <option value="60">1 hour</option>
                    <option value="120">2 hours</option>
                    <option value="3">3 hours</option>
                    <option value="3">4 hours</option>
                    <option value="3">6 hours</option>
                    <option value="3">8 hours</option>
                    <option value="3">10 hours</option>
                    <option value="3">12 hours</option>
                    <option value="3">1 day</option>
                    <option value="3">2 day</option>
              </select>
            </td>
            <td>
                <select name="delay_1" id="delay_1" class="small">
                    <?php echo generate_dropdown($this->data['view_setup']['dropdowns']['tag_dropdown']); ?>
              </select>
            </td>
      </tr>
      <?php } //this ends the foreach started above ?>
    </tbody>
  </table>
  <button id="add_row">Add Row</button>
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
    $tr.find("select").attr("name", function()
    {
      // break the field name and it's number into two parts
      var parts = this.id.match(/(\D+)(\d+)$/);
 
      // create a unique name for the new field by incrementing
      // the number for the previous field by 1
      return parts[1] + ++parts[2];
    // repeat for id attributes
    }).attr("id", function()
    {
      var parts = this.id.match(/(\D+)(\d+)$/);
      return parts[1] + ++parts[2];
    });
    
    
         
    // append the new row to the table
    $(table).find("tbody tr:last").after($tr);
  };
});
</script> 