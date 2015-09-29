<div id="ufe">
<div id="searchpopupbtn"><p>Количество: <span id="total_count"></span><br><a href="/" onclick="$('#filter-form').submit();return false;">Показать</a></p></div>
	
<div id="secondcolumn10" class="secondcolumn">

	<div class="clear_filter"><a href="#" onclick="clear_filter('availability'); return false;">сбросить фильтр <span class="red">X</span></a></div>
	<?if(isset($availability)):?>
		<ul class="level1">
			<?foreach($availability as $key => $value):?>
				<li>
					<input type="checkbox" 
						   class="availability-filter availability_chb_<?=$key?>" 
						   name="<?=$key?>" 
						   value="1" 
						   onclick="$('#last_type_filter').val('availability');"
						   <?if(isset($filters_checked[$key]) && $filters_checked[$key] == 1):?>checked<?endif;?>
					/>
					<a href="#" class="level1_link" onclick="submit_filter('availability', '<?=$key?>'); return false;" rel="nofollow"> 
						<?=$value?>
					</a>
				</li>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
	
<div id="secondcolumn9" class="secondcolumn">
	<div class="clear_filter"><a href="#" onclick="clear_filter('turn'); return false;">сбросить фильтр <span class="red">X</span></a></div>
	<?if(isset($filters['turn']->values)):?>
		<ul class="level1">
			<?foreach($filters['turn']->values as $turn):?>
				<li>
					<input type="checkbox" 
						   class="turn-filter turn_chb_<?=$turn?>" 
						   name="<?=$filters['turn']->name?>[]" 
						   value="<?=$turn?>" 
						   onclick="$('#last_type_filter').val('turn');"
						   <?if(isset($filters_checked['turn']) && in_array($turn, $filters_checked['turn'])):?>checked<?endif;?>
					/>
					<a href="#" class="level1_link" onclick="submit_filter('turn', '<?=$turn?>'); return false;" rel="nofollow"> 
						<?=$turn?>
					</a>
				</li>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
				
<div id="secondcolumn8" class="secondcolumn">
	<div class="clear_filter"><a href="#" onclick="clear_filter('finishing'); return false;">сбросить фильтр <span class="red">X</span></a></div>
	<?if(isset($filters['finishing']->values)):?>
		<ul class="level1">
			<?foreach($filters['finishing']->values as $finishing):?>
				<li>
					<input type="checkbox" 
						   class="finishing-filter finishing_chb_<?=$finishing?>"
						   name="<?=$filters['finishing']->name?>[]" 
						   value="<?=$finishing?>"
						   onclick="$('#last_type_filter').val('finishing');"
						   <?if(isset($filters_checked['finishing']) && in_array($finishing, $filters_checked['finishing'])):?>checked<?endif;?>
					/>
					<a href="#" class="level1_link" onclick="submit_filter('finishing', '<?=$finishing?>'); return false;" rel="nofollow"> 
						<?=$finishing?>
					</a>
				</li>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
				
<div id="secondcolumn7" class="secondcolumn">
	<div class="clear_filter"><a href="#" onclick="clear_filter('material'); return false;">сбросить фильтр <span class="red">X</span></a></div>
	<?if(isset($filters['material']->values)):?>
		<ul class="level1">
			<?foreach($filters['material']->values as $material):?>
				<li>
					<input type="checkbox" 
						   class="material-filter material_chb_<?=$material?>" 
						   name="<?=$filters['material']->name?>[]" 
						   value="<?=$material?>"
						   onclick="$('#last_type_filter').val('material');"
						   <?if(isset($filters_checked['material']) && in_array($material, $filters_checked['material'])):?>checked<?endif;?>
					/>
					<a href="#" class="level1_link" onclick="submit_filter('material', '<?=$material?>'); return false;" rel="nofollow">
						<?=$material?>
					</a>
				</li>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
				
