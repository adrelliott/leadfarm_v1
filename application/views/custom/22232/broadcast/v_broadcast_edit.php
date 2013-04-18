
<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Find Campaigns</h2>
            <div class="widget_inside">   
                <!-- Wizard Container -->
                <div id="wizard" class="wizard-default-style js">
                    <!-- Steps Navigation -->
                    <ul class="steps">
                        <li>1. Templates</li>
                        <li>2. Recipients</li>
                        <li>3. Content</li>
                        <li>4. Preview & Send</li>
                    </ul>
                    <!-- </Steps Navigation -->

                    <!-- Step Content Container -->
                    <div class="step_content">

                        <!-- Wizard - Step 1 -->
                        <div id="step-1" class="step two_column">
                            <div class="column_one">
                                <!-- Helper -->
                                <div id="help-step1" class="helper">
                                    <div class="text">
                                        <h3>Want something different?</h3>
                                        <p>No Problem.</p>
                                        <p>You'll need to speak to your campaign manager who will get someone to put one together for you.</p>
                                        <p>Just click on the 'help' icon (top right of the screen) to start a support ticket.</p>
                                    </div>
                                </div>
                                <!-- </Helper -->
                                <h4>Choose your template</h4>
                                <p>Choose one of the email templates on the right.</p>
                                <p>You can click on the thumbnail to see a larger image preview</p>
                            </div>
                            <div class="column_two">
                                <ul class="gallery">
                                    <li>
                                        <a href="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>" class=" iframe ">
                                            <img src="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>">
                                        </a>
                                        <input type="radio" name="TemplateId" value="image1">Select
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>" class=" iframe ">
                                            <img src="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>">
                                        </a>
                                        <input type="radio" name="TemplateId" value="image2">Select
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>" class=" iframe ">
                                            <img src="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>">
                                        </a>
                                        <input type="radio" name="TemplateId" value="image3">Select
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>" class=" iframe ">
                                            <img src="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>">
                                        </a>
                                        <input type="radio" name="TemplateId" value="image4">Select
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>" class=" iframe ">
                                            <img src="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>">
                                        </a>
                                        <input type="radio" name="TemplateId" value="image5">Select
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>" class=" iframe ">
                                            <img src="<?php echo site_url( '/assets/includes/templates/template.jpg' ); ?>">
                                        </a>
                                        <input type="radio" name="TemplateId" value="image5">Select
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                                 <a href="#help-step1" class="show_helper"><h4>I don't fancy any of these...</h4></a>
                                <button class="next right"><span>Next Step</span></button> 
                            </div>

                        </div>
                        <!-- </Wizard - Step 1 -->
                        
                        <!-- Wizard - Step 2 -->
                        <div id="step-2" class="step two_column">
                            <div class="column_one">
                                <!-- Helper -->
                                <div id="help-step2" class="helper">
                                    <div class="text">
                                        <h3>Want something different?</h3>
                                        <p>No Problem.</p>
                                        <p>You'll need to speak to your campaign manager who will get someone to put one together for you.</p>
                                        <p>Just click on the 'help' icon (top right of the screen) to start a support ticket.</p>
                                    </div>
                                </div>
                                <!-- </Helper -->
                                <h4>Choose who is going to get this email</h4>
                                <p>You have 3 options:</p>
                                <ul>
                                    <li>1. Do a search for contacts</li>
                                    <li>2. Use a saved search</li>
                                    <li>3. Find contacts who have been tagged</li>
                                </ul>
                                <p>If you're having trouble, just click the 'Help' icon (top right of your screen) to start a support ticket</p>
                            </div>
                            
                            <div class="column_two">
                                <!-- Content Here -->
                                <div class="row clearfix">
                                    <div class="col_12">
                                        <div class="widget clearfix">
                                            <h2>Contact Search</h2>
                                            <div class="widget_inside">

                                                <?php
                                                //$this->load->model('comms_model');
                                                $this->comms_model->test(); die;
                                                ?>

                                                <form id="contact-search" method="post" action="<?php echo html_escape($_SERVER['REQUEST_URI']) ?>"></form>

                                                <script type="text/javascript">
                                jQuery (document).ready (function ($) {
                                    var options;
                                    var plugin;

                                    options = {
                                        'operations' : <?php echo json_encode($this->contactsearch_model->get_valid_operations()) ?>,
                                        'tags' : <?php echo json_encode($this->tags_model->get()) ?>,
                                        'fields' : <?php echo json_encode($this->contactsearch_model->get_valid_fields()) ?>,
                                        'searches' : <?php echo json_encode($this->contactsearch_model->get()) ?>
                                    };

                                    $('#contact-search').contactsearch (options);

                                    plugin = $('#contact-search').data ('contactsearch');

<?php if ($this->contactsearch_model->get_id()): ?>
                                        plugin.setSearch (<?php echo json_encode($this->contactsearch_model->get_id()) ?>, <?php echo json_encode($this->contactsearch_model->get_name()) ?>);
<?php endif; ?>

                                    plugin.setCriteria (<?php echo json_encode($this->contactsearch_model->get_criteria()) ?>);
                                    plugin.includeTags (<?php echo json_encode($this->contactsearch_model->get_included_tag_ids()) ?>);
                                    plugin.excludeTags (<?php echo json_encode($this->contactsearch_model->get_excluded_tag_ids()) ?>);
                                    plugin.start ();

                                });
                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                
                            </div>

                        </div>
                        <!-- </Wizard - Step 2 -->
                        
                        <!-- Wizard - Step 3 -->
                        <div id="step-3" class="step one_column">

                            <div class="column_one">
                                <!-- Content Here -->
                                hello content 3
                                <button class="prev"><span>Previous Step</span></button>
                                <button class="next"><span>Next Step</span></button> 
                            </div>

                        </div>
                        <!-- </Wizard - Step 3 -->
                        
                        <!-- Wizard - Step 4 -->
                        <div id="step-4" class="step one_column">

                            <div class="column_one">
                                <!-- Content Here -->
                                hello content 4
                                <button class="prev"><span>Previous Step</span></button>
                            </div>

                        </div>
                        <!-- </Wizard - Step 4 -->


                    </div>
                    <!-- </Step Content Container -->

                    <!-- Display the following when Javascript is disabled -->
                    <div class="no_javascript">
                        <img src="assets/img/warning.png" alt="Javascript Required" />
                        <p>Javascript is required in order to use this wizard. <br />
                            <a href="https://www.google.com/support/adsense/bin/answer.py?answer=12654">How to enable javascript</a>
                            -
                            <a href="http://www.mozilla.com/firefox/">Upgrade Browser</a></p>
                    </div>
                </div>
                <!-- </End Wizard Container -->
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
		$(document).ready(function(){
			$("#wizard").wizardPro();
		});
	</script>