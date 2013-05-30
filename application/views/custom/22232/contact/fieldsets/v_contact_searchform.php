<h4>You can search by any of the columns you see below in the table:</h4>
<h4>Do a search...</h4>
<?php echo form_open(site_url('contact/search'), 'class="form"'); ?>
<?php
$criteria = array('equal' => 'Equals',
    'notequal' => "Doesn't equal",
    'greaterthan' => 'Is greater than',
    'lessthan' => 'Is less than'
);
?>
<table>
    <tr>
        <th>Field</th>
        <th>Criteria</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>First Name</td>
        <?php //echo form_hidden("line_1[fieldname]", 'FirstName');  ?>
        <td><?php echo form_dropdown("FirstName[operation]", $criteria); ?></td>
        <td><input name="FirstName[value]" type="text" /></td>
    </tr>
    <tr>
        <td>Last Name</td>
        <?php //echo form_hidden("line_2[fieldname]", 'LastName');  ?>
        <td><?php echo form_dropdown("LastName[operation]", $criteria); ?></td>
        <td><input name="LastName[value]" type="text" /></td>
    </tr>
</table> 
<?php 
    //echo form_label('Choose fileds to return');
    //echo form_multiselect('_::_cols[]', array('Id'=> 'Id', 'FirstName' => 'First Name', 'LastName' => 'Last Name', 'Phone1' => 'Phone No', 'PostalCode' => 'Postcode', '_LegacyMembershipNo' => 'Memb No'));
    
echo form_hidden('_::_query', element('query', $tables['search_results']));
    echo form_hidden('_::_ids', element('returned_ids_csv', $tables['search_results']));
    //echo form_dropdown('_::_export', array(1 =>'Yes', 0=>'No'), 0);
?>
<div class="clearfix">
    <input name='_::_submit' type='submit' class='button green right large' style='float:right' value='Search'></input>
</div>
<?php echo form_close(); ?>