<div id="secondcolumn6" class="secondcolumn">
	<div class="clear_filter"><a href="#" onclick="clear_filter('color'); return false;">сбросить фильтр <span class="red">X</span></a></div>
	<?if(isset($filters['color']->values)):?>
		<ul class="level1">
			<?foreach($filters['color']->values as $color):?>
				<li>
					<input type="checkbox" 
						   class="color-filter color_chb_<?=$color?>" 
						   name="<?=$filters['color']->name?>[]" 
						   value="<?=$color?>"
						   onclick="$('#last_type_filter').val('color');"
						   <?if(isset($filters_checked['color']) && in_array($color, $filters_checked['color'])):?>checked<?endif;?>
					/>
					<a href="#" class="level1_link" onclick="submit_filter('color', '<?=$color?>'); return false;" rel="nofollow"> 
						<?=$color?>
					</a>
				</li>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
				
<div id="secondcolumn5" class="secondcolumn">
	<div class="clear_filter"><a href="#" onclick="clear_filter('nok'); return false;">сбросить фильтр <span class="red">X</span></a></div>
	<?if(isset($nok)):?>
		<ul class="level1">
			<?$nok_counter = 1?>
			<?foreach($nok as $item_1 => $ok):?>
				<li>
					<input type="checkbox" 
						   id="nok-fork-<?=$nok_counter?>"
						   class="nok-filter shortname_chb_<?=$nok_counter?>"
						   name="shortname[]"
						   value="<?=$item_1?>"
						   onclick="checked_tree('<?=$nok_counter?>', 'nok', 'fork'); $('#last_type_filter').val('shortname');"
						   <?if(isset($filters_checked['shortname']) && in_array($item_1, $filters_checked['shortname'])):?>checked<?endif;?>
					/>
					<?if(!empty($ok)):?><span id="nokll-<?=$nok_counter?>" class="level1_click">+</span><?endif;?> 
					<a href="#" class="level1_link" onclick="submit_filter('shortname', '<?=$nok_counter?>'); return false;" rel="nofollow">
						<?=$item_1?>
					</a>
					<?if(!empty($ok)):?>
						<ul id="sub-ok-<?=$nok_counter?>">
							<?$show_counter = 0?>
							
							<?foreach($ok as $key => $item_2):?>
								<?if(!empty($item_2)):?>
									<li>	
										<input type="checkbox" 
											   class="nok-branch-<?=$nok_counter?> nok-filter shortdesc_chb_<?=$nok_counter?>"
										       name="shortdesc[<?=$key?>]"
											   value="<?=$item_1?>/<?=$item_2?>"
											   onclick="checked_tree('<?=$nok_counter?>', 'nok', 'child'); $('#last_type_filter').val('shortdesc');"
										       <?if(isset($filters_checked['shortdesc']) && array_key_exists($key, $filters_checked['shortdesc'])):?>checked<?++$show_counter?><?endif;?>
									    />
									    <a href="#" onclick="submit_filter('shortdesc', '<?=$nok_counter?>'); return false;" rel="nofollow">
											<?=$item_2?>
										</a>
								    </li>
								<?endif;?>
							<?endforeach;?>
							<?if($show_counter > 0):?><script>document.getElementById('sub-ok-<?=$nok_counter?>').style.display='block'; $("#nokll-<?=$nok_counter?>").html("-");</script><?endif;?>
						</ul>
					<?endif;?>
				</li>
				<?++$nok_counter?>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
		
<div id="secondcolumn4" class="secondcolumn">
	<div class="clear_filter"><a href="#" onclick="clear_filter('sku'); return false;">сбросить фильтр <span class="red">X</span></a></div>
	<ul class="level1">
		<?foreach($sku_tree as $s):?>
			<li>
				<input type="checkbox" 
					   id="manufacturer-fork-<?=$s->id?>"
					   class="manufacturer-filter manufacturer_chb_<?=$s->id?>"
					   name="manufacturer_checked[]" 
					   value="<?=$s->id?>" 
					   onclick="checked_tree('<?=$s->id?>', 'manufacturer', 'fork'); $('#last_type_filter').val('manufacturer_checked')"
					   <?if(isset($filters_checked['manufacturer_checked']) && in_array($s->id, $filters_checked['manufacturer_checked'])):?>checked<?endif;?>
				/>
				<?if($s->sku):?> 
					<span class="level1_click"><?if(count($sku_tree) == 1 && !empty($s->sku)):?>-<?else:?>+<?endif;?></span>
				<?endif;?> 
				<a href="#" class="level1_link" onclick="submit_filter('manufacturer', '<?=$s->id?>'); return false;" rel="nofollow">
					<?=$s->name?>
				</a>
				<?if($s->sku):?>
					<ul id="sub-sku-<?=$s->id?>" style="display:<?if(count($sku_tree) == 1):?>block<?endif;?>">
						<?foreach($s->sku as $sku):?>
							<li>
								<input type="checkbox" 
									   class="manufacturer-branch-<?=$s->id?> sku-filter sku_chb_<?=$s->id?>" 
									   name="sku_checked[]" 
									   value="<?=$sku->sku?>" 
									   onclick="checked_tree('<?=$s->id?>', 'manufacturer', 'child'); $('#last_type_filter').val('sku_checked');"
									   <?if(isset($filters_checked['sku_checked']) && in_array($sku->sku, $filters_checked['sku_checked'])):?>checked<?endif;?>
								/>
								<a href="<?=$sku->full_url?>">
									<?=$sku->sku?>
								</a>
							</li>
						<?endforeach;?>
					</ul>
				<?endif;?>
			</li>
		<? endforeach ?>
	</ul>
