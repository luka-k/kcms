<aside class="sidebar">
	<?foreach($left_menu as $level_1):?>
		<div class="sidebar-module">
			<div class="sidebar-module-heading">
				<h4 class="sidebar-module-title"><a href="<?=$level_1->full_url?>"><?=$level_1->name?></a></h4>
			</div>
			<?if(isset($level_1->childs)):?>
				<div class="sidebar-module-body clearfix">
					<ul class="list-unstyled">
						<?foreach($level_1->childs as $level_2):?>
							<li>
								<a href="<?=$level_2->full_url?>"><?=$level_2->name?></a>
								<?if(isset($level_2->childs)):?>
									<ul class="list-unstyled" style="margin-left:15px;">
										<?foreach($level_2->childs as $level_3):?>
											<li><a href="<?=$level_3->full_url?>"><?=$level_3->name?></a></li>
										<?endforeach?>
									</ul>
								<?endif;?>
							</li>
						<?endforeach;?>
					</ul>
				</div>
			<?endif;?>
		</div>
	<?endforeach;?>
</aside>