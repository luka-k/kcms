<?require_once 'include/head.php'?>
	
	<div id="parent" class="clearfix">
		<?require_once 'include/header.php'?>
		
		<div id="wrapper" class="clearfix">
			<?require_once 'include/left_col.php'?>
			
			<div id="main-content">
				<div class="title"><?=$main->title?></div>
				<div id="content"><?=$main->description?></div>
				
				<div class="title">CATOLOGUE</div>
				<div id="catologue">
					<?foreach($content as $item):?>
						<section>
							<a href="<?=$item->full_url?>"><img src="<?=$item->img->url?>" alt=""/></a>
							<div class="price">9&euro;</div>
							<div class="fig_name"><?=$item->title?></div><br/><br/>
							<div class="add_to">	
								add to: <a href="#" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;" onclick="add_to_cart('<?=$item->id?>'); return false">cart</a><a href="">wish list</a>
							</div>
						</section>						
					<?endforeach;?>
				</div>
			</div>
			
			<?require_once 'include/right_col.php'?>
			
		</div>
		<?require_once 'include/footer.php'?>
	</div>	
	</body>
</html>