</div>
				
<div id="secondcolumn3" class="secondcolumn">
	<div class="clear_filter"><a href="#" onclick="clear_filter('collection'); return false;">сбросить фильтр <span class="red">X</span></a></div>
	
	<ul class="level1">
		<?foreach($collection as $col_manufacturers):?>
			<li>
				<input type="checkbox" 
					   id="manufac-fork-<?=$col_manufacturers->id?>"
					   class="manufacturer-filter manufacturer_chb_<?=$col_manufacturers->id?>"
					   name="manufacturer_checked[]" 
					   value="<?=$col_manufacturers->id?>" 
					   onclick="checked_tree('<?=$col_manufacturers->id?>', 'manufac', 'fork'); $('#last_type_filter').val('collection_checked');"
					   <?if(isset($filters_checked['manufacturer_checked']) && in_array($col_manufacturers->id, $filters_checked['manufacturer_checked'])):?>checked<?endif;?>
				/>
				<span id="manu-<?=$col_manufacturers->id?>" class="level1_click"><?if(count($collection) == 1 && !empty($col_manufacturers->childs)):?>-<?else:?>+<?endif;?></span> 
				<a href="#" class="level1_link" onclick="submit_filter('manufacturer', '<?=$col_manufacturers->id?>'); return false;" rel="nofollow">
					<?=$col_manufacturers->name?>
				</a>
				<?if($col_manufacturers->childs):?>
					<ul id="collec-<?=$col_manufacturers->id?>" style="display:<?if(count($collection) == 1):?>block<?endif;?>">
						<?$show_counter_1 = 0?>
						<?foreach($col_manufacturers->childs as $level_1):?>
							<li>
								<input type="checkbox" 
									id="collection-fork-<?=$level_1->id?>"
									class="manufac-branch-<?=$col_manufacturers->id?> collection-filter collection_chb_<?=$level_1->id?>"
									name="collection_checked[]" 
									data-manid = "<?=$col_manufacturers->id?>"
									value="<?=$level_1->id?>"
									onclick="checked_tree('<?=$level_1->id?>', 'collection', 'fork'); $('#last_type_filter').val('collection_checked');"
									<?if(isset($filters_checked['collection_checked']) && in_array($level_1->id, $filters_checked['collection_checked'])):?>checked<?++$show_counter_1?><?endif;?>
								/>
								<?if($level_1->childs):?>
									<span id="cll-<?=$level_1->id?>" class="level1_click">+</span>
								<?endif;?> 
								<a href="#" class="level1_link" onclick="submit_filter('collection', '<?=$level_1->id?>'); return false;" rel="nofollow">
									<?=$level_1->name?>
								</a>
								<?if($level_1->childs):?>
									<ul id="sub-collections-<?=$level_1->id?>">
										<?$show_counter = 0?>
										<?foreach($level_1->childs as $level_2):?>
											<li>
												<input type="checkbox" 
													class="collection-branch-<?=$level_1->id?> collection-filter collection_chb_<?=$level_2->id?>"
													name="collection_checked[]" 
													value="<?=$level_2->id?>"
													onclick="checked_tree('<?=$level_1->id?>', 'collection', 'child'); $('#last_type_filter').val('collection_checked')"
													<?if(isset($filters_checked['collection_checked']) && in_array($level_2->id, $filters_checked['collection_checked'])):?>checked<?++$show_counter?><?endif;?>
												/>
												<a href="#" class="level1_link" onclick="submit_filter('collection', '<?=$level_2->id?>'); return false;" rel="nofollow">
													<?=$level_2->name?>
												</a>
											</li>
										<?endforeach;?>
										<?if($show_counter > 0):?><script>document.getElementById('sub-collections-<?=$level_1->id?>').style.display='block'; $("#cll-<?=$level_1->id?>").html("-");</script><?endif;?>
										<?if($show_counter == count($level_1->childs)):?><script>$('collection-fork-<?=$level_1->id?>').prop("checked", true)</script><?endif;?>
									</ul>
								<?endif;?>
							</li>
						<? endforeach ?>
						<?if($show_counter_1 > 0):?><script>document.getElementById('collec-<?=$col_manufacturers->id?>').style.display='block'; $("#manu-<?=$col_manufacturers->id?>").html("-");</script><?endif;?>
						<?if($show_counter_1 == count($col_manufacturers->childs)):?>
							<script>
								$('#manufac-fork-<?=$col_manufacturers->id?>').prop("checked", true);
							</script>
						<?endif;?>
					</ul>
				<?endif;?>
			</li>
		<?endforeach;?>
	</ul>
