<?php $save_button = '<div class="clearfix"><input name="submit" type="submit" class="button blue right small" value="Save"></input></div>'; ?>

<?php include ( APPPATH . 'views/default/common/postcode_lookup.php' );?>

<div class="form  margin_top_15">
    <?php echo display_field($fields['_IsOrganisationYN'], array('defaultvalue' => 1)); ?>
    <?php display_field($fields['_LegacyMembershipNo'], array('value' => $rID)); ?>
     <?php display_field($fields['_OrganisationName']); ?>
    <?php display_field($fields['StreetAddress1']); ?>
    <?php display_field($fields['StreetAddress2']); ?>
    <?php display_field($fields['_StreetAddress3']); ?>
    <?php display_field($fields['City']); ?>
    <?php display_field($fields['State']); ?>
    <?php display_field($fields['Country']); ?>
    <?php display_field($fields['PostalCode']); ?>
    <?php echo $save_button; ?>
</div><!-- End of form div-->
<div class="form margin_top_15">
    
    <?php display_field($fields['Phone1']); ?>
    <?php display_field($fields['Phone2']); ?>
    <?php //display_field($fields['Phone3']); ?>
    <?php display_field($fields['Phone4']); ?>
    <?php //display_field($fields['_FacebookUrl']); ?>
    <?php //display_field($fields['_TwitterName']); ?>
    <?php display_field($fields['EmailAddress3']); ?>
    <?php display_field($fields['_AccountStatus']); ?>
    
</div><!-- End of form div-->
<div class="form margin_top_15">
    <?php display_field($fields['Title'], array('label' => 'Primary Contact Title')); ?>
    <?php display_field($fields['FirstName'], array('label' => 'Primary Contact First Name')); ?>
    <?php display_field($fields['LastName'], array('label' => 'Primary Contact Last Name')); ?>
    <?php display_field($fields['Nickname'], array('label' => 'Primary Contact Nickname')); ?>
    <?php display_field($fields['Email']); ?>
    <?php display_field($fields['EmailAddress2']); ?>
    <?php display_field($fields['_Gender']); ?>
    <?php display_field($fields['Birthday']); ?>
    <?php echo $save_button; ?>