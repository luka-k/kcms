<html>
	<head>
		<title><?=$meta_title ? $meta_title : $title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="<?=$meta_keywords?>" />
		<meta name="description" content="<?=$meta_description?>" />
		<base href="<?= base_url() ?>" />
		
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/css/kickstart.css" media="all" />                  <!-- KICKSTART -->
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/css/style.css" media="all" />                          <!-- CUSTOM STYLES -->
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/css/responsive.css" media="all" />   
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/fancybox/source/jquery.fancybox.css" media="all" /> <!--fancybox css-->
		
		<link href="<?=base_url()?>template/client/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
			
		<link href="<?=base_url()?>template/client/js/ui/jquery-ui.min.css" rel="stylesheet" />
		
		<link href='http://fonts.googleapis.com/css?family=Exo+2:400,700,500,400italic&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
		
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/script.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/kickstart.js"></script>                            <!-- KICKSTART -->
		<script type="text/javascript" src="<?=base_url()?>template/client/js/cart.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/ui/jquery-ui.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/fancybox/source/jquery.fancybox.pack.js"></script> <!--fancybox js-->
		
		<script type="text/javascript" src="<?=base_url()?>template/client/js/cloud.js"></script>

		<script>
			function autocomp(value){
				var data = {};
				data.value = value;
				
				var json_str = JSON.stringify(data);
				$.post("/ajax/autocomplete/", json_str, autocomp_answer, 'json');
			}
		
			function autocomp_answer(res){
				var availableTags = res.available_tags;
		
				$("#search_input").autocomplete({
					source: availableTags,
					select: function( event, ui ) {
						$('.search').val(ui.item.value);
						$('#searchform').submit();
					}
				});
			}
			

			jQuery(document).ready(function($){
				element = document.getElementById('left-col');
				var height = element.offsetHeight;
				if (!document.getElementById('content-2') && document.getElementById('content').offsetHeight < height)
					document.getElementById('content').style.height = height;
			});
		</script>
	</head>
	<body>