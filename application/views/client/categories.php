<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_8 clearfix">
				<?require 'include/breadcrumbs.php'?> 
				<div class="col_12">
					Сортировать: 
					<a href="<?=$url?>.html?order=title&direction=asc">по возрастанию имени</a>&nbsp;
					<a href="<?=$url?>.html?order=title&direction=desc">по убыванию имени</a>&nbsp;
					<a href="<?=$url?>.html?order=sort&direction=asc">по возрастанию sort</a>&nbsp;
					<a href="<?=$url?>.html?order=sort&direction=desc">по убыванию sort</a>&nbsp;				
				</div>
				<?foreach($content as $category):?>
					<div class="cat-item col_4">
						<h6><a href="<?=$category->full_url?>"><?=$category->title?></a></h6>
						<?if($category->img <> NULL):?>
							<div>
								<a href="<?=$category->full_url?>">
									<img src="<?=$category->img->url?>" />
								</a>
							</div>
						<?endif;?>
						<div><?=$category->description?></div>
					</div>
				<?endforeach;?>
			</div>
			<div class="col_4">
				<?if($user <> false):?>
					<div class="col_12">
						<div class="col_6">
							<a href="<?=base_url()?>/registration/cabinet">Личный кабинета</a>
						</div>
						<div class="col_6">
							<a href="<?=base_url()?>/registration/do_exit">Выйти</a>
						</div>
					</div>
				<?else:?>
					<div class="col_12">
						<h5>Войти</h5>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="login" action="<?=base_url()?>registration/do_enter/"/>
							<input type="text" name="login" placeholder="Логин"/></br></br>
							<input type="password" name="password" placeholder="Пароль"/></br></br>
							<a href="#" class="button small" onClick="document.forms['login'].submit()">Войти</a>
						</form>
						<div class="col_6">
							<a href="<?=base_url()?>registration/register_user/">Регистрация</a>
						</div>
						<div class="col_6">
							<a href="<?=base_url()?>registration/forgot_password/">Забыли пароль?</a>
						</div>
					</div>
				<?endif;?>
				
				<div class="cart">
					<h5>Корзина</h5>
					В корзине <?=$total_qty?> товаров.<br/>
					На сумму <?=$total_price?><br/>
					<a href="<?=base_url()?>/pages/cart">Оформить заказ</a>
				</div>
				<h5>Каталог продукции</h5>
				<? require 'include/tree.php' ?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>