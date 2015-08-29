<a href="#x" class="overlay" id="win1"></a>
<div class="popup">
	<p>Оставить заявку</p>
	<form action="" method="post">
		<input type="text" name="name" class="required" placeholder="Ваше имя" />
		<input type="text" name="phone" class="required" placeholder="Телефон" />
		<input type="hidden" name="product_name" value="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> - Оставить заявку" />
		<textarea type="text" name="message" class="required" placeholder="Комментарий" /></textarea>
		<button>Отправить</button>
	</form>
	<a class="close" href="#close"></a>
</div>
<a href="#x" class="overlay" id="win2"></a>
<div class="popup">
	<p>Заказать звонок</p>
	<form action="" method="post">
		<input type="text" name="name" class="required" placeholder="Ваше имя" />
		<input type="text" name="phone" class="required" placeholder="Телефон" />
		<input type="hidden" name="product_name" value="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> - Заказать звонок" />
		<textarea type="text" name="message" class="required" placeholder="Комментарий" /></textarea>
		<button>Перезвоните мне</button>
	</form>
	<a class="close" href="#close"></a>
</div>
<a href="#x" class="overlay" id="win4"></a>
<div class="popup">
	<p>Ваш вопрос</p>
	<form action="" method="post">
		<input type="text" name="name" class="required" placeholder="Ваше имя" />
		<input type="text" name="phone" class="required" placeholder="Телефон" />
		<input type="hidden" name="product_name" value="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> - Задать вопрос" />
		<textarea type="text" name="message" class="required" placeholder="Ваш вопрос" /></textarea>
		<button>Задать вопрос</button>
	</form>
	<a class="close" href="#close"></a>
</div>
<a href="#x" class="overlay" id="win3"></a>
<div class="popup">
	<br>
	<br>
	<br>
	<br>
	<p>Спасибо!</p>
	<br>
	<br>
	<p>Менеджер свяжется с Вами!</p>
	<br>
	<br>
	<br>
	<br>
	<a class="close" href="#close"></a>
</div>