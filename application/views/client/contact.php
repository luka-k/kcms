<!DOCTYPE html>

<html class="no-js">

<? require 'include/head.php'; ?>

<body>

	<? require 'include/header.php'; ?>
	<? require 'include/modal.php'; ?>
	
	<div class="contacts">
		<div class="container">
			<h2>Контакты</h2>
			
			<div class="contact_info">
				<div class="contacts_phone">
					<p><a href="tel:<?= $settings['phone']->string_value?>"><?= $settings['phone']->span_value?></a></p>
					<p><a href="tel:<?= $settings['phone_saratov']->string_value?>"><?= $settings['phone_saratov']->span_value?></a></p>
					<p><a href="tel:<?= $settings['phone_volsk']->string_value?>"><?= $settings['phone_volsk']->span_value?></a></p>
				</div>
				
				<a href="mailto:mail@ocenkaexp.ru" class="contacts_mail"><?= $settings['email']->string_value?></a>
				<a href="#" class="contacts_skype"><?= $settings['phone_skype']->string_value?></a>
				
				<div class="contacts_location">
					<p><strong><?= $settings['address_moscow']->string_value?>:</strong><br> <?= $settings['address_moscow']->text_value?></p>
					<p><strong><?= $settings['address_saratov']->string_value?>:</strong><br><?= $settings['address_saratov']->text_value?></p>
					<p><strong><?= $settings['address_volsk']->string_value?>:</strong><br><?= $settings['address_volsk']->text_value?></p>
				</div>
			</div>
			
			<div style="clear:both"></div>
			
			<h2>Ключевые сотрудники компании </h2>
            <? foreach($users as $u): ?>
				<div class="about_us_page_people">
					<img src="<?= $u->img->about_url?>" alt="<?= $u->name?>">
					<h3><?= $u->name?></h3>
					<p><?= $u->rank?><br>
						<?= $u->email?><br>
						<?= $u->phone?>
					</p>
					<? if(!empty($u->vk_link)): ?><a href="<?= $u->vk_link?>"><?= $u->vk_link?></a><? endif; ?>
				</div>
			<? endforeach; ?>
		</div>
		
		<script type="text/javascript" charset="utf-8" src="<?= $settings['ya_map']->string_value?>"></script>
		
		<div class="container">
			<div class="contact_form">
				<h2>По всем вопросам обращайтесь:</h2>
				
				<form action="" method="post">
					<input type="text" placeholder="Имя" name="name">
					<input type="text" placeholder="Телефон" name="phone">
					<textarea placeholder="Сообщение" name="text"></textarea>
					<a href="#" class="button_contact" onclick="$(this).parent().submit(); return false;">Отправить</a>
				</form>
			</div>
		</div>
	</div>
	
	<? require 'include/footer.php'; ?>
</body>

</html>