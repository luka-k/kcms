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
				<?foreach($content as $page):?>
						<div class="cat-item col_4">
							<h6><a href="<?=$page->full_url?>"><?=$page->name?></a></h6>
							<?if($page->img <> NULL):?>
								<div>
									<a href="<?=$page->full_url?>">
										<img src="<?=$page->img[0]->url?>" />
									</a>
								</div>
							<?endif;?>
							<div><?=$page->description?></div>
							<div class="left">
								<div>Цена:<?=$page->price?></div>
								<?if(isset($page->sale_price)):?>
									<div>Цена со скидкой:<?=$page->sale_price?></div>
								<?endif;?>
							</div>
							<div class="right">
								<a href="#" class="button small red" onclick="add_to_cart(<?=$page->id?>); return false">В корзину</a>
								<a href="#" class="button small green" onclick="add_to_wishlist('<?=$page->id?>'); return false">В вишлист</a>
							</div>
						</div>	
				<?endforeach;?>
			</div>
			<div class="col_4">
				<?if($user <> false):?>
					<div class="col_12">
						<div class="col_6">
							<a href="<?=base_url()?>cabinet">Личный кабинета</a>
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
					В корзине <span id="total_qty"><?=$total_qty?></span> <?=$product_word?>.<br/>
					На сумму <span id="total_price"><?=$total_price?></span><br/>
					<a href="<?=base_url()?>cart">Оформить заказ</a>
				</div>
				<h5>Каталог продукции</h5>
				<? require 'include/tree.php' ?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>