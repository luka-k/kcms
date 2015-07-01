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
					<main id="inventory" class="inventory">
						<article>
							<div id="" class="main-content clearfix">
		
								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									<?foreach($inventories as $inv):?>
										<div class="inventory_item">
											<a href="<?=base_url()?>getdoc/<?=$inv->download_code?>" target="_blank">
												<img src="<?=base_url()?>template/client/catalog/images/<?=$inv->file_type?>.png" alt="<?=$inv->name?>" />
												<?=$inv->name?>
											</a>
										</div>
									<?endforeach;?>
								</div>
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1>Складские остатки</h1>
					<div id="slider-scroll" class="slider inventory-slider">
						<div class="for-select">
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="manufacturer-form" class="filter-form" action="<?=base_url()?>shop/manufacturer/" >
								<select name="" class="dropdown" onchange="manufacturer_submit('inventory',this.options[this.selectedIndex].value);">
									<option value="1" disabled="" selected="selected">выбор производителя</option>
									<?foreach($manufacturers as $m):?>
										<option value="<?=$m->url?>"><?=$m->name?></option>
									<?endforeach;?>
								</select>
							</form>
						</div>
								
						<div class="logo-column">
							<div class="some10">
								<?foreach($manufacturers as $m):?>
									<div class="pic-block">
										<a href="<?=base_url()?>inventory/<?=$m->url?>"><img src="<?=$m->img->manufacturer_url?>" height="78" width="164" alt="<?=$m->name?>"></a>
									</div>
								<?endforeach;?>
							</div>
						</div>
					</div>
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