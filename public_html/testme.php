
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<title>Pure CSS3 Forms Set</title>
		<link rel="stylesheet" href="assets/scripts/PCSS3/css/main.css" />
		<link rel="stylesheet" href="assets/scripts/PCSS3/css/pcss3fs.css" />
		<script src="assets/scripts/PCSS3/js/jquery-1.9.1.min.js"></script>
		<script src="assets/scripts/PCSS3/js/jquery.maskedinput.min.js"></script>
		<!--[if lt IE 9]>
			<link rel="stylesheet" href="assets/scripts/PCSS3/css/pcss3fs-ie8.css" />
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="assets/scripts/PCSS3/js/ie8.js"></script>
		<![endif]-->
	</head>
	<body>
		<h1>Pure CSS3 <strong>Forms Set</strong> + Validation and Masking</h1>
		
		<form action="" id="form" class="pcss3f pcss3f-vm">
			<header>Available <strong>masking</strong> rules</header>
			
			<section class="state-normal">
				<label for="date">Date masking</label>
				<input type="text" name="date" id="date">
			</section>
			
			<section class="state-normal">
				<label for="phone">Phone masking</label>
				<input type="tel" name="phone" id="phone">
			</section>
			
			<section class="state-normal">
				<label for="card">Credit card masking</label>
				<input type="text" name="card" id="card">
			</section>
			
			<section class="state-normal">
				<label for="serial">Serial number masking</label>
				<input type="text" name="serial" id="serial">
			</section>
			
			<section class="state-normal">
				<label for="tax">Tax ID masking</label>
				<input type="text" name="tax" id="tax">
			</section>
			
			<footer>
				<button type="button" onclick="window.location = 'index.html'">Back</button>
				<button type="submit" class="color-blue">Submit</button>
			</footer>
		</form>
		
		<!-- validation init -->
		<script type="text/javascript">
			$(function()
			{
				$("#date").mask('99/99/9999', {placeholder:'x'});
				$("#phone").mask('(999) 999-9999', {placeholder:'x'});
				$("#card").mask('9999-9999-9999-9999', {placeholder:'x'});
				$("#serial").mask('***-***-***-***-***-***', {placeholder:'x'});
				$("#tax").mask('99-9999999', {placeholder:'x'});
			});			
		</script>
		<!--/ validation init -->
	</body>
</html>