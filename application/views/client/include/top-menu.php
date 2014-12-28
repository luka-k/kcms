<div class="menu" id="menu">
	<div class="menu__wrap wrap">
		<nav class="menu__nav">
		
			<ul class="menu-nav">
				<?foreach($top_menu as $item):?>
					<li class="menu-nav__item">
						<a href="<?=$item->full_url?>" class="menu-nav__href <?if($select_item == $item->url):?>active<?endif;?>"><?=$item->name?></a>
						
						<!--Sub menu first level-->
						<?php if(!empty($item->childs)):?>
							<ul class="menu-nav-level-2">
								<?foreach($item->childs as $sub_item_1):?>
									<li class="menu-nav-level-2__item">
										<a href="<?=$sub_item_1->full_url?>" class="menu-nav-level-2__href" ><?=$sub_item_1->name?></a>
										<?php if(!empty($sub_item_1->childs)):?>
											<ul class="menu-nav-level-3">
												<?foreach($sub_item_1->childs as $sub_item_2):?>
													<li class="menu-nav-level-3__item">
														<a href="<?=$sub_item_2->full_url?>" class="menu-nav-level-3__href"><?=$sub_item_2->name?></a>
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
				<form action="<?=base_url()?>search" class="form" method="get">
					<input type="text" class="form__input menu-search__input" name="name" placeholder="Поиск" />
					<button class="button menu-search__button">Поиск</button>
				</form> <!-- /.form -->
			</div> <!-- /.menu-search -->
		</div> <!-- /.menu__search -->
	</div> <!-- /.menu__wrap wrap -->
</div> <!-- /.menu -->