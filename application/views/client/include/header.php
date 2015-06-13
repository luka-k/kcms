<?require_once "columns.php"?>

<header>
	<div class="maxw">
		<a href="/"><img class="logo" src="/template/client/images-new/logo.png" /></a>
		<div class="catalog-btn"><a href="<?=base_url()?>catalog">Каталог производителей</a></div>
		<div class="top-menu">
			<ul>
				<li><a href="<?=base_url()?>shop/catalog" class="active">Магазин</a></li><!--catalog-->
				<li><a href="/">Доставка и Оплата</a></li>
				<li><a href="/">bрайтbилd</a></li>
				<li><a href="/">Контакты</a></li>
				<li class="right"><a href="<?=base_url()?>articles/novosti/">Новости</a></li>
			</ul>
		</div>
		<div class="right-contacts">
			<ul>
				<li class="phone">+7 911 831 1025</li>
				<li>info@brightbuild.ru</li>
				<li class="right">&copy; Брайтбилд-2015</li>
			</ul>
		</div>
		<div class="minicart">
			<a href="<?=base_url()?>cart"> <span class="total_qty"><?=$total_qty?></span> товаров на сумму: <span class="total_price"><?=$total_price?></span> руб.</a>
		</div>
	</div>
</header>