<div id='tmpSlideshow' class="rounded">

	<?$counter = 1?>
	<?foreach($slider as $slide):?>
		<div id="tmpSlide-<?=$counter?>" class="tmpSlide">
			<img width="640" height="350" src="<?=$slide->img->url?>" class="attachment-full wp-post-image" alt="019" />		  
			
			<div class="tmpSlideCopy">
				<?=$slide->description?>
			</div>
		</div>
		<?$counter++?>
	<?endforeach;?>
	
	<div id='tmpSlideshowControls'>
		<?for($i = 1; $i < $counter; $i++):?>
			<div class='tmpSlideshowControl' id='tmpSlideshowControl-<?=$i?>'></div>
		<?endfor;?>
	</div>    
</div> 
