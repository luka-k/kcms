<div class="form">	
	<form action="" method="post">
		<input type="text" class="required" name="name" placeholder="Ваше имя">
		<input type="text" class="required" name="phone" placeholder="Телефон">
		<input type="hidden" name="product_name" value="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> - Заказать звонок" />
		<button><span>Заказать звонок</span> <img src="img/check.png" alt=""></button>
	</form>
</div>