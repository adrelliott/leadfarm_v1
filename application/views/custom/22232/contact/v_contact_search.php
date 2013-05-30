<div class="row clearfix">
    <div class="col_12">
        <div class="margin_bottom_30 clearfix">
            <?php include ( APPPATH . 'views/default/common/display_message.php' );?>
        </div>
        <div class="widget clearfix">            
            <h2>Search</h2>
            <div class="widget_inside">  
                 <?php 
                    if (element('table_headers', $this->data['tables']['search_results']))
                    {
                        $this->table->set_heading_custom($tables['search_results']['table_headers']);
                        echo $this->table->generate_custom($tables['search_results']['table_data']); 
                        echo form_open(site_url('contact/search/1'));
                        echo form_hidden('_::_query', $tables['search_results']['query']);
                        echo form_close();
                        
                        //now create the export form
                        $post_data = $this->data['tables']['search_results']['post_data'];
                        echo form_open('contact/search/export');
                        echo form_hidden('FirstName[operation]', element('operation', $post_data['FirstName'])); 
                        echo form_hidden('FirstName[value]', element('value', $post_data['FirstName'])); 
                        echo form_hidden('LastName[operation]', element('operation', $post_data['LastName'])); 
                        echo form_hidden('LastName[value]', element('value', $post_data['LastName'])); 
                        echo form_submit('_::_submit', 'Export as CSV');
                        echo form_close();
                    }
                    else include('fieldsets/v_contact_searchform.php');
                    ?> 
                <div class="margin_top_15"></div>
                    <div class="clearfix">
                        <a href="<?php echo site_url( 'contact/search' ); ?>" class="large button left"><span>New Search</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo print_array($this->data); ?>