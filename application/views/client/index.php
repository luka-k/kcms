<!DOCTYPE html>
<html>
	<head>
		<title><?=$title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/client/css/kickstart.css" media="all" /> <!--kickstart css-->
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/client/css/normalize.css" media="all" />
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/client/js/jquery-ui/jquery-ui.css" media="all" /> <!--jquery-ui css-->
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/client/css/style.css" media="all" /> <!--custom css-->
		
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.min.js"></script> <!--jquery js-->
		<script type="text/javascript" src="<?=base_url()?>template/client/js/kickstart.js"></script>  <!--kickstart js-->
		<script type="text/javascript" src="<?=base_url()?>template/client/js/script.js"></script> <!--jquery js-->
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery-ui/jquery-ui.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery-ui/ru.js"></script>	
	</head>

	<body>
		<div id="content" class="grid flex">
			<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="login_form" class="form" action="<?=base_url()?>account/enter/" >
				<ul id="menu" class="menu col_12">
					<li class="right"><a href="#" class="login_button" onclick="form_submit('login_form')">Войти</a></li>
					<li class="right" style="margin-right:5px;"><input type="password" class="col_12 require" name="password" placeholder="Пароль"></li>
					<li class="right"><input type="text" class="col_12 require" name="login" placeholder="Логин"></li>
				</ul>
			</form>
			<div class="col_12">
			</div>
		</div>
	</body>
</html>