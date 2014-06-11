<html>
	<head>
		<title><?=$page->meta_title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="<?php echo base_url()?>template/js/jquery.js"></script>
		<link xmlns="" rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/css/style.css" media="screen">
	</head>
	<body>
		<? require 'menu.php' ?>
		<div>
			<h1><?=$page->title?></h1>
			<?=$page->full_text?>
		</div>
	</body>
</html>