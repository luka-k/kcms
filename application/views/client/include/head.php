<!DOCTYPE html>
<html>
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=0.3">
		
		<link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
        
        <title><?=$title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="keywords" content="<?=$meta_keywords?>" />
		<meta name="description" content="<?=$meta_description?>" />
        
        <link href="<?=base_url()?>template/client/fancybox/jquery.fancybox.css?v=2.1.5" rel="stylesheet" media="screen, projection">
        <link href="<?=base_url()?>template/client/css/reset.css" rel="stylesheet" media="screen, projection">
        <link href="<?=base_url()?>template/client/css/style.css" rel="stylesheet" media="screen, projection">
        <link href="<?=base_url()?>template/client/css/font-style.css" rel="stylesheet" media="screen, projection">
         
        <script src="<?=base_url()?>template/client/js/jquery-1.10.2.min.js"></script>
        <script src="<?=base_url()?>template/client/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
        <script src="<?=base_url()?>template/client/js/jquery.mousewheel-3.0.6.pack.js"></script>  
        <script src="<?=base_url()?>template/client/js/jquery.maskedinput.min.js"></script>
        <script src="<?=base_url()?>template/client/js/jquery.easing.1.3.js"></script>
		
		<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
		
        <script src="<?=base_url()?>template/client/js/script.js"></script>
        
        <!--[if lte IE 6 ]><script type="text/javascript">window.location.href="ie6_close/index_ru.html";</script><![endif]-->
        
        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <!--[if lt IE 9]>
            <style type="text/css">
                input[type="text"] {
                    line-height: 40px;
                    padding-top: 2px;
                }
            </style>
        <![endif]-->
		
		<script type="text/javascript">
			$(document).ready(function() {
				$('.fancybox').fancybox();
				
			$(".mask").mask("+7 (999) 999-9999");	
				
			});
		</script>
    
    </head>
