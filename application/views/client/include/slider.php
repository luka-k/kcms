<div id='tmpSlideshow' class="rounded">
  <?php
	/*$recent = new WP_Query("cat=64&showposts=20&orderby=name&order=ASC");
	$counter = 0;
	foreach ($recent->posts as $p)
	{
		$counter++;
		*/?>
		<div id="tmpSlide-<?/*= $counter*/?>" class="tmpSlide">
		  <?/*= get_the_post_thumbnail($p->ID, 'full');*/ ?>
		  <div class="tmpSlideCopy">
			<?/*= $p->post_content */?>
		  </div>
		</div>
		<?php/*
	}*/
	?>
    <div id='tmpSlideshowControls'>
      <div class='tmpSlideshowControl' id='tmpSlideshowControl-1'></div>
      <div class='tmpSlideshowControl' id='tmpSlideshowControl-2'></div>
      <div class='tmpSlideshowControl' id='tmpSlideshowControl-3'></div>
      <div class='tmpSlideshowControl' id='tmpSlideshowControl-4'></div>
	</div>    
  </div> 