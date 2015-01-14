<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<meta name="description" content="<?=$meta_description?>">
    <meta name="viewport" content="width=1000">
	
	<!--<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon"> -->

    <!-- Стили popup -->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>template/client/fancybox/jquery.fancybox.css?v=2.1.5" />

    <link rel="stylesheet" href="<?=base_url()?>template/client/css/normalize.css">
    <link rel="stylesheet" href="<?=base_url()?>template/client/css/style.css">
	
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	
	
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
				source: availableTags,
				select: function( event, ui ) {
					$('.search').val(ui.item.value);
					$('#searchform').submit();
				}
			});
		}		
	</script>
</head>