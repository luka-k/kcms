<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
		</div>
		<div>
			<div class="col_12">
				<ul>
					<?foreach($content as $c):?>
						<li><a href="<?=$c->full_url?>"><?=$c->name?></a></li>
					<?endforeach;?>
				</ul>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>