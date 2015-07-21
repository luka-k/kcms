<header>
	<div class="maxw">
		<a href="/"><img class="logo" src="/template/client/images-new/logo.png" /></a>
		
		<div class="catalog-btn">
			<?$url = $_SERVER['HTTP_HOST'];?>
			<?$host = explode('.', $url);?>
			<?if($host[0] == 'shop'):?>
				<a href="http://brightbuild.ru/catalog">Каталог производителей</a>
			<?else:?>
				<a href="http://shop.brightbuild.me/catalog/<?if(isset($shop_link)):?><?=$shop_link?><?endif;?>">
					Интернет магазин<?if(isset($shop_link_title)):?><?=$shop_link_title?><?endif;?>
				</a>
			<?endif;?>
		</div><!--ru-->
		
		
		<div class="top-menu">
			<ul class="clearfix">
				<li class="first <?if($top_active == 'catalog'):?>current<?endif;?>">
					<a href="#">Каталог</a>
					<ul>
						<li class=""><a href="http://brightbuild.me/catalog">Производители</a></li>
						<li class=""><a href="http://brightbuild.me/vendors">Продавцы</a></li>
						<li class=""><a href="http://brightbuild.me/contractors">Подрядчики</a></li>
					</ul>
				</li>
				<li class="<?if($top_active == 'shop'):?>current<?endif;?>">
					<a href="#">Магазин</a>
					<ul>
						<li class=""><a href="http://shop.brightbuild.me/catalog">Товары</a></li>
						<li class=""><a href="http://shop.brightbuild.me/catalog/sale/">Распродажи</a></li>
						<li class=""><a href="<?=base_url()?>">Оплата/Доставка</a></li>
					</ul>
				</li>
				<li class="<?if($top_active == 'inventory'):?>current<?endif;?>"><a href="<?=base_url()?>inventory">Складские остатки</a></li>
				<li class="<?if($top_active == 'bb'):?>current<?endif;?>"><a href="<?=base_url()?>bb">bрайтbилd</a></li>
				<li class="<?if($top_active == 'contacts'):?>current<?endif;?>"><a href="<?=base_url()?>contacts">Контакты</a></li>
				<li class="right"><a href="<?=base_url()?>articles/novosti/">Новости</a></li>
			</ul>
		</div>
		<div class="right-contacts">
			<ul>
				<li class="phone">+7 (812) 633-04-20</li>
				<li class="phone">+7 (911) 831-10-25</li>
				<li><a href="mailto:info@brightbuild.ru" style="color: black;">info@brightbuild.ru</a></li>
				<li class="right">&copy; Брайтбилд-2015</li>
			</ul>
		</div>
		<div class="minicart">
			<a href="<?=base_url()?>cart"> <span class="total_qty"><?=$total_qty?></span> товаров на сумму: <span class="total_price"><?=$total_price?></span> руб.</a>
		</div>
	</div>
</header>