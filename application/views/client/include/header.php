
				 <div id="searchpopupbtn"><p>Количество: <span id="total_count"><?= $total_rows?></span><br><a href="/" onclick="$('#filter-form').submit();return false;">Показать</a></p></div>
				 
				 <div id="secondcolumn7" class="secondcolumn">
					<ul class="level1">
						<?foreach($material as $item_1 => $ok):?>
							<li>
								<input type="checkbox" class="parent_checked" name="material_checked[]" value="<?=$item_1?>"
									<?if(!empty($material_checked)):?>
										<?foreach($material_checked as $key => $item):?>
											<?if($item == $item_1):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"> <?=$item_1?></a>
							</li>
						<? endforeach ?>
					</ul>
				</div>
				
				 <div id="secondcolumn6" class="secondcolumn">
					<ul class="level1">
						<?foreach($color as $item_1 => $ok):?>
							<li>
								<input type="checkbox" class="parent_checked" name="color_checked[]" value="<?=$item_1?>"
									<?if(!empty($color_checked)):?>
										<?foreach($color_checked as $key => $item):?>
											<?if($item == $item_1):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"> <?=$item_1?></a>
							</li>
						<? endforeach ?>
					</ul>
				</div>
				
				 <div id="secondcolumn5" class="secondcolumn">
					<ul class="level1">
						<?foreach($nok as $item_1 => $ok):?>
							<li>
								<input type="checkbox" class="parent_checked" name="nok_checked[]"
									<?if(!empty($nok_checked)):?>
										<?foreach($nok_checked as $key => $item):?>
											<?if($item == $item_1):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"> <?=$item_1?></a>
							</li>
						<? endforeach ?>
					</ul>
				</div>
				
				 <div id="secondcolumn4" class="secondcolumn">
					<ul class="level1">
						<?foreach($sku as $item_1 => $ok):?>
							<li>
								<input type="checkbox" class="parent_checked" name="sku_checked[]" value="<?=$item_1?>"
									<?if(!empty($sku_checked)):?>
										<?foreach($sku_checked as $key => $item):?>
											<?if($item == $item_1):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"> <?=$item_1?></a>
							</li>
						<? endforeach ?>
					</ul>
				</div>
				
				 <div id="secondcolumn3" class="secondcolumn">
					<ul class="level1">
						<?foreach($collection as $item_1 => $ok):?>
							<li>
								<input type="checkbox" class="parent_checked" name="collection_checked[]" value="<?=$item_1?>"
									<?if(!empty($collection_checked)):?>
										<?foreach($collection_checked as $key => $item):?>
											<?if($item == $item_1):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"> <?=$item_1?></a>
							</li>
						<? endforeach ?>
					</ul>
				</div>
				
				 <div id="secondcolumn2" class="secondcolumn">
					<ul class="level1">
						<?foreach($manufacturer as $item_1 => $m_id):?>
							<li>
								<input type="checkbox" class="parent_checked" name="manufacturer_checked[]" value="<?=$m_id?>" 
									<?if(!empty($manufacturer_checked)):?>
										<?foreach($manufacturer_checked as $key => $item):?>
											<?if($item == $item_1):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"> <?=$item_1?></a>
							</li>
						<? endforeach ?>
					</ul>
				</div>
				
				 <div id="secondcolumn" class="secondcolumn">
				 
					<ul class="level1">
						<?$counter = 0?>
						<?foreach($left_menu as $item_1):?>
							<li>
								<input type="checkbox" class="parent_checked category-<?=$item_1->id?>" name="parent_checked[]" value="<?=$item_1->id?>" 
									<?if(!empty($parent_checked)):?>
										<?foreach($parent_checked as $key => $item):?>
											<?if($item == $item_1->id):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"><span>+</span> <?=$item_1->name?></a>
								<? if(!empty($item_1->childs)):?>
									<ul>
										<?foreach ($item_1->childs as $item_2):?>
											<li>
												<input type="checkbox" class="categories_checked" name="categories_checked[]" parent="<?=$item_1->id?>" value="<?=$item_2->id?>" 
												<?if(!empty($categories_checked)):?>
													<?foreach($categories_checked as $key => $ch):?>
														<?if($ch == $item_2->id):?>checked<?endif;?>
													<?endforeach;?>
												<?endif;?>/>
												<a href="<?=base_url()?>shop/<?=$item_1->url?>/<?=$item_2->url?>"><?=$item_2->name?></a>
											</li>
											<?$counter++?>
										<?endforeach;?>
									</ul>
								<? endif;?>
							</li>
						<?endforeach;?>
					</ul>
				 
				 </div>
        <header>
			<div class="maxw">
				<a href="/"><img class="logo" src="/template/client/images-new/logo.png" /></a>
				<div class="catalog-btn"><a href="/">Каталог производителей</a></div>
				<div class="top-menu">
					<ul>
						<li><a href="/" class="active">Магазин</a></li>
						<li><a href="/">Доставка и Оплата</a></li>
						<li><a href="/">bрайтbилd</a></li>
						<li class="right"><a href="/">Контакты</a></li>
					</ul>
				</div>
				<div class="right-contacts">
					<ul>
						<li class="phone">+7 911 831 1025</li>
						<li>info@brightbuild.ru</li>
						<li class="right">&copy; Брайтбилд-2015</li>
					</ul>
				</div>
				<div class="minicart">
					<a href="<?=base_url()?>pages/cart"> <?=$total_qty?> товаров на сумму: <?=$total_price?> руб.</a>
				</div>
			</div>
        </header>