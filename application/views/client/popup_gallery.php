<div class="gallery">
	<div class="gallery__slider gallery-slider">
		<ul class="gallery-slider__list">
			<?foreach($gallery as $g):?>
				<li class="gallery-slider__item">
					<img src="<?=$g->catalog_big_url?>" alt="project" info="<?=$g->info->name?>" class="gallery-slider__image" />
				</li> <!-- /.gallery-slider__item-->
			<?endforeach;?>
		</ul> <!-- /.gallery-slider__list -->
	</div> <!-- /.gallery__slider gallery-slider -->
	
	<div class="gallery__text">
		<div class="gallery__menu gallery-menu">
			<div class="gallery-menu__menu">
				<ul class="gallery-menu__list">
					<?foreach($tree as $t):?>
						<li class="gallery-menu__item">
							<a href="<?=$t->full_url?>" class="gallery-menu__href"><?=$t->name?></a>
						</li>
					<?endforeach;?>
                </ul> <!-- /.gallery-menu__menu -->
			</div> <!-- /.gallery-menu__menu -->
			
			<a href="#" class="gallery-menu__title"><?=$gallery_title?></a> <!-- /.gallery__category -->
		</div> <!-- /.gallery__menu -->
		
		<div class="gallery__name">Квартира на Новочеркасском</div> <!-- /.gallery__name -->
	</div> <!-- /.gallery__text -->
	
	<div class="gallery__thumbs gallery-thumbs-slider">
	
		<ul class="gallery-thumbs-slider__list">
			<?$counter=1?>
			<?foreach($gallery as $g):?>
				<li class="gallery-thumbs-slider__item">
					<a href="#slide<?=$counter?>" class="gallery-thumbs-slider__href gallery__thumb">
						<img src="<?=$g->catalog_small_url?>" alt="thumb" class="gallery-thumbs-slider__image hover-image" />
					</a>
				</li> <!-- /.gallery-thumbs-slider__item -->
				<?$counter++?>
        	<?endforeach;?>		
		</ul> <!-- /.gallery-thumbs-slider__list -->
	</div> <!-- /.gallery__thumbs -->
</div> <!-- /.gallery -->
