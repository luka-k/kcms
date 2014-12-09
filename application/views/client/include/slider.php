<!-- Slideshow -->
<div id="slideshow">
<ul class="slideshow rounded">
	<?foreach($slider as $slide):?>
		<li class="tmpSlide">
				<img width="640" height="350" src="<?=$slide->img->url?>" class="attachment-full wp-post-image" alt="019" />		  
			
				<div class="tmpSlideCopy">
					<?=$slide->description?>
				</div>
		</li>
	<?endforeach;?>
	
</ul>
</div>