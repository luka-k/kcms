<html>
	<head>
		<title><?=$cat_info->meta_title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<script type="text/javascript" src="<?php echo base_url()?>template/js/jquery.js"></script>
		<link xmlns="" rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/css/style.css" media="screen">
	</head>
	<body>
		<? require 'menu.php' ?>
		<div>
			<h1><?=$cat_info->title?></h1>
			<?=$cat_info->description?>
		</div>
		<div>
			<?foreach ($pages as $page):?>
				<div>
					<h2><?=$page->title?></h2>
				</div>
				<div>
					<?=$page->full_text?>
				</div>
			<?endforeach;?>
		</div>
	</body>
</html>