</div>
							
<div id="secondcolumn" class="secondcolumn">
	<div class="clear_filter"><a href="#" onclick="clear_filter('categories'); return false;">сбросить фильтр <span class="red">X</span></a></div>
	<ul class="level1">
		<?foreach($left_menu as $item_1):?>
			<li>
				<input type="checkbox" 
					   id="parent-fork-<?=$item_1->id?>"
					   class="parent_checked category-<?=$item_1->id?> category_chb_<?=$item_1->id?> categories-filter" 
					   name="parent_checked[]" 
					   value="<?=$item_1->id?>"
					   onclick="checked_tree('<?=$item_1->id?>', 'parent', 'fork'); $('#last_type_filter').val('categories_checked')"
					   <?if(isset($filters_checked['parent_checked']) && in_array($item_1->id, $filters_checked['parent_checked'])):?>checked<?endif;?>
				/>
				<?if(!empty($item_1->childs)):?>
					<span id="pll-<?=$item_1->id?>" class="level1_click">+</span> 
				<?endif;?>
				<a href="#" class="level1_link" onclick="submit_filter('category', '<?=$item_1->id?>'); return false;" rel="nofollow">
					<?=$item_1->name?>
				</a>
				<?if(!empty($item_1->childs)):?>
					<ul id="sub-parent-<?=$item_1->id?>">
						<?$show_counter = 0?>
						<?foreach ($item_1->childs as $item_2):?>
							<li>
								<input type="checkbox" 
									   class="categories_checked parent-branch-<?=$item_1->id?> category_chb_<?=$item_2->id?> categories-filter" 
									   name="categories_checked[]" 
									   parent="<?=$item_1->id?>" 
									   value="<?=$item_2->id?>" 
									   onclick="checked_tree('<?=$item_1->id?>', 'parent', 'child'); $('#last_type_filter').val('categories_checked')"
									   <?if(isset($filters_checked['categories_checked']) && in_array($item_2->id, $filters_checked['categories_checked'])):?>checked<?$show_counter++?><?endif;?>
								/>
								<a href="#" onclick="submit_filter('category', '<?=$item_2->id?>'); return false;" rel="nofollow">
									<?=$item_2->name?>
								</a>
							</li>
						<?endforeach;?>
						<?if($show_counter > 0):?><script>document.getElementById('sub-parent-<?=$item_1->id?>').style.display='block';$("#pll-<?=$item_1->id?>").html("-");</script><?endif;?>
						<?if($show_counter == count($item_1->childs)):?><script>$('#parent-fork-<?=$item_1->id?>').prop("checked", true)</script><?endif;?>
					</ul>
				<? endif;?>
			</li>
		<?endforeach;?>
	</ul>
</div>
</div>