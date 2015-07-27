<!DOCTYPE html>
<html>
	<?require_once 'catalog/include/head.php'?>	
	<body>
		<!-------------------header--------------------->
		<? require 'include/header.php'?>
		<!-----------------end_header-------------------->
		
		<div id="wrapper clearfix">
			<div class="section maxw clearfix">
				<div class="mainwrap">
					<main id="main_page" class="sitemap">
						<article>
							
							<div id="" class="main-content clearfix">

								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									<h1 style="padding-left: 10px;padding-top:2px;margin-top: 0px;">Карта сайта</h1>
									<ul>
										<?foreach($content as $type => $map):?>
											<li>
												<?=$type?>
												<ul>
												<?foreach($map as $m):?>
													<li>
														<a href="<?=$m->full_url?>" style="color:#0066ff;"><?=$m->name?></a>
														<?if(!empty($m->childs)):?>
															<ul>
																<?foreach($m->childs as $ch):?>
																	<li>
																		<a href="<?=$ch->full_url?>" style="color:#0066ff;"><?=$ch->name?></a>
																	</li>
																<?endforeach;?>
															</ul>
														<?endif;?>
													</li>
												<?endforeach;?>
												</ul>
											</li>
										<?endforeach;?>
									</ul>
								</div>
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1>Каталог производителей</h1>
					<?require 'catalog/include/left_menu.php'?>
				</aside><!--end_leftcol-->
                   
				<!-----rightcol----->
                <aside id="s_right">
					<?require FCPATH.'application/views/client/include/news_collumn.php'?>
				</aside><!--end_rightcol-->
			</div>
		</div>
		<?require "catalog/include/footer.php"?>
	</body>
</html>