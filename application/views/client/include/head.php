<head>
	<title><?=$title?></title>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<meta name="generator" content=""/>
	<meta http-equiv="X-UA-Compatible" content="IE=8"/>
	
	<link rel="shortcut icon" href="http://lt-pro.ru/favicon.ico">
 
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/fancybox/source/jquery.fancybox.css" media="all" /> <!--fancybox css-->
	<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/client/css/style.css" media="all" />  <!--custom css-->
		  
    <link type="text/css" rel="stylesheet" href="<?=base_url()?>template/client/css/slider.css?v3"  media="screen" />

	<!--[if IE9]>
      <link rel="stylesheet" href="<?=base_url()?>template/client/css/style.css?<?php echo rand(100, 200); ?>"  type="text/css"/>
    <![endif]-->

	<!--[if IE10]>
      <link rel="stylesheet" href="<?=base_url()?>template/client/css/style.css?<?php echo rand(100, 200); ?>"  type="text/css"/>
    <![endif]-->
	
    <!--[if IE]>
	
    <style type="text/css">

	#menu .iehover ul{
		position:absolute;  
		display:block;
		border:1px solid #D9B5C7;
		border-radius:0 7px 7px 7px;
		-webkit-border-radius:0 7px 7px 7px;
		-moz-border-radius:0 7px 7px 7px;
		-khtml-border-radius:0 7px 7px 7px;
		width:150px;
		margin-top:26px;margin-left:-1px;
		clear:left;
		z-index:2000;
	}

    #menu .iehover a
     {
     position:relative;
     color:#BB437D;
     border-bottom:1px solid #fff;
     background:#ffffff;
     z-index:3000;
    }
	
    #menu li ul{position:absolute;left:0;top:0;margin-top:28px;width:160px;background-color:#fff;color:#333;display:none;border-left:1px solid #EDEDED;border-right:1px solid #EDEDED;border-bottom:1px solid #EDEDED;}
    #menu li ul li{display:inline;list-style-type:none;padding:0;}
	#menu li:hover ul{display:block;}
    #menu li ul li:first-child{border-top:none;}
    #menu li ul li a{line-height:normal;display:block;color:#000000;padding-top:7px;padding-bottom:7px;}
    #menu ul li.flagslist{border-right:1px solid #EDEDED;}
    #menu li ul li a:hover{color:#000000; border-bottom:1px solid #fff;}
	 
	#lead 
     {
     width:275px;
     margin:20px 0;
     padding:0 20px 20px 20px;
     border: 1px solid #959398;
     background-color:#FFF;
     border-radius:6px;
     -moz-box-shadow: 1px 1px 2px rgba(0,0,0,0.3); 
     -webkit-box-shadow: 1px 1px 2px  rgba(0,0,0,0.3); 
     box-shadow: 1px 1px 2px rgba(0,0,0,0.3); 
     float:left;
    }
 
    #left_col  div.tabcontents 
     {
     border: 1px solid #959398; 
	 margin-top:-1px;
     padding: 10px 20px;
     background-color:#FFF;
     font-family:"Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
     font-size:13px;
     border-radius: 0 6px 6px 6px;
     -moz-box-shadow: 1px 1px 2px rgba(0,0,0,0.3); 
     -webkit-box-shadow: 1px 1px 2px  rgba(0,0,0,0.3); 
     box-shadow: 1px 1px 2px rgba(0,0,0,0.3);
     text-align:left;
    } 
	
    #right_col div.tabcontents 
     {
     border: 1px solid #959398; 
	 margin-top:-1px;
     padding: 10px 20px;
     background-color:#FFF;
     font-family:"Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
     font-size:13px;
     border-radius: 0 6px 6px 6px;
     -moz-box-shadow: 1px 1px 2px rgba(0,0,0,0.3); 
     -webkit-box-shadow: 1px 1px 2px  rgba(0,0,0,0.3); 
     box-shadow: 1px 1px 2px rgba(0,0,0,0.3);
     text-align:left;
     }
	
    #social  div.tabcontents 
     {
     border: 1px solid #959398; 
	 margin-top:-1px;
     padding: 10px 20px;
     background-color:#FFF;
     font-family:"Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
     font-size:13px;
     border-radius: 0 6px 6px 6px;
     -moz-box-shadow: 1px 1px 2px rgba(0,0,0,0.3); 
     -webkit-box-shadow: 1px 1px 2px  rgba(0,0,0,0.3); 
     box-shadow: 1px 1px 2px rgba(0,0,0,0.3);
     text-align:left;
    } 
	.icon-ltpro {
		height:24px;
	}
	
#left_menu a
  {
  padding:10px;
  margin:0;
  font: normal 0.8em Verdana;
  color:#000000;
  text-decoration:none;
  display:block;
  }
  
  .wysija-submit
  {
   border:none;
   background: #B63874;
 background: -moz-linear-gradient(top, #B63874, #CF86AC);
 background: -webkit-gradient(linear, left top, left bottom,color-stop(0%,#B63874), color-stop(100%,#CF86AC));
 background: -webkit-linear-gradient(top, #B63874, #CF86AC);
 background: -o-linear-gradient(top, #B63874, #CF86AC); 
 background: -ms-linear-gradient(top, #B63874, #CF86AC); 
 background: linear-gradient(top, #B63874, #CF86AC); 
  background: #B63874;
  }
    </style>
 
    <![endif]-->
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/tabcontent.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.accordion.js"></script>
	<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.easing.1.3.js"></script>   
	<script type="text/javascript" src="<?=base_url()?>template/client/js/slideshow.js"></script>   

	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/PIE_IE678.js"></script>
	<![endif]-->
	<!--[if IE 9]>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/PIE_IE9.js"></script>
	<![endif]-->
	
	<script>
		$(function() {
			if (window.PIE) {
				$('.rounded, button, input').each(function() {
					PIE.attach(this);
				});
			}
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#st-accordion').accordion();
		});

		function cssmenuhover()
		{
			if(!document.getElementById("menu-top_menu")) return;
			var lis = document.getElementById("menu-top_menu").getElementsByTagName("LI");
			for (var i=0;i<lis.length;i++)
			{
                lis[i].onmouseover=function(){this.className+=" iehover";}
                lis[i].onmouseout=function() {this.className=this.className.replace(new RegExp(" iehover\\b"), "");}
			}
		}
		
		if (window.attachEvent) window.attachEvent("onload", cssmenuhover);
	</script>
</head>