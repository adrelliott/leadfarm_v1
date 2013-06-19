<div class="form">
    <?php display_field($fields['Title']); ?>
    <?php display_field($fields['FirstName']); ?>
    <?php display_field($fields['LastName']); ?>
    <?php //display_field($fields['Nickname']); ?>
</div><!-- End of form div-->
<div class="form margin_top_15">
    <?php display_field($fields['Email']); ?>   
    <?php display_field($fields['EmailAddress2']); ?>
    <?php display_field($fields['_Gender']); ?>
    <?php display_field($fields['__ReferredBy']); ?>
    <?php display_field($fields['__Consultant']); ?>
    <?php display_field($fields['__TypeOfContact']); ?>
    <?php //display_field($fields['Birthday']); ?>
    <?php //display_field($fields['_LegacyMembershipNo']); ?>
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
</div>
<div class="form margin_top_15">
    <?php display_field($fields['Phone1']); ?>
    <?php display_field($fields['Phone2']); ?>
    <?php display_field($fields['Phone3']); ?>
    <?php display_field($fields['_FacebookUrl']); ?>
    <?php display_field($fields['_TwitterName']); ?>
</div><!-- End of form div-->
<div class="form margin_top_15">
    <?php display_field($fields['Leadsource']); ?>
    <div style="<?php echo $display_none; ?>"">
        <?php echo display_field($fields['_IsOrganisationYN'], array('value' => 0)); ?>
    </div>