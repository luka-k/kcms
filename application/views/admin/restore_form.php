<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
		<div id="page" class="grid flex">
			<div class="col_12 center">
				<div class="clearfix" style="width:40%; margin:0 auto">
					<?=$error;?>
					<?php echo validation_errors(); ?>
					<p>Введите email для востановления пароля:</p>
					<form method="post" accept-charset="utf-8" action="<?=base_url()?>admin/registration/restore_password_mail"/>
						<input id="text" type="text" placeholder="Введите e-mail" name="email" class="col_12"/>
						<button type="submit" class="col_4 small">Востановить</button>
					</form>
				</div>
			</div>
		</div>
		<? require 'include/footer.php' ?>
	</body>
</html>