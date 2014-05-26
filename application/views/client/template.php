<html>
	<head>
		<title><?=$meta_title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="<?php echo base_url()?>template/js/jquery.js"></script>
		<link xmlns="" rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/css/style.css" media="screen">
	</head>
	<body>
		<?=$this->menu->view("top_menu")?>
		<div>
			<h1><?=$title?></h1>
			<?=$full_text?>
		</div>
	</body>
</html>