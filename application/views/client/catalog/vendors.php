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
					<main id="main_page">
						<article>
							
							<div id="" class="main-content clearfix">

								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									<div class="vendors_description"><?=$content_description?></div>
									<div class="manufacturer">
										<?foreach($vendors as $v):?>
											<div class="manufacturer-icon">
												<a href="<?=base_url()?>vendor/<?=$v->url?>"><img src="<?=$v->img->manufacturer_url?>" alt="<?=$v->name?>"/></a>
											</div>
										<?endforeach;?>
									</div>
								</div>
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1>Каталог продавцов</h1>
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