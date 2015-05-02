<div id="searchpopupbtn"><p>Количество: <span id="total_count"><?= $total_rows?></span><br><a href="/" onclick="$('#filter-form').submit();return false;">Показать</a></p></div>
				 
<div id="secondcolumn9" class="secondcolumn">
	<?if(isset($filters['turn']->values)):?>
		<ul class="level1">
			<?foreach($filters['turn']->values as $turn):?>
				<li>
					<input type="checkbox" 
						   class="parent_checked" 
						   name="<?=$filters['turn']->name?>[]" 
						   value="<?=$turn?>" 
						   onclick="$('#last_type_filter').val('turn');"
						   <?if(isset($filters_checked['turn']) && in_array($turn, $filters_checked['turn'])):?>checked<?endif;?>
					/>
					<a href="#" class="level1_link"> <?=$turn?></a>
				</li>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
				
<div id="secondcolumn8" class="secondcolumn">
	<?if(isset($filters['finishing']->values)):?>
		<ul class="level1">
			<?foreach($filters['finishing']->values as $finishing):?>
				<li>
					<input type="checkbox" 
						   name="<?=$filters['finishing']->name?>[]" 
						   value="<?=$finishing?>"
						   onclick="$('#last_type_filter').val('finishing');"
						   <?if(isset($filters_checked['finishing']) && in_array($finishing, $filters_checked['finishing'])):?>checked<?endif;?>
					/>
					<a href="#" class="level1_link"> <?=$finishing?></a>
				</li>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
				
<div id="secondcolumn7" class="secondcolumn">
	<?if(isset($filters['material']->values)):?>
		<ul class="level1">
			<?foreach($filters['material']->values as $material):?>
				<li>
					<input type="checkbox" 
						   class="parent_checked" 
						   name="<?=$filters['material']->name?>[]" 
						   value="<?=$material?>"
						   onclick="$('#last_type_filter').val('material');"
						   <?if(isset($filters_checked['material']) && in_array($material, $filters_checked['material'])):?>checked<?endif;?>
					/>
					<a href="#" class="level1_link"> <?=$material?></a>
				</li>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
				
<div id="secondcolumn6" class="secondcolumn">
	<?if(isset($filters['color']->values)):?>
		<ul class="level1">
			<?foreach($filters['color']->values as $color):?>
				<li>
					<input type="checkbox" 
						   class="parent_checked" 
						   name="<?=$filters['color']->name?>[]" 
						   value="<?=$color?>"
						   onclick="$('#last_type_filter').val('color');"
						   <?if(isset($filters_checked['color']) && in_array($color, $filters_checked['color'])):?>checked<?endif;?>
					/>
					<a href="#" class="level1_link"> <?=$color?></a>
				</li>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
				
<div id="secondcolumn5" class="secondcolumn">
	<?if(isset($nok)):?>
		<ul class="level1">
			<?$nok_counter = 1?>
			<?foreach($nok as $item_1 => $ok):?>
				<li>
					<input type="checkbox" 
						   id="nok-fork-<?=$nok_counter?>"
						   name="shortname[]"
						   value="<?=$item_1?>"
						   onclick="checked_tree('<?=$nok_counter?>', 'nok', 'fork'); $('#last_type_filter').val('shortname');"
						   <?if(isset($filters_checked['shortname']) && in_array($item_1, $filters_checked['shortname'])):?>checked<?endif;?>
					/>
					<a href="#" class="level1_link"><?if(!empty($ok)):?><span>+</span> <?endif;?><?=$item_1?></a>
					<?if(!empty($ok)):?>
						<ul id="sub-ok-<?=$nok_counter?>">
							<?$show_counter = 0?>
							<?foreach($ok as $item_2):?>
								<?if(!empty($item_2)):?>
									<li>	
										<input type="checkbox" 
											   class="nok-branch-<?=$nok_counter?>"
										       name="shortdesc[]"
											   value="<?=$item_2?>"
											   onclick="checked_tree('<?=$nok_counter?>', 'nok', 'child'); $('#last_type_filter').val('shortdesc');"
										       <?if(isset($filters_checked['shortdesc']) && in_array($item_2, $filters_checked['shortdesc'])):?>checked<?$show_counter++?><?endif;?>
									    />
									    <a href="#"><?=$item_2?></a>
								    </li>
								<?endif;?>
							<?endforeach;?>
							<?if($show_counter > 0):?><script>document.getElementById('sub-ok-<?=$nok_counter?>').style.display='block';</script><?endif;?>
						</ul>
					<?endif;?>
				</li>
				<?$nok_counter++?>
			<? endforeach ?>
		</ul>
	<?endif;?>
</div>
		
