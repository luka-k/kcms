<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
		<div id="page" class="grid flex">
			<div class="col_12 center">
				<div class="clearfix" style="width:40%; margin:0 auto">
					Вход в KCMS
					<?=$error;?>
					<form method="post" accept-charset="utf-8" action="<?=base_url()?>registration/do_enter"/>
						<input id="text1" type="text" placeholder="Введите логин" name="email" class="col_12"/>
						<input id="text2" type="password" placeholder="Введите пароль" name ="pass" class="col_12"/>
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

