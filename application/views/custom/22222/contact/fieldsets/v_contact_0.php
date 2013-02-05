<?php echo form_open(DATAOWNER_ID . '/contact/add/' . $rID); ?>
    <?php display_field($fields['Title']); ?>
    <?php display_field($fields['FirstName']); ?>
    <?php display_field($fields['LastName']); ?>
    <?php display_field($fields['Nickname']); ?>
    <?php display_field($fields['Email']); ?>
</div><!-- End of form div-->
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
    <?php display_field($fields['Phone1']); ?>
    <?php display_field($fields['Phone2']); ?>
</div><!-- End of form div-->
<div class="form margin_top_15">
    <?php display_field($fields['Leadsource']); ?>
    <?php display_field($fields['_Gender']); ?>
    <div style="<?php echo $display_none; ?>"">
        <?php echo display_field($fields['_IsOrganisationYN'], array('value' => 0)); ?>
    </div>
    <div class="clearfix">
        <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
    </div>