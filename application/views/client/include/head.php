<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="generator" content="" />
		
		<title><?=$title?></title>
		
		<link href="<?=base_url()?>template/client/favicon.ico" rel="shortcut icon" type="" />
		
		<link rel="stylesheet" href="<?=base_url()?>template/client/css/template.css" type="text/css" />
		<link rel="stylesheet" href="<?=base_url()?>template/client/css/stylesheet.css" type="text/css" />
		<link rel="stylesheet" href="<?=base_url()?>template/client/css/gallery.css" type="text/css"/>
	
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery-migrate.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/script.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/cart.js"></script>
	
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		
		<script>
			jQuery(document).ready(function(){
				var params = {
					changedEl: ".select-2",
				}
				cuSel(params);
			});
		</script>
	</head>
	
	<body>