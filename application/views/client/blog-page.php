<? require 'include/head.php' ?>
	<body>
		<div id="menu">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap">
				<div class="head"><div class="title"><?=$content->title?></div></div>
				<div class="text">
					<?=$content->prev_text?>
					<?=$content->full_text?>
				</div>
		</div>
<? require 'include/footer.php' ?>