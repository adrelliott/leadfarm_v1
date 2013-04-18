

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