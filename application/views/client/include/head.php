<html>
	<head>
		<title><?=$title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="<?=$meta_keywords?>" />
		<meta name="description" content="<?=$meta_description?>" />
		<base href="<?= base_url() ?>" />
		
		<link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  <!-- KICKSTART -->
		<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />                          <!-- CUSTOM STYLES -->
		<link rel="stylesheet" type="text/css" href="css/responsive.css" media="all" />   
		
		<link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
		
		<link href='http://fonts.googleapis.com/css?family=Exo+2:400,700,500,400italic&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/kickstart.js"></script>                                  <!-- KICKSTART -->
		<script type="text/javascript" src="<?=base_url()?>template/client/js/cart.js"></script>
		
		<script>
			function change_qty(action, item_id){
				if(item_id != false){
					var target = document.getElementById('qty-'+item_id);
				}else{
					var target = document.getElementById('product_qty');
				}
				
				curValue = target.value;
				
				if (action === '+'){
					target.value = ++curValue;
				}else{
					if (curValue > 1) target.value = --curValue;
				}
				
				if(item_id != false){
					update_cart(item_id, curValue);
				}
			}

		</script>
	</head>
	<body>