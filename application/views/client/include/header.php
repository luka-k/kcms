<div class="col_12">
	<div class="col_4">
	</div>
	<div class="col_4 clearfix">
		<?if($user <> false):?>
			<div class="col_6">
				<a href="<?=base_url()?>/cabinet">Личный кабинета</a>
			</div>
			<div class="col_6">
				<a href="<?=base_url()?>/registration/do_exit">Выйти</a>
			</div>
		<?else:?>
			<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="login" action="<?=base_url()?>registration/do_enter/"/>
				<input type="text" name="login" class="col_12" placeholder="Логин"/></br></br>
				<input type="password" name="password"  class="col_12" placeholder="Пароль"/></br></br>
				<a href="#" class="button small" onClick="document.forms['login'].submit()">Войти</a>
			</form>
			<div class="col_6">
				<a href="<?=base_url()?>registration/register_user/">Регистрация</a>
			</div>
			<div class="col_6">
				<a href="<?=base_url()?>registration/forgot_password/">Забыли пароль?</a>
			</div>
		<?endif;?>
	</div>
	<div class="col_4">
		<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="search" action="<?=base_url()?>search"/>
			<input type="text" name="search" class="col_12" placeholder="Поиск" onchange="document.forms['search'].setAttribute('action', '<?=base_url()?>search?name='+this.value); document.forms['search'].submit()"/>
		</form>
	</div>
</div>		