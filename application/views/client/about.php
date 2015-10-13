<!DOCTYPE html>

<html class="no-js">

<? require 'include/head.php'; ?>

<body>

	<? require 'include/header.php'; ?>
	<? require 'include/modal.php'; ?>

	<div class="about_us_page">
		<div class="container">
			<h2><?= $about->name?></h2>
            <div class="content_page_text">
                <img src="<?= $about->img->about_url?>">
                <?= $about->description?>
            </div> </div>
			
			<div class="container">
				<h2 >География компании</h2>
			</div>
			
			<script type="text/javascript" charset="utf-8" src="<?= $settings['ya_map']->string_value?>"></script>
			
			<div class="container">
				<div class="about_us_page_advantages">
					<h2>Наши преимущества</h2>
					
					<div class="advantage">
						<div class="advantage_img"><img src="<?= IMGS_PATH?>pr1.png"></div>
                    <div class="advantage_name"><?= $settings['advances_finance']->string_value?></div>
                    <div class="advantage_text"><?= $settings['advances_finance']->text_value?></div>
                </div>
                <div class="advantage">
                    <div class="advantage_img"><img src="<?= IMGS_PATH?>pr2.png"></div>
                    <div class="advantage_name"><?= $settings['advances_zatrat']->string_value?></div>
                    <div class="advantage_text"><?= $settings['advances_zatrat']->text_value?></div>
                </div>
                <div class="advantage">
                    <div class="advantage_img"><img src="<?= IMGS_PATH?>pr3.png"></div>
                    <div class="advantage_name"><?= $settings['advances_sotrudniki']->string_value?></div>
                    <div class="advantage_text"><?= $settings['advances_sotrudniki']->text_value?></div>
                </div>
                <div class="advantage">
                    <div class="advantage_img"><img src="<?= IMGS_PATH?>pr4.png"></div>
                    <div class="advantage_name"><?= $settings['advances_ocenka']->string_value?></div>
                    <div class="advantage_text"><?= $settings['advances_ocenka']->text_value?></div>
                </div>
                <div class="advantage">
                    <div class="advantage_img"><img src="<?= IMGS_PATH?>pr5.png"></div>
                    <div class="advantage_name"><?= $settings['advances_opit']->string_value?></div>
                    <div class="advantage_text"><?= $settings['advances_opit']->text_value?></div>
                </div>
                <div class="advantage">
                    <div class="advantage_img"><img src="<?= IMGS_PATH?>pr6.png"></div>
                    <div class="advantage_name"><?= $settings['advances_expertiza']->string_value?></div>
                    <div class="advantage_text"><?= $settings['advances_expertiza']->text_value?></div>
                </div>
            </div>
			
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
    </div>

	<? require 'include/footer.php'; ?>
</body>

</html>