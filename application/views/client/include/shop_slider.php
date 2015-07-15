<div id="shop-slideshow">
	<ul class="slideshow rounded">
		<?foreach($slider as $slide):?>
			<li class="tmpSlide">
				<img width="844" height="360" src="<?=$slide->img->shop_slider_url?>" class="attachment-full wp-post-image" alt="<?=$slide->name?>" />		  
			</li>
		<?endforeach;?>
	</ul>
</div>