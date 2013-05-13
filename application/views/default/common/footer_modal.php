

<?php if (isset($_GET['debug'])) : ?>
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

