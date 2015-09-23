<header>
	<div class="maxw">
		<a href="/"><img class="logo" src="/template/client/images/logo.png" /></a>
		
		<div class="top-menu">
			<ul class="clearfix">
				<li class="first <?if($top_active == 'catalog'):?>current<?endif;?>">
					<a href="#">Каталог</a><span class="marker up">&nbsp;</span>
					<ul>
						<li class=""><a href="http://brightbuild.ru/catalog">Производители</a></li>
						<li class=""><a href="http://brightbuild.ru/vendors">Продавцы</a></li>
						<li class=""><a href="http://brightbuild.ru/contractors">Подрядчики</a></li>
					</ul>
				</li>
				<li class="<?if($top_active == 'shop'):?>current<?endif;?>">
					<a href="#">Магазин</a><span class="marker">&nbsp;</span>
					<ul>
						<li class=""><a href="http://shop.brightbuild.ru/catalog">Товары</a></li>
						<li class=""><a href="http://shop.brightbuild.ru/catalog/sale/">Распродажа</a></li>
						<li class=""><a href="<?=base_url()?>">Оплата/Доставка</a></li>
					</ul>
				</li>
				<li class="<?if($top_active == 'inventory'):?>current<?endif;?>"><a href="<?=base_url()?>inventory">Складские остатки</a></li>
				<li class="<?if($top_active == 'bb'):?>current<?endif;?>"><a href="<?=base_url()?>bb">bрайтbилd</a></li>
				<li class="<?if($top_active == 'contacts'):?>current<?endif;?>"><a href="<?=base_url()?>contacts">Контакты</a></li>
				<li class="right <?if($top_active == 'news'):?>current<?endif;?>"><a href="<?=base_url()?>articles/novosti/">Новости</a></li>
			</ul>
		</div>
		<div class="right-contacts">
			<ul>
				<li class="phone">+7 (812) 633-04-20</li>
				<li class="phone">+7 (911) 831-10-25</li>
				<li><a href="mailto:info@brightbuild.ru" style="color: black;">info@brightbuild.ru</a></li>
				<li><a href="http://vk.com/club60887739" class="vk-link" style="color: black;" target="_blank">&nbsp;</a></li>
				<li class="right">&copy; Брайтбилд-2015</li>
			</ul>
		</div>
		<div class="minicart">
			<a href="<?=base_url()?>cart"><span class="hidden_part"><span class="total_qty"><?=$total_qty?></span> товаров на сумму: <span class="total_price"><?=$total_price?></span> руб.</span>&nbsp;</a>
		</div>
	</div>
</header>