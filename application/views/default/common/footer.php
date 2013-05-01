                </div><!-- End Body -->
            </div><!-- End main-->
        </div><!--container -->
    </div>
    <footer>
        <div class="container">
            <div class="row clearfix">
                <div class="col_12">
                    <span class="left">&copy; 2009 - <?php echo date("Y") ?> Dallas Matthews Ltd.</span>
                    <span class="right">Dallas Matthews are <a href="http://DallasMatthews.co.uk">Relationship Marketing</a> Experts based in Manchester, UK.</span>
                </div>
            </div>
        </div>
    </footer>
    </body>
</html>

<?php if (strpos( ENVIRONMENT , 'development') OR isset($_GET['debug'])) : ?>
<pre>here is CI session
<?php print_r($this->session->all_userdata()); ?>
</pre>
<pre>here is native session
<?php print_r($_SESSION); ?>
</pre>
<pre>here is data:
<?php print_r($this->data);?>
</pre>
<?php endif; ?>

