<header>
	<div class="maxw">
		<a href="/"><img class="logo" src="/template/client/images-new/logo.png" /></a>
		<div class="catalog-btn"><a href="http://brightbuild.ru/catalog">Каталог производителей</a></div><!--ru-->
		<div class="top-menu">
			<ul>
				<li><a href="<?=base_url()?>catalog" class="active">Магазин</a></li>
				<li><a href="/catalog/sale">Распродажа</a></li>
				<li><a href="/inventory/" target="_blank">Остатки</a></li>
				<li><a href="<?=base_url()?>bb/">bрайтbилd</a></li>
				<li><a href="<?=base_url()?>contacts">Контакты</a></li>
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