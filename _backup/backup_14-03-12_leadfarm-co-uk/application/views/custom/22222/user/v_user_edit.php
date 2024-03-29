<div class="col_12"><!-- Start Column 1-->	
    
    <div class="row clearfix">
        <div class="row"><!-- Tabs begin -->
            <div class="widget clearfix tabs">
                <ul>
                    <li>
                        <h2><a href="#tab-1">Me</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-2">My Profile</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-3">Password</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-4">Notes - test</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <h4>Tasks assigned to me:</h4>
                        <?php 
                            $this->table->set_template_custom(array ('anchor_uri' => 'contactaction/view/edit_action', 'anchor_uri_append' => $ContactId, 'anchor_attr' => 'class="iframe"'));    
                            $this->table->set_heading_custom($tables['all_actions']['table_headers']);
                            echo $this->table->generate_custom($tables['all_actions']['table_data']); 
                        ?> 
                    </div>
                </div>
                <div class="widget_inside">
                    <div id="tab-2">
                        <div class=" col_8">
                            <div class="form">
                                <?php echo form_open(DATAOWNER_ID . '/user/add/0/' . $rID . '/0'); ?>
                                <?php display_field($fields['Title']); ?>
                                <?php display_field($fields['FirstName']); ?>
                                <?php display_field($fields['LastName']); ?>
                                <?php display_field($fields['Nickname']); ?>
                                <?php display_field($fields['Username']); ?>
                                <?php display_field($fields['Email']); ?>
                                <?php display_field($fields['_Signature']); ?>
                                 <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                                </div>
                            </div><!-- End of form div-->
                            <p id="option1_toggle" class="button left">
                                <span>View Opt In Settings</span>
                            </p> 
                            <div class="hide_toggle" id="option1">
                                <div class="form margin_top_30">
                                    <?php display_field($fields['_OptinEmailYN']); ?>
                                    <?php display_field($fields['_OptinSmsYN']); ?>
                                    <?php display_field($fields['_OptinSurfaceMailYN']); ?>
                                    <?php display_field($fields['_OptinNewsletterYN']); ?>
                                    <?php display_field($fields['_OptinPref']); ?>
                                    <div class="clearfix">
                                        <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <div class="col_4 last">
                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            <p>Nulla et feugiat magna. Fusce fringilla purus vitae leo dapibus cursus. Maecenas id purus eget risus mattis volutpat. </p>
                            <p>Fusce in ligula sit amet nisi volutpat volutpat. Mauris varius leo eu massa blandit nec faucibus nibh ullamcorper. Aenean auctor viverra justo eu placerat. Mauris sed lectus nibh. </p>
                            <p>Praesent fermentum, mauris non aliquam fringilla, eros libero tempor ipsum, at pretium urna quam sed est. </p>
                            <p>Nam libero purus, rhoncus a pulvinar a, sollicitudin eget quam. Curabitur semper, leo non tristique eleifend, neque tellus pellentesque leo, in fringilla purus mauris in magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                            <p> Etiam semper tellus in metus dictum pretium.</p>
                        </div>
                    </div>
                </div>
                <div class="widget_inside">
                    <div id="tab-3">
                        <div class="form">
                            <?php echo form_open(DATAOWNER_ID . '/user/change_password/view/' . $rID . '/0'); ?>
                            
                            <div class="clearfix" id=""> 
                                <label class="" id="">Enter your existing password:</label>
                                <div class="input " id="">
                                    <input class="" id="" type="text" name="ExistingPassword" length="" value="">
                                </div>
                            </div>
                             <div class="clearfix" id="">
                                <label class="" id="">Enter new password:</label>
                                <div class="input " id="">
                                    <input class="" id="" type="text" name="Password" length="" value="">
                                </div>
                            </div>
                             <div class="clearfix" id="">
                                <label class="" id="">Enter it again:</label>
                                <div class="input " id="">
                                    <input class="validate[required,equals[Password]]" id="" type="text" name="PasswordCheck" length="" value="">
                                </div>
                            </div>
                             <div class="clearfix">
                                <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                            </div>
                            <?php echo form_close(); ?>
                        </div><!-- End of form div-->
                    </div>
                </div>
                <div class="widget_inside">
                    <div id="tab-4">
                         <?php echo form_open(DATAOWNER_ID . '/user/append_note/0/' . $rID . '/' . $ContactId ); ?>
                            <p>These are the notes for this record.</p>
                            <?php echo display_field($fields['ContactNotes']); ?>
                           <!-- Start field "Add a Note:" -->
                           <div class="clearfix">
                               <h4>Add your new note below</h4>
                               <div class="input">
                                   <textarea class="xxxxlarge green-highlight" id="add_a_note" type="text"  name="add_a_note" rows="5" placeholder="Your note will be automatically datestamped & appended to the notes above" /></textarea>
                               </div>
                           </div>
                           <!-- End field "Add a Note:" -->	
                           <div class="clearfix margin_top_15">
                               <input name='submit' type='submit' id="submit" class='button blue right large' style='float:right' value='Save'></input>
                           </div>
                        <?php echo form_close(); ?>
                    </div>
                    <div id="main_content">
                        <p>content</p>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</div>