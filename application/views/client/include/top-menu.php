<div id="menu" class="grid clearfix">
	<nav>
		<ul>
			<li><a href="">Главная</a></li>
			<li><a href="/articles/info/about/">Информация</a></li>
			<li><a href="/">Каталог</a></li>
			<li><a href="/articles/info/delivery/">Оплата и доставка</a></li>
			<li><a href="/articles/info/contacts/">Контакты</a></li>
		</ul>
	</nav>
	<form action="/search/" id="searchform" method="get">
		<input type="text" name="q" class="search square" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" placeholder="Поиск по номеру или именованию"/>
	</form>
</div>