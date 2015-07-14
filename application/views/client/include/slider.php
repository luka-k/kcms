<div id="slideshow">
	<ul class="slideshow">
		<?foreach($slider as $slide):?>
			<li class="tmpSlide">
				<img width="717" height="360" src="<?=$slide->img->main_slider_url?>" class="attachment-full wp-post-image" alt="<?=$slide->name?>" />		  
			</li>
		<?endforeach;?>
	</ul>
</div>