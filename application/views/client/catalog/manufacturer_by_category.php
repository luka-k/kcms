<!DOCTYPE html>
<html>
	<?require_once 'include/head.php'?>	
	<body>
		<!-------------------header--------------------->
		<? require 'include/header.php'?>
		<!-----------------end_header-------------------->
		
		<div id="wrapper clearfix">
			<div class="section maxw clearfix">
				<div class="mainwrap">
					<main id="by_category">
						<article>
							<?require "include/breadcrumbs.php"?>
							<div id="" class="main-content clearfix">
		
								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									<div class="manufacturer-select">
										<select name="" class="dropdown">
											<option value="" disabled="" selected="selected" >выбор производителя</option>
											<?foreach($manufacturers as $m):?>
												<option value="<?=$m->id?>"><?=$m->name?></option>
											<?endforeach;?>
										</select>
									</div>
									<div class="manufacturer-title">
										Каталог производителей - <?=$page_title?>
									</div>
									<div id="manufacturers" class="manufacturers">
										<?$manufacturer_counter = 1?>
										<?foreach($manufacturers as $m):?>
										<div class="manufacturer-item">
											<div class="manufacturer-logo">
												<a href=""><img src="<?=$m->img->manufacturer_url?>" alt="<?$m->name?>"/></a>
											</div>
											<div class="manufacturer-categories-list list-row">
												<ul class="list_box l-b-<?=$manufacturer_counter?>">
													<div class="manu_col">
														<?$cat_counter = 1?>
														<?foreach($m->categories as $category):?>
															<li class="cat_list-<?=$manufacturer_counter?> <?if($category->url == $active_category):?>active<?endif;?>">
																<a href=""><?=$category->name?></a>
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
								</div>
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1>Все товары</h1>
					<?require "include/left_menu.php"?>
				</aside><!--end_leftcol-->
                   
				<!-----rightcol----->
                <aside id="s_right">
					<h1>Новости</h1>
					<div id="scroll-right" class="rightmenu">
						<?foreach($last_news as $item):?>
							<div class="news_item">
								<h2><?=$item->name?></h2>
								<div class="item_text"><?=$item->description?></div>
							</div>
						<?endforeach;?>
					</div>
				</aside><!--end_rightcol-->
			</div>
		</div>
	</body>
</html>