<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Help!</h2>
            <div class="widget_inside">
                <div class="form">
                    <?php echo form_open(DATAOWNER_ID . "/help/add/thanks/") ; ?>
                        <div class="clearfix">
                            <label>What's your beef, chief?</label>
                            <div class="input">
                                <input type="radio" name="problem" value="Found a Bug">Found a Bug</input>
                                <input type="radio" name="problem" value="Found a Broken Link">Broken link</input>
                                <input type="radio" name="problem" value="Had an Idea">Feature/Improvement request</input>
                                <input type="radio" name="problem" value="Wanted Some Help" checked="checked">I'm stuck</input>  
                            </div>
                        </div>
                        <div class="clearfix">
                            <label>This was the page you were on:</label>
                            <div class="input">
                                <input class="xxxXlarge" readonly="readonly" type="text" name="url" value="<?php echo $this->data['view_setup']['temp']['lastpage']; ?>" />
                            </div>
                        </div>
                        <div class="clearfix">
                            <label>Your Email/Phone</label>
                            <div class="input">
                                <input class="xxlarge" type="text" rel="tooltips" title="Type carefully - Our reply goes here!" name="from" value="<?php echo $this->data['view_setup']['user_data']['Email']; ?>" />
                                 or <input class="large" type="text" name="phone" value="<?php echo $this->data['view_setup']['user_data']['Phone1']; ?>" />
                            </div>
                        </div>
                        <div class="clearfix">
                            <label>Your Name</label>
                            <div class="input">
                                <input class="xlarge" type="text" name="name"  value="<?php echo $this->data['view_setup']['user_data']['FirstName'] . ' ' . $this->data['view_setup']['user_data']['LastName']; ?>" />
                            </div>
                        </div>
                        <div class="clearfix">
                            <label>Is it URGENT?</label>
                            <div class="input">
                                <input type="radio" name="response" value="phone">Yes! Please call me ASAP!!</input>
                                <input type="radio" name="response" value="email" checked="checked">Nope, email response is fine</input>                                
                            </div>
                        </div>
                        <div class="clearfix">
                            <label>Can you describe the issue in more depth?</label>
                            <div class="input"><textarea class="xxxxxlarge" name="indepth" rows=20 placeholder="Tell us what's on your mind..."></textarea></div>
                        </div>
                        <div class="clearfix">
                            <input name='submit' type='submit' class='button blue right large ' style='float:right' value='Send Help Request'></input>
                        </div>                            
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>