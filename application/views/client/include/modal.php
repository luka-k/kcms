<div class="reveal-modal" id="myModal">
	<div class="modal_left">
		<img src="<?= IMGS_PATH?>phone_modal.png">
	</div>
	
	<div class="modal_right">
		<div class="title">
			Заказать звонок
		</div>
		
		<p>Заполните форму и мы обязательно перезвоним</p>
		
		<form action="" method="post" >
			<input type="text" placeholder="Ваше имя" class="form-input" name="name">
			<input type="text" class="mask" placeholder="+7(___) ____-__-__" name="phone">
			<a href="#" class="service_button" onclick="$(this).parent().submit(); return false;">
				<img src="<?= IMGS_PATH?>visov.png"><span>Заказать звонок</span>
			</a>
		</form>
		
		<span class="modal_mail"> <a href="mailto:<?= $settings['email']->string_value?>"><?= $settings['email']->string_value?></a></span>
		<span class="modal_phone"><a href="tel:<?= $settings['phone']->string_value?>"><?= $settings['phone']->modal_value?></a></span>
	</div>
	<a class="close-reveal-modal">&#215;</a>
</div>

<div class="reveal-modal " id="myModal1">
	<div class="modal_left">
		<img src="<?= IMGS_PATH?>phone_modal.png">
	</div>
	
	<div class="modal_right">
		<div class="title">
			Вызов оценщика
		</div>
		
		<p>Заполните форму и мы обязательно перезвоним</p>
		<form action="" method="post">
			<input type="text" placeholder="Ваше имя" class="form-input" name="name">
			<input type="text" class="mask" placeholder="+7(___) ____-__-__" name="phone">
			<a href="#" class="service_button" onclick="$(this).parent().submit(); return false;">
				<img src="<?= IMGS_PATH?>visov.png"><span>Вызвать оценщика</span>
			</a>
		</form>
		
		<span class="modal_mail"> <a href="mailto:<?= $settings['email']->string_value?>"><?= $settings['email']->string_value?></a></span>
		<span class="modal_phone"><a href="tel:<?= $settings['phone']->string_value?>"><?= $settings['phone']->modal_value?></a></span>
	</div>
	
	<a class="close-reveal-modal">&#215;</a>
</div>

<div class="reveal-modal " id="myModal2">
	<div class="modal_left">
		<img src="<?= IMGS_PATH?>phone_modal.png">
	</div>
	
	<div class="modal_right">
		<div class="title">
			Заказать оценку
		</div>
		
		<p>Заполните форму и мы обязательно перезвоним</p>
		
		<form action="" method="post">
			<input type="text" placeholder="Ваше имя" class="form-input" name="name">
			<input type="text" class="mask" placeholder="+7(___) ____-__-__" name="phone">
			<a href="#" class="service_button" onclick="$(this).parent().submit(); return false;">
				<img src="<?= IMGS_PATH?>visov.png"><span> Заказать оценку</span>
			</a>
		</form>
		
		<span class="modal_mail"> <a href="mailto:<?= $settings['email']->string_value?>"><?= $settings['email']->string_value?></a></span>
		<span class="modal_phone"><a href="tel:<?= $settings['phone']->string_value?>"><?= $settings['phone']->modal_value?></a></span>
	</div>
	
	<a class="close-reveal-modal">&#215;</a>
</div>