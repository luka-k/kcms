<div class="pos-fix">
	<ul class="navigation clearfix">
		<?foreach($top_menu as $level_1):?>
			<li><a href="<?=$level_1->full_url?>"><?=$level_1->name?></a>
				<?if(!empty($level_1->childs)):?>
					<ul>
						<?foreach($level_1->childs as $level_2):?>
							<li><a href="<?=$level_2->full_url?>"><?=$level_2->name?></a></li>
						<?endforeach;?>
					</ul>
				<?endif;?>
			</li>
		<?endforeach;?>
		<div class="clear"></div>
	</ul>
</div>