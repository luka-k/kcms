﻿<!DOCTYPE html>
<html>
	<?require_once 'include/head.php'?>	
	<body>
		<!-------------------header--------------------->
		<? require FCPATH.'application/views/client/include/header.php'?>
		<!-----------------end_header-------------------->
		
		<div id="wrapper clearfix">
			<div class="section maxw clearfix">
				<div class="mainwrap">
					<main id="vendor">
						<article>
							<?require FCPATH.'application/views/client/include/breadcrumbs.php'?>
							<div id="" class="main-content clearfix">
		
								<div id="slider-scroll" class="slider">
									<div class="for-select">
										<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="manufacturer-form" class="filter-form" action="<?=base_url()?>shop/manufacturer/" >
										<select name="" class="dropdown" onchange="manufacturer_submit('contractor', this.options[this.selectedIndex].value);">
											<option value="1" disabled="" selected="selected">Выбор подрядчика</option>
											<?foreach($contractors as $c):?>
												<option value="<?=$c->url?>"><?=$c->name?></option>
											<?endforeach;?>
										</select>
										</form>
									</div>
									<div class="logo-column">
										<div class="some10">
											<?foreach($contractors as $c):?>
												<div class="pic-block">
													<a href="<?=base_url()?>contractor/<?=$c->url?>">
														<img src="<?=$c->img->manufacturer_url?>" height="78" width="164" alt="<?=$c->name?>" class="logotype <?if($c->url == $contractor->url):?>active<?endif;?>" />
													</a>
												</div>
											<?endforeach;?>
										</div>
									</div>
								</div>
								
								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									<h1 class="title" style="padding-left: 10px;padding-top:2px;margin-top: 0px;">
										<?=$h1_title?>
									</h1>
									<div class="top-gp">
										<div class="main-logo" style="float: left;padding-right: 20px;">									
											<a href="http://<?=$contractor->link?>" rel="nofollow" target="_blank" style="color:#009bdb"><img alt="<?=$contractor->name?> производитель <?=$contractor->name?>" title="<?=$contractor->name?> продажа в СПб" src="<?=$contractor->img->manufacturer_url?>" /></a>
										</div>
										<div>
											<p style="color:#009bdb;line-height:12px;font-size: 13px;padding-bottom: 8px;"><a href="http://<?=$contractor->link?>" rel="nofollow" target="_blank" style="color:#009bdb"><?=$contractor->link?></a></p>
											<p style="color:#009bdb;line-height:12px;font-size: 13px;padding-bottom: 8px;"><a target="_blank" style="color:#009bdb" href="mailto:<?=$contractor->email?>"><?=$contractor->email?></a></p>
											<p style="line-height:12px;font-size: 13px;padding-bottom: 8px;"><?=$contractor->phone?></p>
											<p style="line-height:12px;font-size: 13px;padding-bottom: 8px;"><?=$contractor->city?></p>
										</div>
										<span class="country"></span>
									</div><br>
									
									<div style="margin-top: 25px;width: 90%;">
										<?if(!empty($contractor->services)):?>
											<ul id="myul" style="width: 100%; margin-left:20px; float: left; ">
												<?foreach($contractor->services as $service):?>
													<li >
														<a nohref><?=$service->name?></a>
													</li>
													<?foreach($service->childs as $sub_category):?>
														<li  style="font-size: 14px;">
															<a nohref>
																<img src="<?=base_url()?>template/client/images/disc.png" style="padding-bottom: 3px; margin-right:5px;"/>
																<?=$sub_category->name?>
															</a>
														</li>
													<?endforeach;?>
												<?endforeach;?>
											</ul>
										<?endif;?>
									</div>
									<div style="font-size: 12px;line-height: 14px;"></div>
								</div>
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1><?=$above_menu_title?></h1>
					<?require "include/contractors_left_menu.php"?>
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