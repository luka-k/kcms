<div id="searchpopupbtn"><p>Количество: <span id="total_count"><?= $total_rows?></span><br><a href="/" onclick="$('#filter-form').submit();return false;">Показать</a></p></div>
				 				
				<div id="secondcolumn7" class="secondcolumn">
					<ul class="level1">
						<?foreach($filters['material']->values as $material):?>
							<li>
								<input type="checkbox" class="parent_checked" name="<?=$filters['material']->name?>[]" value="<?=$material?>"
									<?if(!empty($material_checked)):?>
										<?foreach($material_checked as $key => $item):?>
											<?if($item == $item_1):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"> <?=$material?></a>
							</li>
						<? endforeach ?>
					</ul>
				</div>
				
				 <div id="secondcolumn6" class="secondcolumn">
					<ul class="level1">
						<?foreach($filters['color']->values as $color):?>
							<li>
								<input type="checkbox" class="parent_checked" name="<?=$filters['color']->name?>[]" value="<?=$color?>"
									<?if(!empty($color_checked)):?>
										<?foreach($color_checked as $key => $item):?>
											<?if($item == $item_1):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"> <?=$color?></a>
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
						<?foreach($collection as $c):?>
							<li>
								<input type="checkbox" class="parent_checked" name="collection_checked[]" value="<?=$c->id?>"
									<?if(!empty($filters_checked['collection_checked'])):?>
										<?foreach($filters_checked['collection_checked'] as $key => $item):?>
											<?if($item == $c->id):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"> <?=$c->name?></a>
							</li>
						<? endforeach ?>
					</ul>
				</div>
				
				 <div id="secondcolumn2" class="secondcolumn">
					<ul class="level1">
						<?foreach($manufacturer as $m):?>
							<li>
								<input type="checkbox" class="parent_checked" name="manufacturer_checked[]" value="<?=$m->id?>" 
									<?if(!empty($filters_checked['manufacturer_checked'])):?>
										<?foreach($filters_checked['manufacturer_checked'] as $key => $item):?>
											<?if($item == $m->id):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>
								/>
								<a href="#" class="level1_link"> <?=$m->name?></a>
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
									<?if(!empty($filters_checked['parent_checked'])):?>
										<?foreach($filters_checked['parent_checked'] as $key => $item):?>
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
												<?if(!empty($filters_checked['categories_checked'])):?>
													<?foreach($filters_checked['categories_checked'] as $key => $ch):?>
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