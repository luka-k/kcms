<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
		<div id="page" class="grid flex">
			<div class="col_12 center">
				Вход в KCMS<br/>
				<?=$error;?>
				<div class="clearfix" style="width:230px; margin:0 auto">
					<form method="post" accept-charset="utf-8" action="<?=base_url()?>registration/do_admin_enter"/>
						<input id="text1" type="text" placeholder="Введите логин" name="email" class="col_12"/>
						<input id="text2" type="password" placeholder="Введите пароль" name ="password" class="col_12"/>
						<button type="submit" class="col_4 small">Войти</button>
						<div class="col_8 right">
							<a href="<?=base_url()?>registration/forgot_pass">Забыли пароль?</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<? require 'footer.php' ?>
	</body>
</html>

