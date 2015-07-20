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
					<main id="vendor">
						<article>
							<?require "include/breadcrumbs.php"?>
							<div id="" class="main-content clearfix">
		
								<div id="slider-scroll" class="slider">
									<div class="for-select">
										<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="manufacturer-form" class="filter-form" action="<?=base_url()?>shop/manufacturer/" >
										<select name="" class="dropdown" onchange="manufacturer_submit('vendor', this.options[this.selectedIndex].value);">
											<option value="1" disabled="" selected="selected">выбор продавца</option>
											<?foreach($vendors as $v):?>
												<option value="<?=$v->url?>"><?=$v->name?></option>
											<?endforeach;?>
										</select>
										</form>
									</div>
									<div class="logo-column">
										<div class="some10">
											<?foreach($vendors as $v):?>
												<div class="pic-block">
													<a href="<?=base_url()?>vendor/<?=$v->url?>"><img src="<?=$v->img->manufacturer_url?>" height="78" width="164" alt="<?=$v->name?>"></a>
												</div>
											<?endforeach;?>
										</div>
									</div>
								</div>
								
								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									<h1 class="title" style="padding-left: 10px;padding-top:2px;margin-top: 0px;"><?=$vendor->name?></h1>
									<div class="top-gp">
										<div class="main-logo" style="float: left;padding-right: 20px;">									
											<a href="<?=$vendor->link?>" rel="nofollow" target="_blank" style="color:#009bdb"><img alt="<?=$vendor->name?> производитель <?=$vendor->name?>" title="<?=$vendor->name?> продажа в СПб" src="<?=$vendor->img->manufacturer_url?>" /></a>
										</div>
										<div>
											<p style="color:#009bdb;line-height:12px;font-size: 13px;padding-bottom: 8px;"><a href="http://<?=$vendor->link?>" rel="nofollow" target="_blank" style="color:#009bdb"><?=$vendor->link?></a></p>
											<p style="color:#009bdb;line-height:12px;font-size: 13px;padding-bottom: 8px;"><a target="_blank" style="color:#009bdb" href="mailto:<?=$vendor->email?>"><?=$vendor->email?></a></p>
											<p style="line-height:12px;font-size: 13px;padding-bottom: 8px;"><?=$vendor->phone?></p>
											<p style="line-height:12px;font-size: 13px;padding-bottom: 8px;"><?=$vendor->city?></p>
										</div>
										<span class="country"></span>
									</div><br>
									
									<div style="margin-top: 3px;width: 100%;">
										<?if(!empty($vendor->categories)):?>
											<ul id="myul" style="width: 300px; margin-left:20px; float: left; ">
												<?foreach($vendor->categories as $category):?>
													<li >
														<a nohref>
															<img src="<?=$category->img->full_url?>" style="padding-bottom: 3px;margin-right: 5px;margin-top:10px;margin-bottom:-5px;"/>
															<?=$category->name?>
														</a>
													</li>
													<?foreach($category->childs as $sub_category):?>
														<li  style="font-size: 14px;">
															<a nohref>
																&nbsp;&nbsp;
																<img src="<?=base_url()?>template/client/catalog/images/disc.png" style="padding-bottom: 3px;margin-left:17px;margin-right:5px;"/>
																<?=$sub_category->name?>
															</a>
														</li>
													<?endforeach;?>
												<?endforeach;?>
											</ul>
										<?endif;?>
										
										<p style="font-size: 14px;padding-top: 13px;font-weight: bold;">
											В компании <?=$vendor->name?> вы можете купить/заказать<br>
											продукцию следующих производителей:
										</p>
										<?foreach($vendor->distributed as $d):?>
											<a href="<?=base_url()?>manufacturer/<?=$d->url?>">
												<img src="<?=$d->img->manufacturer_url?>" style="float: left;" alt='<?=$d->name?>'/>
											</a>
										<?endforeach;?>
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
					<?require "include/vendors_left_menu.php"?>
				</aside><!--end_leftcol-->
                   
				<!-----rightcol----->
                <aside id="s_right">
					<?require "include/news_collumn.php"?>
				</aside><!--end_rightcol-->
			</div>
		</div>
		<?require "include/footer.php"?>
	</body>
</html>