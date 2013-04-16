<?php $save_button = '<div class="clearfix"><input name="submit" type="submit" class="button blue right small" value="Save"></input></div>'; ?>

<div class="form">
    <?php echo display_field($fields['_IsOrganisationYN']); ?>  
    <?php display_field($fields['Title']); ?>
    <?php display_field($fields['FirstName']); ?>
    <?php display_field($fields['LastName']); ?>
    <?php display_field($fields['Nickname']); ?>
    <?php echo $save_button; ?>
    
</div><!-- End of form div-->
<div class="form margin_top_15">
    <?php display_field($fields['Email']); ?>
    <?php display_field($fields['EmailAddress2']); ?>
    <?php display_field($fields['_Gender']); ?>
    <?php display_field($fields['Birthday']); ?>
    <?php display_field($fields['_LegacyMembershipNo']); ?>
    <?php echo $save_button; ?>
</div>

<?php include ( APPPATH . 'views/default/common/postcode_lookup.php' );?>

<div class="form margin_top_15">
    <?php display_field($fields['_OrganisationName']); ?>
    <?php display_field($fields['StreetAddress1']); ?>
    <?php display_field($fields['StreetAddress2']); ?>
    <?php display_field($fields['_StreetAddress3']); ?>
    <?php display_field($fields['City']); ?>
    <?php display_field($fields['State']); ?>
    <?php display_field($fields['Country']); ?>
    <?php display_field($fields['PostalCode']); ?>
    <?php echo $save_button; ?>
</div>
<div class="form margin_top_15">
    <?php display_field($fields['Phone1']); ?>
    <?php display_field($fields['Phone2']); ?>
    <?php //display_field($fields['Phone3']); ?>
    <?php display_field($fields['Phone4']); ?>
    <?php //display_field($fields['_FacebookUrl']); ?>
    <?php display_field($fields['_TwitterName']); ?>