<a href="#x" class="overlay" id="book-form"></a>
<div class="popup book-form">
	<h5>Бесплатная книга</h5>
	<span class="line">«Вся суть интернет-бизнеса за 40 минут»</span>
	<p>В качестве бонуса, Вы можете получить серию бесплатных уроков и статей по созданию и развитию бизнеса в интернете. Если вы не хотите получить бесплатные уроки – просто оставьте поля пустыми.</p>
	<form action="" method="post" id="loadbook">
		<input type="text" name="name" placeholder="Ваше имя" />
		<input type="text" name="mail" placeholder="E-mail" />
		<input type="hidden" name="product_name" value="<?= $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?> - Скачать книгу" />
		<button>Скачать книгу</button>
	</form>

	<a class="close" href="#close"></a>
</div>
