<div class="col_6"><!-- Start Column 1-->								
    <div class="row clearfix">
        <div class="row"><!-- Tabs begin -->
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Tab 1</a></h2></li>
                    <li><h2><a href="#tab-2">Tab 2</a></h2></li>
                    <li><h2><a href="#tab-3">Tab 3</a></h2></li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <div class="form">
                            <?php display_field($fields['Title']); ?>
                            <?php display_field($fields['FirstName'], array('value' => 'xxxxx')); ?>
                            <?php display_field($fields['LastName']); ?>
                            <?php// display_field($fields['Nickname']); ?>
                            <?php// display_field($fields['Email']); ?>
                            <?php //display_field($fields['_Gender']); ?>
                            <?php// display_field($fields['City']); ?>
                            <div style="<?php echo $display_none; ?>"">
                                <?php echo display_field($fields['_IsOrganisation']); ?>
                            </div>
                        </div>
                    </div>
                    <div id="tab-2">
                        <p>Donec vel dui et tellus tincidunt suscipit vitae non libero. Proin vitae tellus a eros imperdiet facilisis eget venenatis lacus. Phasellus porta bibendum enim, et volutpat mauris consequat ac. Suspendisse ac augue est, quis auctor nibh. Nunc molestie, est a lacinia malesuada, elit lacus condimentum sapien, sit amet semper odio leo vel metus. Curabitur sit amet lectus in leo ornare facilisis. Sed suscipit nulla enim, ut vulputate est. Nulla in porta nisi. Phasellus ut mattis leo. </p>
                    </div>
                    <div id="tab-3">
                        <p>Ut quis purus eget nulla cursus ullamcorper. In hac habitasse platea dictumst. Sed vulputate magna vitae enim rutrum egestas. Sed non mauris vel ligula vehicula gravida. Aliquam ligula tellus, lobortis et mollis sed, tempus ut nulla. Fusce ac magna mi. Praesent pellentesque semper porta. Aenean nulla metus, porttitor in posuere ac, interdum eget urna. In faucibus massa sit amet ligula dignissim dictum. Aliquam ultrices, dui in vehicula bibendum, massa tellus porta lorem, non porttitor urna mi quis nulla. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col_6 last"><!-- Start Column 1-->								
    <div class="row clearfix"> 
        <div class="row"><!-- Tabs begin -->
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Tab 1</a></h2></li>
                    <li><h2><a href="#tab-2">Tab 2</a></h2></li>
                    <li><h2><a href="#tab-3">Tab 3</a></h2></li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <div class="form">
                            <?php //echo form_open($this->data['formAction']['add_amend_record']); ?>
                            <div style="<?php //echo $this->data['display_none']; ?>"">
                                <?php //echo display_field($this->data['results']['_IsOrganisation']); ?>
                            </div>
                            <div class="clearfix">
                                <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                            </div>
                            <?php //echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-2">
                        <p>Donec vel dui et tellus tincidunt suscipit vitae non libero. Proin vitae tellus a eros imperdiet facilisis eget venenatis lacus. Phasellus porta bibendum enim, et volutpat mauris consequat ac. Suspendisse ac augue est, quis auctor nibh. Nunc molestie, est a lacinia malesuada, elit lacus condimentum sapien, sit amet semper odio leo vel metus. Curabitur sit amet lectus in leo ornare facilisis. Sed suscipit nulla enim, ut vulputate est. Nulla in porta nisi. Phasellus ut mattis leo. </p>
                    </div>
                    <div id="tab-3">
                        <p>Ut quis purus eget nulla cursus ullamcorper. In hac habitasse platea dictumst. Sed vulputate magna vitae enim rutrum egestas. Sed non mauris vel ligula vehicula gravida. Aliquam ligula tellus, lobortis et mollis sed, tempus ut nulla. Fusce ac magna mi. Praesent pellentesque semper porta. Aenean nulla metus, porttitor in posuere ac, interdum eget urna. In faucibus massa sit amet ligula dignissim dictum. Aliquam ultrices, dui in vehicula bibendum, massa tellus porta lorem, non porttitor urna mi quis nulla. </p>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'  style="<?php //echo $this->data['display_none']; ?>">
            <div class="widget clearfix  form">
                <h2>Quick Actions</h2>
                <div class="clearfix">
                    <div class="input">
                        <label>Choose an action:</label>
                        <select>
                            <option class="large">Send Email</option>
                            <option>Send membership Enquiry Pack</option>
                            <option>Send membership pack</option>
                            <option>Send pack for volunteering (via email)</option>
                        </select>
                        <a href="#" class="large blue button">GO!</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
             <div class="widget clearfix  form">
                 <h2>Preferences</h2>
                 <div class="clearfix">
                     <div class="form no-border ">
                         <div class="form">
                            <?php //echo form_open($this->data['formAction']['add_amend_record']); ?>
                            <div class="clearfix">
                                <h4>Opt-in Settings:</h4>
                            </div>
                            <?php //echo display_field($this->data['results']['_optin_Email']); ?>
                            <?php //echo display_field($this->data['results']['_optin_SMS']); ?>
                            <?php// echo display_field($this->data['results']['_optin_SurfaceMail']); ?>
                            <?php //echo display_field($this->data['results']['_optin_pref_method']); ?>
                             <div class="clearfix">
                                <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                            </div>
                            <?php //echo form_close(); ?>
                        </div>
                     </div>
                 </div>
             </div>											
         </div>
    </div>
</div>




<!--

<h1>this is the custom!!! file for the CONTACT page..."</h1>
<p> FRONTEND! this what the view needs:</p>
    <ul>
        this on the left habnd col
    <li>Tab 1: a fieldset shwogin all contact details (esp datepicker, nickname & postcode lookup</li>
    <li>Tab 2: a contact note field note where it appends note the field</li>
    <li>Tab 3: a relatinships table and add new relaitonship button) and contacId = ContactId</li>
    <li>Tab 4: a vehciles table (and add new vehicle button) and contacId = ContactId</li>
    
    on right hand col
    <li>Tab 1: a tabel showing contacactions where type = task, phonecall, and contacId = ContactId</li>
    <li>Tab 2: a table showing contacactions where type = booking and contacId = ContactId</li>
    <li>Tab 3: a table showing communications senbt and contacId = ContactId</li>
    
    
    then, underneath, a drop down menu showing tyopes of emails (opens up a modal window with the emaiul template)
    
    then, underneath, a fieldset showign opt-ins
    
    DO WE NEED A TABLE SHWOING TAGS???
    </ul>
<code>For JQuery, we need a datepicker, a nickname, a drop down county list, default conutry to UK, modalbox,  </code>


    anything else? Check in the trello board<br/><br/><br/>"

    <p>BACKEND: This si the data that we need ot trrieve </p>
    <ul>
        <li>contact record where Id = contactId</li>
        <li>contactaxctions where conatcId = ContactId</li>
        <li>vehicles where conatcId = ContactId</li>
        <li>communications where conatcId = ContactId</li>
        <li>relationships (contactJoin) where conatcId = ContactId</li>
    </ul>

    
    
    ===============================================
    <code>
    ok, this page is the same for all contacts, however the fieldset area is either /fieldset/organisation or /fieldset/cindividual
    
    should we also have tables like this?
    
    shoudl we create the opt-in part as fieldset too?
    
    
    
    
    </code>

-->