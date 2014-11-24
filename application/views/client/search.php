<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12">
			<div id="main_content" class="col_8">
				<? require 'include/breadcrumbs.php'?> 
				<div class="col_12">
					<?foreach($search as $item):?>
						<div class="col_12">
							<div class="col_5">
								<a href="<?=$item->full_url?>"><?=$item->name?></a>
							</div>
						</div>
					<?endforeach;?>
				</div>
			</div>
			<div class="col_4">
				<h5>Каталог продукции</h5>
				<? require 'include/tree.php' ?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>