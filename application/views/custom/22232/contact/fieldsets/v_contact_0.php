
    <?php display_field($fields['Title']); ?>
    <?php display_field($fields['FirstName']); ?>
    <?php display_field($fields['LastName']); ?>
    <?php display_field($fields['Nickname']); ?>
</div><!-- End of form div-->
<div class="form margin_top_15">
    <?php display_field($fields['Email']); ?>   
    <?php display_field($fields['EmailAddress2']); ?>
    <?php display_field($fields['_Gender']); ?>
    <?php display_field($fields['Birthday']); ?>
    <?php display_field($fields['_LegacyMembershipNo']); ?>
</div>
<div class="form margin_top_15">
    <div class="clearfix" id="">
        <label class="" id="">Postcode</label>
        <div class="input " id="">
            <input class="small" style="text-transform: uppercase; background-color: #CDFAC1;" "id="" type="text" name="PostalCode" length="" value="">
            <SCRIPT LANGUAGE=JAVASCRIPT SRC="http://services.postcodeanywhere.co.uk/popups/javascript.aspx?account_code=charl11150&license_key=pw65-jx54-fz99-jx75"></SCRIPT> 
        </div>
    </div>
    <?php display_field($fields['StreetAddress1']); ?>
    <?php display_field($fields['StreetAddress2']); ?>
    <?php display_field($fields['City']); ?>
    <?php display_field($fields['State']); ?>
    <?php display_field($fields['Country']); ?>
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