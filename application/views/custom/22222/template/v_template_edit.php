<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Edit/Create a Template</h2>
            <div class="widget_inside">
                <div class="form">
                    <?php echo form_open(DATAOWNER_ID . "/template/add/edit/$rID") ; ?>
                        <?php echo display_field($fields['__Id']); ?>
                        <?php echo display_field($fields['__TemplateName']); ?>
                        <?php echo display_field($fields['__Name']); ?>
                        <div class="clearfix">
                            <label>Sender's Email</label>
                            <div class="input">
                                <input type="text" class="xxxlarge" name="__FromEmail" value="<?php echo $user_data['Email']; ?>" />
                                 Sender's Name 
                                <input type="text" class="medium" name="__FromName" value="<?php echo $user_data['FirstName'] . ' ' . $user_data['LastName']; ?>" />
                            </div>                        
                        </div>
                        <?php echo display_field($fields['__Subject']); ?>
                            <?php echo display_field($fields['__Content'], array
                                ('label' => '
                                    <p><strong>Available Tags:</strong></p>
                                    <p>{{ Contact.FirstName }}</p>
                                    <p>{{ Contact.LastName }}</p>
                                    <p>{{ Contact.Id }}</p>
                                    <p>{{ Contact.Email }}</p>
                                    <p>{{ Contact.Phone1 }}</p>
                                    <p>{{ Contact._TwitterName }}</p>
                                    <p>{{ Contact._OrganisationName }}</p>
                                    <p>{{ Contact._PreferredName }}</p>
                                    <p>{{ Contact.Title }}</p>'
                                )
                            ); ?>
                        <div class="clearfix">
                            <input name='submit' type='submit' class='button blue right large ' style='float:right' value='Save'></input>
                        </div>  
                        <?php 
                            $this->table->set_template_custom(array( 'checkbox_flag' => true, 'checkbox_name' => '_:_contactId[]', 'checkbox_value_is_id' => true));    
                            $this->table->set_heading_custom($tables['contacts']['table_headers']);
                            echo $this->table->generate_custom($tables['contacts']['table_data']); 
                            echo form_submit('submit', 'Send Test Email', 'class="right"');
                            echo form_close();
                        ?>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace( '__Content' );
</script>

<script type="text/javascript" language="javascript">
       
    
    $(document).ready( function (){ 
    
        $("#Button1").click( function(){
        
          var selectedValue = $("#list_of_fields option:selected").val();
               
          alert("Selected Value is: " + selectedValue );
          
        
         });
                        
     });
    
    </script>