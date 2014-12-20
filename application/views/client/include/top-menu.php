<div class="menu" id="menu">
	<div class="menu__wrap wrap">
		<nav class="menu__nav">
		
			<ul class="menu-nav">
				<?foreach($top_menu as $item):?>
					<li class="menu-nav__item">
						<a href="<?=$item[1]?>" class="menu-nav__href <?if ($item[2] == 1):?>фсешму<?endif;?>"><?=$item[0]?></a>
						
						<!--Sub menu first level-->
						<?php if(!empty($item[3])):?>
							<ul class="menu-nav-level-2">
								<?foreach($item[3] as $sub_item_1):?>
									<li class="menu-nav-level-2__item">
										<a href="<?=$sub_item_1[1]?>" class="menu-nav-level-2__href"><?=$sub_item_1[0]?></a>
										<?php if(!empty($sub_item_1[3])):?>
											<ul class="menu-nav-level-3">
												<?foreach($sub_item_1[3] as $sub_item_2):?>
													<li class="menu-nav-level-3__item">
														<a href="<?=$sub_item_2[1]?>" class="menu-nav-level-3__href"><?=$sub_item_2[0]?></a>
													</li> <!-- /.menu-nav-level-3__item -->
												<?endforeach;?>
											</ul> <!-- /.menu-nav-level-3 -->
										<?php endif;?>
									</li> <!-- /.menu-nav-level-2__item -->
								<?endforeach;?>
                            </ul> <!-- /.menu-nav-level-2 -->
						<?php endif;?>
					</li>
				<?endforeach;?>
			</ul> <!-- /.menu -->
		</nav> <!-- /.menu__nav -->
		
		<div class="menu__search">
			<div class="menu-search">
				<form action="#" class="form" method="post">
					<input type="text" class="form__input menu-search__input" name="s" placeholder="Поиск" />
					<button class="button menu-search__button">Поиск</button>
				</form> <!-- /.form -->
			</div> <!-- /.menu-search -->
		</div> <!-- /.menu__search -->
	</div> <!-- /.menu__wrap wrap -->
</div> <!-- /.menu -->