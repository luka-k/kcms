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
										<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="manufacturer-form" class="filter-form" action="<?=base_url()?>shop/manufacturer/" >
										<select name="" class="dropdown" onchange="manufacturer_submit('vendor', this.options[this.selectedIndex].value);">
											<option value="" disabled="" selected="selected" >выбор продавца</option>
											<?foreach($vendors as $v):?>
												<option value="<?=$v->url?>"><?=$v->name?></option>
											<?endforeach;?>
										</select>
										</form>
									</div>
									<h1 class="manufacturer-title">
										Каталог продавцов - <?=$page_title?>
									</h1>
									<div id="manufacturers" class="manufacturers">
										<?$manufacturer_counter = 1?>
										<?foreach($vendors as $v):?>
										<div class="manufacturer-item">
											<div class="manufacturer-logo">
												<a href="<?=base_url()?>vendor/<?=$v->url?>"><img src="<?=$v->img->manufacturer_url?>" alt="<?=$v->name?>"/></a>
											</div>
											<div class="manufacturer-categories-list list-row" colqty="3">
												<ul class="list_box l-b-<?=$manufacturer_counter?>">
													<div class="manu_col">
														<?$cat_counter = 1?>
														<?foreach($v->categories as $category):?>
															<li class="cat_list-<?=$manufacturer_counter?> <?if($category->url == $active_category):?>active<?endif;?>">
																<?=$category->name?>
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
					<h1><?=$above_menu_title?></h1>
					<?require "include/vendors_left_menu.php"?>
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