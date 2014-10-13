<div id="attr-1" class="clearfix noactive">
	<div id="attribut" class="clearfix">
		<ul>
			<?$counter = 1?>
			<?foreach($left_menu as $item_1):?>
				<li class="accd">
					<div class="attr-titl open"><?=$item_1->name?></div>
					<? if(!empty($item_1->childs)):?>
						<ul class="show">
							<?foreach ($item_1->childs as $item_2):?>
								<li>
									<input type="checkbox" name="cetegories_checked[<?=$counter?>]" value="<?=$item_2->id?>" id="c_1_1" onclick="document.forms['form-1'].submit()" 
									<?if(!empty($categories_checked)):?>
										<?foreach($categories_checked as $key => $ch):?>
											<?if($key == $counter):?>checked<?endif;?>
										<?endforeach;?>
									<?endif;?>>
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