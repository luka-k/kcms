<ul class="sidebar-menu">
	<li class="sidebar-menu__item">
		<a href="/" class="sidebar-menu__href">Галерея (the best)</a>
	</li> <!-- /.sidebar-menu__item -->
	
	<?foreach($tree as $branch):?>	
			<li class="sidebar-menu__item">
				<a href="<?=$branch->full_url?>" class="sidebar-menu__href <?if(in_array($branch->url, $url)):?>active<?endif;?>"><?=$branch->name?></a>
				<?if($branch->childs):?>
					<ul class="sidebar-menu-level2 <?if(in_array($branch->url, $url)):?>active<?else:?>noactive<?endif;?>">
						<?foreach($branch->childs as $branch_2):?>	
							<li class="sidebar-menu-level2__item">
								<a href="<?=$branch_2->full_url?>" class="sidebar-menu-level2__href <?if(in_array($branch_2->url, $url)):?>active<?endif;?>"><?=$branch_2->name?></a>
								<?if($branch_2->childs):?>
									<ul class="sidebar-menu-level3 <?if(in_array($branch_2->url, $url)):?>active<?else:?>noactive<?endif;?>">
										<?foreach($branch_2->childs as $branch_3):?>	
											<li class="sidebar-menu-level3__item" onmouseover="$('#project1').addClass('hover-image-hover')" onmouseout="$('#project1').removeClass('hover-image-hover')" >
											    <a href="<?=$branch_3->full_url?>" class="sidebar-menu-level3__href <?if(in_array($branch_3->url, $url)):?>active<?endif;?>"><?=$branch_3->name?></a>
											</li>
										<?endforeach;?>
									</ul>
								<?endif;?>
							</li>
						<?endforeach;?>
					</ul>
				<?endif;?>
			</li> <!-- /.sidebar-menu__item -->	
	<?endforeach;?>
</ul>