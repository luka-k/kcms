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
									<?if(isset($page_description)):?>
										<h1 style="padding-left: 10px;padding-top:2px;margin-top: 0px;"><?=$page_title?></h1>
										<div class="main_description"><?=$page_description?></div>
									<?endif;?>
									<div class="manufacturer">
										<?foreach($manufacturers as $m):?>
											<div class="manufacturer-icon">
												<a href="<?=base_url()?>manufacturer/<?=$m->url?>"><img src="<?=$m->img->manufacturer_url?>" alt="<?=$m->name?>"/></a>
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
					<h1>Все товары</h1>
					<?require "include/left_menu.php"?>
				</aside><!--end_leftcol-->
                   
				<!-----rightcol----->
                <aside id="s_right">
					<?require "include/news_collumn.php"?>
				</aside><!--end_rightcol-->
			</div>
		</div>
	</body>
</html>