	<head>
		<title><?=$meta_title?></title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="description" content="" />
		<meta name="copyright" content="" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/admin/css/kickstart.css" media="all" />		<!-- KICKSTART -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>template/admin/css/style.css" media="all" />			<!-- CUSTOM STYLES -->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>template/admin/js/kickstart.js"></script>    	
		<script type="text/javascript" src="<?=base_url()?>template/admin/js/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector: "textarea",
				language : 'ru',
				plugins:[
					"advlist autolink lists link image charmap print preview anchor searchreplace visualblocks code fullscreen insertdatetime media table contextmenu paste",
				],
				toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
			});
		</script>		
	</head>