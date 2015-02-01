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
					<?foreach($content as $item):?>
						<div class="cat-item col_4">
							<a href="<?=$item->full_url?>"><?=$item->name?></a>
						</div>
					<?endforeach;?>
				</div>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>