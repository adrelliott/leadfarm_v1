<?php echo form_open(DATAOWNER_ID . '/contact/add/' . $rID); ?>
    <?php display_field($fields['Title']); ?>
    <?php display_field($fields['FirstName']); ?>
    <?php display_field($fields['LastName']); ?>
    <?php display_field($fields['Nickname']); ?>
    <?php display_field($fields['Email']); ?>
    <?php display_field($fields['_Gender']); ?>
    <?php display_field($fields['StreetAddress1']); ?>
    <?php display_field($fields['StreetAddress2']); ?>
    <?php display_field($fields['City']); ?>
    <?php display_field($fields['State']); ?>
    <?php display_field($fields['PostalCode']); ?>
    <?php display_field($fields['Phone1']); ?>
    <?php display_field($fields['Phone2']); ?>
    <?php display_field($fields['Leadsource']); ?>
    <div style="<?php echo $display_none; ?>"">
        <?php echo display_field($fields['_IsOrganisation'], array('value' => 0)); ?>
    </div>
    <div class="clearfix">
        <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
    </div>
<?php echo form_close(); ?>