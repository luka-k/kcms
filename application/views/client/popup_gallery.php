<div class="gallery">
	<? if ($_GET['action'] != 'map'): ?>
		<div class="gallery__slider gallery-slider">
			<ul class="gallery-slider__list">
				<?foreach($gallery as $g):?>
					<?
						$object_type = $g->object_type;
						$object_name = $this->$object_type->get_item($g->object_id)->name;
					?>
					<li class="gallery-slider__item clearfix">
						<? if (strstr($g->caption, 'youtube:')): ?>
							<iframe width="100%" height="95%" style="margin-top: 14px;" src="https://www.youtube.com/embed/<?= str_replace('youtube:', '', $g->caption)?>" frameborder="0" allowfullscreen></iframe>
						<? else: ?>
							<img src="<?=$g->catalog_big_url?>" class="gallery-slider__image" alt="<?if(!empty($g->alt)):?><?= $g->alt?><?else:?><?= $object_name?><?endif;?>"/>
						<? endif?>
					</li> <!-- /.gallery-slider__item-->
					
				<?endforeach;?>
			</ul> <!-- /.gallery-slider__list -->
		</div> <!-- /.gallery__slider gallery-slider -->
	<? else: ?>
		<? 
			$article = $this->articles->prepare($this->articles->get_item($_GET['contact_id']));
			$title = explode("\n", strip_tags($article->description));
			$_GET['title'] = trim($title[1]) ? trim($title[1]) : trim($title[2]);
		?>
		
		<div class="gallery__slider gallery-slider">
			<ul class="gallery-slider__list">
				<li class="gallery-slider__item">
					<img src="<?=$article->img[count($article->img)-1]->catalog_big_url?>" alt="project" class="gallery-slider__image" />
				</li> <!-- /.gallery-slider__item-->
				<li class="gallery-slider__item">
					<div id="yandexMap" style="margin: auto; padding: auto; width: 800px; height: 600px;margin-top: 10px;"></div>
				</li> <!-- /.gallery-slider__item-->
			</ul> <!-- /.gallery-slider__list -->
		</div> <!-- /.gallery__slider gallery-slider -->
		
		<a href="/printmap/<?= $_GET['start'] == 'real' ? 'real' : 'ymap'?>/<?=$article->id?>" id="maplink" target="_blank" class="gallery-menu__title_" style="float: right; margin-top: 15px; padding-top: 15px;color: #EE8D1A;border-bottom: 2px solid #C6DA2D; margin-right: 10px;text-decoration: none; font-size: 16px;">печать карты</a>
		<div id="th_1" onmousedown="$('#maplink').attr('href', '/printmap/real/<?=$article->id?>');"></div>
		<div id="th_2" onmousedown="$('#maplink').attr('href', '/printmap/ymap/<?=$article->id?>');"></div>
	<? endif?>
	
	<div class="gallery__text" <? if ($_GET['action'] == 'map'): ?> style="width: 500px;"<?endif?>>
		<? if (!$_GET['nolinks'] && $_GET['action'] != 'map') : ?>
			<div class="gallery__menu gallery-menu">
				<div class="gallery-menu__menu" style="">
					<ul class="gallery-menu__list">
					</ul> <!-- /.gallery-menu__menu -->
				</div> <!-- /.gallery-menu__menu -->
				<a href="" id="title_link" class="gallery-menu__title"><?=$gallery_title?></a> <!-- /.gallery__category -->
			</div> <!-- /.gallery__menu -->
			
			<div id="img_caption" style="display: <?= $display_caption?>;"></div>
		<? endif ?>
		
		<div class="gallery__name gallery-menu__title2" style="color: white;<? if ($_GET['action'] == 'map'): ?>padding-top: 30px;<?endif?>"><?= urldecode ($_GET['title'])?></div> <!-- /.gallery__name -->
	</div> <!-- /.gallery__text -->
	
</div>

<? if ($_GET['action'] != 'map'):?>
	<div class="gallery__thumbs gallery-thumbs-slider <?if($_GET['type'] == 'catalog'):?>catalog_slider<?endif;?>">
		<ul class="gallery-thumbs-slider__list"
			style="<?if(isset($_GET['my_parent']) && $_GET['type'] == "catalog"):?>margin-top:15px;<?endif;?>">
			
			<?$counter=1?>
			<?foreach($gallery as $g):?>
				<?
					$object_type = $g->object_type;
					$object_name = $this->$object_type->get_item($g->object_id)->name;
				?>
				<li class="gallery-thumbs-slider__item" style="<?= $_GET['my_parent'] ? 'padding-top: 0px;' : ''?>">
					<a href="#slide<?=$counter?>" 
						titlelinkname="<?= $g->titlelinkname ?>" 
						titlelink="<?= $g->titlelink ?>" 
						captionlink="<?= $g->caption ?>" 
						links="<?= $g->links ?>" 
						id="th_<?= $counter?>" 
						title="<?if(!empty($g->title)):?><?= $g->title?><?else:?><?= $object_name?><?endif;?>"
						<?= $_GET['type'] == 'catalog' ? 'style="padding-top:15px;"' : ''?> class="gallery-thumbs-slider__href gallery__thumb popup_href" 
						onmousedown="slideMouseDown('<?= $g->links ?>', '<?= $g->titlelink ?>', '<?= $g->titlelinkname ?>');" >
						
						<img src="<?= $_GET['type'] == 'catalog' ? $g->catalog_small_v_url : $g->catalog_small_url?>" alt="<?if(!empty($g->alt)):?><?= $g->alt?><?else:?><?= $object_name?><?endif;?>" class="thumbs-slider-image gallery-thumbs-slider__image<?= $_GET['type'] == 'catalog' ? ($_GET['my_parent'] ? '3' : '2') : ''?> hover-image<?= $_GET['type'] == 'catalog' ? ($_GET['my_parent'] ? '3' : '2') : ''?>" />
					</a>
				</li> <!-- /.gallery-thumbs-slider__item -->
				<?$counter++?>
			<?endforeach;?>
		</ul> <!-- /.gallery-thumbs-slider__list -->
	</div> <!-- /.gallery__thumbs -->
<? endif?>
<script>
	function updateMenuList(html) {
		$('.gallery-menu__list').html(html);
		
		<?if ($_GET['my_parent']):?>
			$('.gallery__name').css('margin-bottom', '10px');
		<?endif?>
	}
	
	function slideMouseDown(links, titleLink, titleLinkName){
		updateMenuList(links);
		$('#title_link').attr('href', titleLink);
		$('#title_link').html(titleLinkName);

		if (!$('#title_link').html())
			$('#title_link').hide();
		else 
			$('#title_link').show();
		
		$('#img_caption').html($(this).attr('captionlink'));
	}
	
	$('.gallery__thumb').mousedown(function(){
		var slideId = parseInt( $(this).attr('href').replace('#slide', '') );
		gallerySlider.goToSlide( slideId - 1 ); 
	});
	
	$('.thumbs-slider-image').mouseenter(function(){
		$('.gallery__text').css('z-index', '0');
		$('.gallery__thumbs').css('z-index', '100');
	});
	
	$('.thumbs-slider-image').mouseleave(function(){
		$('.gallery__text').css('z-index', '100');
		$('.gallery__thumbs').css('z-index', '0');
	});
	
</script>
<input type="hidden" name="is_catalog" class="is_catalog" value="<?if($_GET['type'] == 'catalog'):?>1<?else:?>0<?endif;?>">
<div id="active_id" style="display: none;"><?= $_GET['first_img']?></div>