<div class="col_12">
	<div class="col_4">

	</div>
	<div class="col_4 clearfix">
				<div class="col_12 cart">
			<div class="col_4">
				<a href="<?=base_url()?>cart" class="">Корзина</a>
			</div>	
			<div class="col_8">
				В корзине <span id="total_qty"><?=$total_qty?></span> <?=$product_word?>.<br/>
				На сумму <span id="total_price"><?=$total_price?></span><br/>
			</div>
		</div>
	</div>
	<div class="col_4 clearfix">
		<?if($user <> false):?>
			<div class="col_6">
				<a href="<?=base_url()?>/cabinet">Личный кабинета</a>
			</div>
			<div class="col_6">
				<a href="<?=base_url()?>/account/do_exit">Выйти</a>
			</div>
		<?else:?>
			<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="login" action="<?=base_url()?>registration/do_enter/"/>
				<input type="text" name="login" class="col_5" placeholder="Логин"/>
				<input type="password" name="password"  class="col_5" placeholder="Пароль"/>
				<div class="col_6">
					<a href="#" class="button small" onClick="document.forms['login'].submit()">Войти</a>
				</div>
				<div class="col_6">
					<a href="<?=base_url()?>registration/register_user/">Регистрация</a>
				</div>
			</form>
			
		<?endif;?>
	</div>
</div>		