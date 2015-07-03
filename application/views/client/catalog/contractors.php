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
									<h1 style="padding-left: 10px;padding-top:2px;margin-top: 0px;"><?=$page_title?></h1>
									<div class="contractor_description"><?=$page_description?></div>
									<div class="manufacturer">
										<?foreach($contractors as $c):?>
											<div class="manufacturer-icon">
												<a href="<?=base_url()?>contractor/<?=$c->url?>"><img src="<?=$c->img->manufacturer_url?>" alt="<?=$c->name?>"/></a>
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
					<?require "include/contractors_left_menu.php"?>
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