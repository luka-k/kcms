<? require 'include/head.php' ?>
	<body>
		<div id="menu">
			<? require 'include/top-menu.php'?>
		</div>
		<div>
			<div style="float:left; width:60%;">
				<?foreach($content as $category):?>
					<h2><?=$category->title?></h2>
					<div><?=$category->cat_desc?></div>
				<?endforeach;?>
			</div>
			<div style="float:left; width:40%;">
				<? require 'include/tree.php'?>
			</div>
		</div>
<? require 'include/footer.php' ?>