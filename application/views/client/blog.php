<? require 'include/head.php' ?>
	<body>
		<div id="menu">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap">
			<? foreach ($content as $news):?>
				<div class="head">
					<div class="title"><?=$news->title?></div>
					<div class="date"><?=$news->date?></div>
				</div>
				<div class="text">
					<?=$news->prev_text?>
				</div>
				<div>
					<a href="<?=base_url()?>blog/<?=$news->url?>">Подробнее</a>
				</div>
			<? endforeach?>
		</div>
<? require 'include/footer.php' ?>