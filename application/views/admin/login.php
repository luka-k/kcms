<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
		<div id="page" class="grid flex">
			<div class="col_12 center">
				Вход в KCMS<br/>
				<?=$error;?>
				<div class="clearfix" style="width:230px; margin:0 auto">
					<form method="post" id="login_form" accept-charset="utf-8" action="<?=base_url()?>admin/registration/do_enter"/>
						<input id="text1" type="text" placeholder="Введите логин" name="email" data-id="require" class="col_12 validation"/>
						<input id="text2" type="password" placeholder="Введите пароль" name ="password" data-id="require" class="col_12 validation" autocomplete="off"/>
						
						<button class="col_4 small" onclick="submit_form('login_form'); return false;">Войти</button>
						
						<div class="col_8 right">
							<a href="<?=base_url()?>admin/registration/restore_password">Забыли пароль?</a>
						</div>
						
						<div class="col_12">
							<a href="<?=base_url()?>">Перейти на сайт</a>
						</div>
					</form>
				</div>
			</div>
		</div>
		<? require 'include/footer.php' ?>
	</body>
</html>

