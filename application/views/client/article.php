<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12">
		
			<div class="left col_3">
				<? require 'include/left-menu.php'?>
			</div>
			<div id="main_content" class="col_9">
				<div class="col_12">
					<?require 'include/breadcrumbs.php'?> 
					<div><?=$content->name?></div>
					<div><?=$content->description?></div>
				</div>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>