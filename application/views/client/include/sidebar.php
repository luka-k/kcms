<aside class="sidebar">
	<div class="filters" style="margin-bottom:15px;">
		<form action="<?=base_url()?>catalog" id="filter-form" class="form" method="get">
			<input type="hidden" name="filter" value="true">
			<?foreach($filters as $type=> $filter):?>
				<?require "filters/{$filter->editor}.php"?>
			<?endforeach;?>	
		</form>
	</div>

	<?foreach($left_menu as $level_1):?>
		<div class="sidebar-module">
			<!--<div class="sidebar-module-heading">
				<h4 class="sidebar-module-title"><a href="<?=$level_1->full_url?>"><?=$level_1->name?></a></h4>
			</div>-->
			
			<?if(isset($level_1->childs) && strstr(str_replace('//catalog', '/catalog', base_url().$_SERVER['REQUEST_URI']), $level_1->full_url) !== false):?>
				<div class="sidebar-module-body">
					<?foreach($level_1->childs as $level_2):?>
						<div class="sidebar-module-heading">
							<h4 class="sidebar-module-title">
								<a href="<?=$level_2->full_url?>"><?=$level_2->name?></a>
							</h4>
						</div>
						<?if(isset($level_2->childs) && strstr(str_replace('//catalog', '/catalog', base_url().$_SERVER['REQUEST_URI']), $level_2->full_url) !== false):?>
							<ul class="list-unstyled" style="margin-left:15px;">
								<?foreach($level_2->childs as $level_3):?>
											<li><a href="<?=$level_3->full_url?>"><?=$level_3->name?></a>
												<?if(isset($level_3->childs) && strstr(str_replace('//catalog', '/catalog', base_url().$_SERVER['REQUEST_URI']), $level_3->full_url)):?>
													<ul class="list-unstyled" style="margin-left:15px;display: <?= strstr(str_replace('//catalog', '/catalog', base_url().$_SERVER['REQUEST_URI']), $level_3->full_url) ? 'block':'none'?>">
														<?foreach($level_3->childs as $level_4):?>
															<li><a href="<?=$level_4->full_url?>"><?=$level_4->name?></a>
																<?if(isset($level_4->childs) && strstr(str_replace('//catalog', '/catalog', base_url().$_SERVER['REQUEST_URI']), $level_4->full_url)):?>
																	<ul class="list-unstyled" style="margin-left:15px;display: <?= strstr(str_replace('//catalog', '/catalog', base_url().$_SERVER['REQUEST_URI']), $level_4->full_url) ? 'block':'none'?>">
																		<?foreach($level_4->childs as $level_5):?>
																			<li><a href="<?=$level_5->full_url?>"><?=$level_5->name?></a>
																				<?if(isset($level_5->childs)):?>
																					<ul class="list-unstyled" style="margin-left:15px;display: <?= strstr(str_replace('//catalog', '/catalog', base_url().$_SERVER['REQUEST_URI']), $level_5->full_url) ? 'block':'none'?>">
																						<?foreach($level_5->childs as $level_6):?>
																							<li><a href="<?=$level_6->full_url?>"><?=$level_6->name?></a></li>
																						<?endforeach?>
																					</ul>
																				<?endif;?>
																			</li>
																		<?endforeach?>
																	</ul>
																<?endif;?>
															</li>
														<?endforeach?>
													</ul>
												<?endif;?>
											</li>
										<?endforeach?>
									</ul>
								<?endif;?>
						<?endforeach;?>
					</ul>
				</div>
			<?endif;?>
		</div>
	<?endforeach;?>
</aside>