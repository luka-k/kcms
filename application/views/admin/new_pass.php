<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
		<div id="page" class="grid flex">
			<div class="col_12 center">
				<div class="clearfix" style="width:40%; margin:0 auto">
					<?php echo validation_errors(); ?>
					<form  method="post" accept-charset="utf-8" action="<?=base_url()?>admin/change_pwd"/>
						<p><input type="hidden" name="user_email" value="<?=$email?>"/></p>
						<p><input type="hidden" name="secret" value="<?=$secret?>"/></p>
					
						<p><label>Введите новый пароль</label></p>
						<p><input id="text1" type="password" placeholder="Введите пароль" name ="password" class="col_12"/></p>	
					
						<p><label>Подтвердите пароль</label><p/>
						<p><input id="text1" type="password" placeholder="Введите пароль" name ="conf_password" class="col_12"/></p>

						<button type="submit" class="col_4 small">Войти</button>
					</form>
				</div>
			</div>
		</div>
		<? require 'footer.php' ?>
	</body>
</html>