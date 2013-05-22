<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Opportunity Details</a></h2></li>
                    <li style="<?php echo $display_none; ?>"><h2><a href="#tab-2">Files Uploaded</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Create/edit an Opportunity for this contact</h3>
                        <div class="form">
                            <?php echo form_open( "/lead/add/edit/$rID/$ContactId") ; ?>
                                <?php echo display_field($fields['OpportunityTitle']); ?>
                                <?php echo display_field($fields['ContactID'], array('type'=> 'hidden', 'value' => $ContactId)); ?>
                                <?php echo display_field($fields['__LeadType'] ); ?>
                                <?php echo display_field($fields['ProductId'], array('options' => $this->data['view_setup']['product_list']) ); ?>
                                <?php echo display_field($fields['OpportunityNotes']); ?>
                                <?php echo display_field($fields['NextActionDate']); ?>
                                <?php echo display_field($fields['UserID'], array('options' => $dropdowns['users'])); ?>  
                            
                            <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div id="tab-2"><!-- Start of tab 1 -->
                        <h3>Upload a file</h3>
                        <?php if($this->session->flashdata('error'))
                            {
                                echo '<h3 style="color:red">Upload failed. ' . $this->session->flashdata('error') . "</h3>"; 
                            }
                            elseif($this->session->flashdata('success'))
                            {
                                echo '<h3 style="color:green">Upload Succeeded</h3>'; 
                            }
                          ?>
                         <?php echo form_open_multipart( "/lead/upload_file/edit/$rID/$ContactId") ; ?>
                        <input type="file" name="_:_userfile" size="20" />
                            <div class="clearfix margin_top_15 margin_bottom_15">
                                    <input name='submit' type='submit' class='button blue left large' style='float:left' value='Upload File'></input>
                                </div>                            
                            <?php echo form_close(); ?>
                        <hr />
                        <h3>Files Uploaded</h3>
                        <h4>These are the files associated with this lead.</h4>
                        <h4>Just click the link to download the file</h4>
                        <ul class="margin_top_15 disc">
                            <?php 
                            $files = $this->data['view_setup']['tables']['files']['table_data'];
                            $html = '';
                            foreach ($files as $file => $attr)
                            {
                                $file_name = $attr['FileName'] . $attr['Extension'];
                                $link = anchor('filebox/download/' . $attr['Id'], '(Download File)');
                                $html .= '<li style="font-size:1.3em; color:blue; margin:10px">' . $file_name . ' '.$link.'</li>';
                            }
                            echo $html;
                            ?>
                        </ol>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div>
<?php print_array($this->data); ?>