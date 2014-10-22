<div id="attr-2" class="clearfix noactive">
	<div id="attribut" class="clearfix">
		<ul>
			<li class="accd">
				<div class="attr-titl open">Производители</div>
				<ul class="show">
					<?$counter_2 = 1?>
					<?foreach($manufacturer as $firma):?>
						<li>
							<input type="checkbox" class="manufacturer_checked" name="manufacturer_checked" num="<?=$counter_2?>" value="<?=$firma->id?>" id="c_1_1" onclick="category_filter()" 
								<?if(!empty($manufacturer_checked)):?>
									<?foreach($manufacturer_checked as $ch):?>
										<?if($ch == $firma->id):?>checked<?endif;?>
									<?endforeach;?>
								<?endif;?>>
								<a href="#"><?=$firma->name?></a>
						</li>
						<?$counter_2++?>
					<?endforeach;?>
				</ul>
			</li>
		</ul>
	</div>
</div>