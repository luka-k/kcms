<div class="menu__scroll">
<ul class="sidebar-menu">
	<?if(in_array("works", $url)||empty($url)):?>
		<li class="sidebar-menu__item">
			<a href="/" class="sidebar-menu__href <?if($_SERVER['REQUEST_URI'] == '/'):?>active<?endif;?>">Галерея (the best)</a>
		</li> <!-- /.sidebar-menu__item -->
	<?endif;?>
	<?foreach($tree as $branch):?>	
			<li class="sidebar-menu__item"> 
				<a href="<?=$branch->full_url?>/" class="sidebar-menu__href <?if(in_array($branch->url, $url)):?>active<?endif;?>" id="m_objects_<?= $branch->id?>" onmouseover="$('#objects_<?= $branch->id?>').addClass('inside-navigation__image__hover'); $('#objects_<?= $branch->id?>').parent().addClass('active'); $('#objects_<?= $branch->id?>').mouseenter();" onmouseout="$('#objects_<?= $branch->id?>').parent().removeClass('active');$('#objects_<?= $branch->id?>').removeClass('inside-navigation__image__hover'); $('#objects_<?= $branch->id?>').mouseout();" 
				<?if(str_replace('/', '', $branch->full_url) == str_replace('/','', 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])):?>
				onclick = "$('#child_<?=$branch->id?>').toggle('slow');return false" 
				<? else:?>
				<? endif?>
				>
					<?if(in_array("articles", $url)):?>
						<?=$branch->menu_name?>
					<?else:?>
						<?=$branch->name?>
					<?endif;?>
				</a>
				<?if(isset($branch->childs)&& !empty($branch->childs)):?>
					<ul id="child_<?=$branch->id?>" class="sidebar-menu-level2  <?if($branch->full_url == 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']):?>_animate <?endif?> <?if(in_array($branch->url, $url)):?>active<?else:?>noactive<?endif;?>" <?if($branch->full_url == 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']):?>style="display: none;" <?endif?>
					>
						<?foreach($branch->childs as $branch_2):?>	
							<li class="sidebar-menu-level2__item">
								<a href="<?=$branch_2->full_url?>/" class="sidebar-menu-level2__href <?if(in_array($branch_2->url, $url)):?>active<?endif;?>"
								 
				<?if($branch_2->full_url.'/' == 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']):?>
				onclick = "$('#child_l3_<?=$branch_2->id?>').toggle('slow');return false" 
				<? else:?>
				onclick = "$('.sidebar-menu-level2__item ul.active').toggle('slow');" 
				<? endif?>

				id="m_objects_<?= $branch_2->id?>" onmouseover="$('#objects_<?= $branch_2->id?>').addClass('inside-navigation__image__hover'); $('#objects_<?= $branch_2->id?>').parent().addClass('active'); $('#objects_<?= $branch_2->id?>').mouseenter();" onmouseout="$('#objects_<?= $branch_2->id?>').parent().removeClass('active');$('#objects_<?= $branch_2->id?>').removeClass('inside-navigation__image__hover'); $('#objects_<?= $branch_2->id?>').mouseout();" 
								>
									<?if(in_array("articles", $url)):?>
										<?=$branch_2->menu_name?>
									<?else:?>
										<?=$branch_2->name?>
									<?endif;?>
								</a>
								<?if($branch_2->childs):?>
									<ul id="child_l3_<?=$branch_2->id?>" class="sidebar-menu-level3 <?if($branch_2->full_url == 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']):?>_animate <?endif?> <?if(in_array($branch_2->url, $url)):?>active<?else:?>noactive<?endif;?>"
									<?if($branch_2->full_url == 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']):?>style="display: none;" <?endif?>
									>
										<?foreach($branch_2->childs as $branch_3):?>	
											<li class="sidebar-menu-level3__item" onmouseover="$('#project<?= $branch_3->id?>').addClass('hover-image-hover')" onmouseout="$('#project<?= $branch_3->id?>').removeClass('hover-image-hover')" >
											    <a href="<?=$branch_3->full_url?><?= $this->uri->segment(1)=='catalog' && !$this->uri->segment(5)?'/preview':''?>/" id="mp_objects_<?= $branch_3->id?>" class="sidebar-menu-level3__href <?if(in_array($branch_3->url, $url)):?>active<?endif;?>">
													<?if(in_array("articles", $url)):?>
														<?=$branch_3->menu_name?>
													<?else:?>
														<?=$branch_3->name?>
													<?endif;?>
												</a>
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
</div>