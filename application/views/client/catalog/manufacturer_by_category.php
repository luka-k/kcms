<!DOCTYPE html>
<html>
	<?require_once 'include/head.php'?>	
	<body>
		<!-------------------header--------------------->
		<? require FCPATH.'application/views/client/include/header.php'?>
		<!-----------------end_header-------------------->
		
		<div id="wrapper clearfix">
			<div class="section maxw clearfix">
				<div class="mainwrap">
					<main id="by_category">
						<article>
							<?require FCPATH.'application/views/client/include/breadcrumbs.php'?>
							<div id="" class="main-content clearfix">
		
								<div id="scroll-content" class="catalog" style="height:600px; overflow-y:scroll;">
									
									<h1 class="manufacturer-title">
										Каталог производителей - <?=$page_title?>
									</h1>
									<div class="shop_link">
										<a href="http://shop.brightbuild.ru/catalog/<?if(isset($shop_link)):?><?=$shop_link?><?endif;?>" title="Интернет магазин<?if(isset($shop_link_title)):?><?=$shop_link_title?><?endif;?>">
												Интернет-магазин
										</a>
									</div>
									<div id="manufacturers" class="manufacturers">
										<?$manufacturer_counter = 1?>
										<?foreach($manufacturers as $m):?>
										<div class="manufacturer-item">
											<div class="manufacturer-logo">
												<a href="<?=base_url()?>catalog/<?=$a_link?>/<?=$m->url?>"><img src="<?=$m->img->manufacturer_url?>" alt="<?=$m->name?>"/></a>
											</div>
											<div class="manufacturer-categories-list list-row" colqty="3">
												<ul class="list_box l-b-<?=$manufacturer_counter?>">
													<div class="manu_col">
														<?$cat_counter = 1?>
														<?foreach($m->categories as $category):?>
															<li class="cat_list-<?=$manufacturer_counter?> <?if($category->url == $active_category):?>active<?endif;?>">
																<a href="<?=base_url()?>catalog/<?=$a_link?>/<?=$m->url?>"><?=$category->name?></a>
															</li>
															<?$cat_counter++?>
															<?if($cat_counter == 5):?></div><div class="manu_col"><?$cat_counter = 1?><?endif;?>
														<?endforeach;?>
													</div>
												</ul>
											</div>
										</div>
										<?$manufacturer_counter++?>
										<?endforeach;?>
									</div>
										<div class="seo_description">
											<?= $seo_description?>
										</div>
								</div>
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1><?=$above_menu_title?></h1>
					<?require 'include/left_menu.php'?>
				</aside><!--end_leftcol-->
                   
				<!-----rightcol----->
                <aside id="s_right">
					<?require FCPATH.'application/views/client/include/news_collumn.php'?>
				</aside><!--end_rightcol-->
			</div>
		</div>
		<?require "include/footer.php"?>
	</body>
</html>