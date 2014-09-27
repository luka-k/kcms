	<head>
		<title><?=$title?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="description" content="" />
		<meta name="copyright" content="" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/admin/css/kickstart.css" media="all" />		<!-- KICKSTART -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/admin/css/style.css" media="all" />			<!-- CUSTOM STYLES -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>template/admin/js/kickstart.js"></script>    	
		<script type="text/javascript" src="<?=base_url()?>template/admin/js/tinymce/tinymce.min.js"></script>
		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
		
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.js"></script>
		
		<!--FANCYBOX-->
		<script type="text/javascript" src="<?=base_url()?>template/admin/fancybox/source/jquery.fancybox.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/admin/fancybox/source/jquery.fancybox.css" media="all" />
		
		<script type="text/javascript">			
			$(function() {
				$('#sortable').sortable({cursor:'move'});
				$('#sortable').sortable({cursorAt:{left:5}})
				$('#sortable').sortable({
					axis: 'y',
					update: function (event, ui) {
						var data = $(this).sortable('serialize');
						$.ajax({
							data: data,
							type: 'POST',
							url: '/ajax/sortable'
						});
					}
				});
			});
		</script>
	
	</head>