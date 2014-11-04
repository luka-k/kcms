<?require_once 'include/head.php'?>
	<div id="parent" class="clearfix">
		<?require_once 'include/header.php'?>
		
		<?require_once 'include/breadcrumbs.php'?>
		
		<div id="wrapper">
			<?require_once 'include/left_col.php'?>
			<div id="main-content">
				<div class="title"><?=$content->title?></div>
				<div class="gallery-container">
					<div id="content-container" class="floatleft productpage_main_img">
        
						<div id="mainimage">
							<!-- Main Image -->
							<a href="<?=base_url()?>download/images/catalog_mid<?=$content->img[0]->url?>" id="highslidelarge" class="highslide" onclick="return hs.expand(this)" title="">
								<img src="<?=base_url()?>download/images/catalog_mid<?=$content->img[0]->url?>" alt="Highslide JS"/>
							</a>
							
							<?if($content->img <> NULL):?>
								<div class="hidden-container">
									<?foreach($content->img as $img_item):?>
										<a href="<?=base_url()?>download/images/catalog_mid<?=$img_item->url?>" class="highslide" onclick="return hs.expand(this, { thumbnailId: 'highslidelarge' })"></a>
									<?endforeach?>
								</div>
							<?endif;?>	
						</div>
				
					</div>
					<div class="productpage_main_gallery floatleft" align="center">
						<div class="gallerytoparrow" align="center">
							<a id="prev" class="prev" href="#" onclick="return false;"><span>Previous</span></a>
						</div>
        
						<div id="alternativeImages" class="scrollable">
							<div class="items">       
								<?if($content->img <> NULL):?>
									<?$counter = 1?>
									<?foreach($content->img as $img_item):?>
										<?if($counter == 1):?><div class="clearcontainer"><?endif;?>
											<div class="floatleft galleryimg">
												<a href="<?=base_url()?>download/images/catalog_mid<?=$img_item->url?>" onclick="showImage('<?=base_url()?>download/images/catalog_mid<?=$img_item->url?>','<?=base_url()?>download/images/catalog_mid<?=$img_item->url?>',true); return false;" title="">
													<img src="<?=base_url()?>download/images/catalog_mid<?=$img_item->url?>" title="" class="thumbimgrightmargin" alt="Highslide JS" />
												</a>
											</div>
										<?if($counter == 2):?></div><?$counter = 0?><?endif;?>
										<?$counter++?>
									<?endforeach;?>
								<?endif;?>
							</div>
						</div>
						<div class="gallerybottomarrow" align="center">
							<a id="next" class="next " href="#" onclick="return false;"><span>Next</span></a>
						</div>
					</div>
				</div>
				<div id="item_info" class="clearfix">
					<section>
						<div id="item_description"><?=$content->description?></div>
						<div class="clearfix" style="width:200px; float:right;">
							<form  method="post" accept-charset="utf-8" action=""/>
							<div class="price"><?=$content->price?>&euro;</div>
							<div class="quan">
								art. <?=$content->article?> </br>
								quantity: <input type="text" size="1" name="qty" id="qty" placeholder = "1"/>
							</div>
							<div class="add_to">
								add to: <a href="#" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;" onclick="add_to_cart('<?=$content->id?>', $('#qty').val()); return false">cart</a><a href="#" onclick="add_to_wishlist('<?=$item->id?>'); return false">wish list</a>
							</div>
							<div class="buy">	
								<a href=""><img src="images/buy.png" alt=""/></a>
							</div>
							</form>
						</div>
					</section>
				</div>
			</div>
			<?require_once 'include/right_col.php'?>
		</div>
		<?require_once 'include/footer.php'?>
	</div>
	<?require_once "include/gallery-script.php"?>
</body>
</html>