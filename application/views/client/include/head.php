<html>
	<head>
		<title><?=$title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="<?=$meta_keywords?>" />
		<meta name="description" content="<?=$meta_description?>" />
		<base href="<?= base_url() ?>" />
		
		<link rel="stylesheet" type="text/css" href="/css/kickstart.css" media="all" />                  <!-- KICKSTART -->
		<link rel="stylesheet" type="text/css" href="/css/style.css" media="all" />                          <!-- CUSTOM STYLES -->
		<link rel="stylesheet" type="text/css" href="/css/responsive.css" media="all" />   
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/fancybox/source/jquery.fancybox.css" media="all" /> <!--fancybox css-->
		
		<link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
			
		<link href="<?=base_url()?>template/client/js/ui/jquery-ui.min.css" rel="stylesheet" />
		
		<!--<link href='http://fonts.googleapis.com/css?family=Exo+2:400,700,500,400italic&subset=cyrillic,latin' rel='stylesheet' type='text/css'>-->
		
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.js"></script>
		<script type="text/javascript" src="js/kickstart.js"></script>                            <!-- KICKSTART -->
		<script type="text/javascript" src="<?=base_url()?>template/client/js/cart.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/ui/jquery-ui.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/fancybox/source/jquery.fancybox.pack.js"></script> <!--fancybox js-->
		
		<script type="text/javascript" src="<?=base_url()?>template/client/js/cloud.js"></script>
		
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
	
		<script>
			function autocomp(){
				var data = {};
				data.r = " ";
				var json_str = JSON.stringify(data);
				$.post("/ajax/autocomplete/", json_str, autocomp_answer, 'json');
			}
		
			function autocomp_answer(res){
				var availableTags = res.available_tags;
		
				$("#search_input").autocomplete({
					source: availableTags
				});
			}
</script>
<script>
var aside = document.getElementById('cart-top'),
    t0 = aside.getBoundingClientRect().top - document.documentElement.getBoundingClientRect().top; // отступ от верхнего края окна браузера до элемента
    // window.pageYOffset - прокрутка веб-документа
window.addEventListener('scroll', function(e) {
  aside.className = (t0 < window.pageYOffset ? 'cart-top col_4' : 'cart col_4');
}, false);
</script>
	</head>
	<body>