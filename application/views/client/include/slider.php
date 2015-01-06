<div class="promo">
	<ul class="promo__slider">
		<?foreach($slider as $slide):?>
			<li class="promo__slide">
				<div class="promo__image-box">
					<img src="<?=$slide->img->slider_url?>" alt="promo" class="promo__image" />
				</div> <!-- /.promo__image-box -->
			
				<div class="promo__wrap wrap">
					<a href="#" class="promo__title">
						<?=$slide->name?>
					</a> <!-- /.promo__title -->
				
					<a href="#" class="promo__desc">
						<?=$slide->description?>
					</a>
				</div> <!-- /.promo__wrap wrap -->
			</li> <!-- /.promo__slide -->
		<?endforeach;?>
	</ul> <!-- /.promo__slider -->
</div> <!-- /.promo -->