<?php echo form_open(DATAOWNER_ID . '/contact/add/' . $rID); ?>
    <?php display_field($fields['_OrganisationName']); ?>
    <?php display_field($fields['Title'], array('label' => 'Main Contact Title')); ?>
    <?php display_field($fields['FirstName'], array('label' => 'Main Contact First Name')); ?>
    <?php display_field($fields['LastName'], array('label' => 'Main Contact Last Name')); ?>    
    <?php display_field($fields['Email'], array('label' => 'Main Email')); ?>
    <?php display_field($fields['StreetAddress1']); ?>
    <?php display_field($fields['StreetAddress2']); ?>
    <?php display_field($fields['City']); ?>
    <?php display_field($fields['State']); ?>
    <?php display_field($fields['PostalCode']); ?>
    <?php display_field($fields['Phone1'], array('label' => 'Switchboard')); ?>
    <?php display_field($fields['Phone2'], array('label' => 'Alt Phone')); ?>
    <?php display_field($fields['Leadsource']); ?>
    <div style="<?php echo $display_none; ?>"">
        <?php echo display_field($fields['_IsOrganisation'], array('value' => 1)); ?>
    </div>
    <div class="clearfix">
        <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
    </div>
<?php echo form_close(); ?>