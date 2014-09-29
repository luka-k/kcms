<?require_once 'include/head.php'?>
	<div id="parent" class="clearfix">
		<?require_once 'include/header.php'?>
		
		<div id="breadcrumbs"><a href="#">Home</a> > <a href="#">Synapse Syndicate</a> > Ronin</div>
		
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
									
			  <!--<div class="clearcontainer">
				<div class="floatleft galleryimg">
				  <a href="images/ronin/ronin3.jpg" onclick="showImage('images/ronin/tumb/ronin3.jpg','images/ronin/ronin3.jpg'); return false;" title="" class='highslide'>
				    <img src="images/ronin/ronin3.jpg" title="" alt="Highslide JS"/>
				  </a>
				</div>

			    <div class="floatleft galleryimg">
				  <a href="images/ronin/ronin4.jpg" onclick="showImage('images/ronin/tumb/ronin4.jpg','images/ronin/ronin4.jpg'); return false;" title="" class='highslide'>
				    <img src="images/ronin/ronin4.jpg" title="" alt="Highslide JS"/>
				  </a>
				</div>
			  </div>	
			  <div class="clearcontainer">		  
				<div class="floatleft galleryimg">
				  <a href="images/ronin/ronin5.jpg" onclick="showImage('images/ronin/tumb/ronin5.jpg','images/ronin/ronin5.jpg'); return false;" title="" class='highslide'>
				    <img src="images/ronin/ronin5.jpg" alt="" title="" alt="Highslide JS"/>
				  </a>
				</div>
				
				<div class="floatleft galleryimg">
				  <a href="images/ronin/ronin6.jpg" onclick="showImage('images/ronin/tumb/ronin6.jpg','images/ronin/ronin6.jpg'); return false;" title="" class='highslide'>
				    <img src="images/ronin/ronin6.jpg" alt="" title="" alt="Highslide JS"/>
				  </a>
				</div>
              </div>
			  <div class="clearcontainer">
			    <div class="floatleft galleryimg">
				  <a href="images/ronin/ronin6.jpg" onclick="showImage('images/ronin/tumb/ronin6.jpg','images/ronin/ronin6.jpg'); return false;" title="" class='highslide'>
				    <img src="images/ronin/ronin6.jpg" alt="" title="" alt="Highslide JS"/>
				  </a>
				</div>
				
				<div class="floatleft galleryimg">
				  <a href="images/ronin/ronin7.jpg" onclick="showImage('images/ronin/tumb/ronin7.jpg','images/ronin/ronin7.jpg'); return false;" title="">
				    <img src="images/ronin/ronin7.jpg" alt="" title="" alt="Highslide JS"/>
				  </a>
				</div>
			  </div>	-->
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
			  <div class="price"><?=$content->price?>&euro;</div>
			  <div class="quan">
			    art. <?=$content->article?> </br>
				quantity: <input type="text" size="1" placeholder = "1"/>
			  </div>
			  <div class="add_to">
			    add to: <a href="" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;">cart</a><a href="">wish list</a>
			  </div>
			  <div class="buy">
			    <a href=""><img src="images/buy.png" alt=""/></a>
			  </div>
			  </div>
            </section>

			
		  </div>
		</div>
		<?require_once 'include/right_col.php'?>
	</div>
	<?require_once 'include/footer.php'?>
    </div>	

    <script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.tools.min.js"></script>	
	<script type="text/javascript" src="<?=base_url()?>template/client/js/common.js"></script>
    <script type="text/javascript" src="<?=base_url()?>template/client/js/highslide-full.packed.js"></script>
	
	<!--ЭТОТ СКРИПТ МЕНЯЕШЬ ЦЕЛИКОМ-->
	    <script type="text/javascript">
			var myJ = jQuery.noConflict();
			
            //<![CDATA[            
            hs.align = 'center';
            hs.dimmingOpacity = 0.75;
            hs.graphicsDir = '<?=base_url()?>template/client/images/graphics/';
            hs.wrapperClassName = 'borderless';
            hs.showCredits = false;

            hs.enableKeyListener = false;
           
			// Add the controlbar
			hs.addSlideshow({
				//slideshowGroup: 'group1',
				interval: 5000,
				repeat: false,
				useControls: true,
				fixedControls: 'fit',
				overlayOptions: {
					opacity: .75,
					position: 'bottom center',
					hideOnMouseOut: true
					}
				});

            
            $(function() {		
	            // initialize scrollable 
	            myJ("div.scrollable").scrollable({
		            vertical:true, 
		            size: 3,
			        clickable :false
	            })
                     	            
            });
            //]]>
        </script>  
		
<script>
$('ul .up').click(function() {
$(this).nextAll("ul").slideToggle().toggleClass('noactive');
$(this).toggleClass('up');
$(this).toggleClass('down');
});

$('ul .down').click(function() {
$(this).nextAll("ul").slideToggle().toggleClass('noactive');
$(this).toggleClass('down');
$(this).toggleClass('up');
});
</script>
	</body>
</html>