<div id="secondcolumn4" class="secondcolumn">
	<ul class="level1">
		<?foreach($manufacturer as $m):?>
			<li>
				<a href="#" class="level1_link"><?if($m->sku):?> <span>+</span> <?endif;?><?=$m->name?></a>
				<?if($m->sku):?>
					<ul id="sub-manufacturer-<?=$m->id?>">
						<?$show_counter = 0?>
						<?foreach($m->sku as $sku):?>
							<li>
								<input type="checkbox" 
									   class="manufacturer-branch-<?=$m->id?>" 
									   name="sku_checked[]" 
									   value="<?=$sku?>" 
									   onclick="checked_tree('<?=$m->id?>', 'manufacturer', 'child'); $('#last_type_filter').val('sku_checked');"
									   <?if(isset($filters_checked['sku_checked']) && in_array($sku, $filters_checked['sku_checked'])):?>checked<?$show_counter++?><?endif;?>
								/>
								<a href="#"><?=$sku?></a>
							</li>
						<?endforeach;?>
						<?if($show_counter > 0):?><script>document.getElementById('sub-manufacturer-<?=$m->id?>').style.display='block';</script><?endif;?>
					</ul>
				<?endif;?>
			</li>
		<? endforeach ?>
	</ul>
</div>
				
<div id="secondcolumn3" class="secondcolumn">
	<ul class="level1">
		<?foreach($collection as $c):?>
			<li>
				<input type="checkbox" 
					   id="collection-fork-<?=$c->id?>"
					   name="collection_checked[]" 
					   value="<?=$c->id?>"
					   onclick="checked_tree('<?=$c->id?>', 'collection', 'fork'); $('#last_type_filter').val('collection_checked')"
					   <?if(isset($filters_checked['collection_checked']) && in_array($c->id, $filters_checked['collection_checked'])):?>checked<?endif;?>
				/>
				<a href="#" class="level1_link"><?if($c->childs):?><span>+</span><?endif;?> <?=$c->name?></a>
				<?if($c->childs):?>
					<ul id="sub-collections-<?=$c->id?>">
						<?$show_counter = 0?>
						<?foreach($c->childs as $level_2):?>
							<li>
								<input type="checkbox" 
									   class="collection-branch-<?=$c->id?>"
									   name="collection_checked[]" 
									   value="<?=$level_2->id?>"
									   onclick="checked_tree('<?=$c->id?>', 'collection', 'child'); $('#last_type_filter').val('collection_checked')"
									   <?if(isset($filters_checked['collection_checked']) && in_array($level_2->id, $filters_checked['collection_checked'])):?>checked<?$show_counter++?><?endif;?>
								/>
								<a href="#" class="level1_link"><span>+</span> <?=$level_2->name?></a>
							</li>
						<?endforeach;?>
						<?if($show_counter > 0):?><script>document.getElementById('sub-collections-<?=$c->id?>').style.display='block';</script><?endif;?>
					</ul>
				<?endif;?>
			</li>
		<? endforeach ?>
	</ul>
</div>
				
<div id="secondcolumn2" class="secondcolumn">
	<ul class="level1">
		<?foreach($manufacturer as $m):?>
			<li>
				<input type="checkbox" 
					   id="manufacturer-fork-<?=$m->id?>"
					   name="manufacturer_checked[]" 
					   value="<?=$m->id?>" 
					   onclick="checked_tree('<?=$m->id?>', 'manufacturer', 'fork'); $('#last_type_filter').val('manufacturer_checked')"
					   <?if(isset($filters_checked['manufacturer_checked']) && in_array($m->id, $filters_checked['manufacturer_checked'])):?>checked<?endif;?>
				/>
				<a href="#" class="level1_link"><?if($m->sku):?><?endif;?><?=$m->name?></a>
			</li>
		<? endforeach ?>
	</ul>
</div>
				
<div id="secondcolumn" class="secondcolumn">
	<ul class="level1">
		<?foreach($left_menu as $item_1):?>
			<li>
				<input type="checkbox" 
					   id="parent-fork-<?=$item_1->id?>"
					   class="parent_checked category-<?=$item_1->id?>" 
					   name="parent_checked[]" 
					   value="<?=$item_1->id?>"
					   onclick="checked_tree('<?=$item_1->id?>', 'parent', 'fork')"
					   <?if(isset($filters_checked['parent_checked']) && in_array($item_1->id, $filters_checked['parent_checked'])):?>checked<?endif;?>
				/>
				<a href="#" class="level1_link"><?if(!empty($item_1->childs)):?><span>+</span> <?endif;?><?=$item_1->name?></a>
				<?if(!empty($item_1->childs)):?>
					<ul id="sub-parent-<?=$item_1->id?>">
						<?$show_counter = 0?>
						<?foreach ($item_1->childs as $item_2):?>
							<li>
								<input type="checkbox" 
									   class="categories_checked parent-branch-<?=$item_1->id?>" 
									   name="categories_checked[]" parent="<?=$item_1->id?>" 
									   value="<?=$item_2->id?>" 
									   onclick="checked_tree('<?=$item_1->id?>', 'parent', 'child');"
									   <?if(isset($filters_checked['categories_checked']) && in_array($item_2->id, $filters_checked['categories_checked'])):?>checked<?$show_counter++?><?endif;?>
								/>
								<a href="<?=base_url()?>shop/<?=$item_1->url?>/<?=$item_2->url?>"><?=$item_2->name?></a>
							</li>
						<?endforeach;?>
						<?if($show_counter > 0):?><script>document.getElementById('sub-parent-<?=$item_1->id?>').style.display='block';</script><?endif;?>
					</ul>
				<? endif;?>
			</li>
		<?endforeach;?>
	</ul>
</div>