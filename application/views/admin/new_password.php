<!DOCTYPE html>
<html>
	<?require 'include/head.php'?>
	<body>
		<div id="page" class="grid flex">
			<div class="col_12 center">
				<div class="clearfix" style="width:40%; margin:0 auto">
					<?php echo validation_errors(); ?>
					<form  method="post" id="new_password_form" accept-charset="utf-8" action="<?=base_url()?>admin/registration/change_password"/>
						<p><input type="hidden" name="user_email" value="<?=$email?>"/></p>
						<p><input type="hidden" name="secret" value="<?=$secret?>"/></p>
					
						<p><label>Введите новый пароль</label></p>
						<p><input id="text1" type="password" placeholder="Введите пароль" name ="password" class="col_12 require"/></p>	
					
						<p><label>Подтвердите пароль</label><p/>
						<p><input id="text1" type="password" placeholder="Введите пароль" name ="conf_password" class="col_12 require"/></p>

						<button class="col_4 small" onclick="submit_form('new_password_form'); return false;">Войти</button>
					</form>
				</div>
			</div>
		</div>
		<?require 'include/footer.php'?>
	</body>
</html>