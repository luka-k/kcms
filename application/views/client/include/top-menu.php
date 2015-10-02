<div class="menu">
	<nav>
		<ul id="topnav">
			<?foreach($top_menu as $level_1):?>
                <li class="<?if(!empty($level_1->childs)):?>down<?endif;?>">
                    <a href="<?= $level_1->full_url?>"><?= $level_1->name?></a> 
					<?if(!empty($level_1->childs)):?>
						<span>
							<?foreach($level_1->childs as $level_2):?>
								<a href= "<?= $level_2->full_url?>"><?= $level_2->name?></a> 
							<?endforeach;?>
						</span>
					<?endif;?>
                </li>
			<?endforeach;?>
		</ul>
		
		<div class="header-search">
			<form action="" class="search" method="post">
				<input class="input" name="" placeholder="поиск" type="search"> 
				<input class="submit" name="" type="submit" value="">
			</form>
		</div>
	</nav>
</div>