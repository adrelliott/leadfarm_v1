<?php //This fieldset is called when users click on the dashboard table link. ther eis no way to know what _IsOrganisationYN flag is set, so we just load all fields here ?>
<?php echo form_open(DATAOWNER_ID . '/contact/add/' . $rID); ?>
    <?php display_field($fields['Title'], array('label' => 'Main Contact Title')); ?>
    <?php display_field($fields['FirstName'], array('label' => 'Main Contact First Name')); ?>
        <?php display_field($fields['LastName'], array('label' => 'Main Contact Last Name')); ?>
    <?php display_field($fields['Nickname']); ?>
    <?php display_field($fields['Email'], array('label' => 'Main Email')); ?>
    <div class="clearfix" id="">
        <label class="" id="">Postcode</label>
        <div class="input " id="">
            <input class="small" style="text-transform: uppercase"  id="" type="text" name="PostalCode" length="" value="">
            <SCRIPT LANGUAGE=JAVASCRIPT SRC="http://services.postcodeanywhere.co.uk/popups/javascript.aspx?account_code=charl11150&license_key=pw65-jx54-fz99-jx75"></SCRIPT> 
        </div>
    </div>
    <?php //display_field($fields['PostalCode']); ?>
   
    <?php display_field($fields['_OrganisationName']); ?>
    <?php display_field($fields['StreetAddress1']); ?>
    <?php display_field($fields['StreetAddress2']); ?>
    <?php display_field($fields['City']); ?>
    <?php display_field($fields['State']); ?>
    <?php display_field($fields['Country']); ?>
    <?php display_field($fields['Phone1'], array('label' => 'Switchboard')); ?>
    <?php display_field($fields['Phone2'], array('label' => 'Alt Phone')); ?>
    <?php display_field($fields['Leadsource']); ?>  
    <?php display_field($fields['_Gender']); ?>
    <?php echo display_field($fields['_IsOrganisationYN']); ?>
    <div class="clearfix">
        <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
    </div>