<div id="attr-1" class="clearfix <?if($left_active == "filt-1"):?>active<?else:?>noactive<?endif;?>">
	<div id="attribut" class="clearfix">
		<ul>
			<?$counter = 1?>
			<?foreach($left_menu as $item_1):?>
				<li class="accd">
					<? if(!empty($item_1->childs)):?>
						<input type="checkbox" class="parent_checked category-<?=$item_1->id?>"  value="<?=$item_1->id?>" onclick="filter('<?=$item_1->id?>')" 
							<?if(!empty($parent_checked)):?>
								<?foreach($parent_checked as $key => $item):?>
									<?if($item == $item_1->id):?>checked<?endif;?>
								<?endforeach;?>
							<?endif;?>
						/>
					<?endif;?>
					<div class="attr-titl open"><?=$item_1->name?></div>
					<? if(!empty($item_1->childs)):?>
						<ul class="show">
							<?foreach ($item_1->childs as $item_2):?>
								<li>
									<input type="checkbox" class="categories_checked" name="cetegories_checked" num="<?=$counter?>" parent="<?=$item_1->id?>" value="<?=$item_2->id?>" onclick="filter()" 
									<?if(!empty($categories_checked)):?>
										<?foreach($categories_checked as $key => $ch):?>
											<?if($key == $counter):?>checked<?endif;?>
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
</div>