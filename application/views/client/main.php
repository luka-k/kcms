<?require_once 'include/head.php'?>
	
	<div id="parent" class="clearfix">
		<?require_once 'include/header.php'?>
		
		<div id="wrapper" class="clearfix">
			<?require_once 'include/left_col.php'?>
			
			<div id="main-content">
				<div class="title">ANNOUCEMENT</div>
				<div id="content">
					Blah Blah Blah Blah Blah Blah Blah Blah Blah
					Blah Blah Blah Blah Blah Blah Blah Blah Blah
					Blah Blah Blah Blah Blah Blah Blah Blah Blah
					Blah Blah Blah Blah Blah Blah Blah Blah Blah
					Blah Blah Blah Blah Blah Blah Blah Blah Blah
					Blah Blah Blah Blah Blah Blah Blah Blah Blah
					Blah Blah Blah Blah Blah Blah Blah Blah Blah
				</div>
				
				<div class="title">CATOLOGUE</div>
				<div id="catologue">
					<section>
						<a href=""><img src="<?php echo base_url()?>template/client/images/ronin/ronin1.jpg" alt=""/></a>
						<div class="price">9 &euro;</div>
						<div class="fig_name">NAME</div><br/><br/>
						<div class="add_to">
							add to: <a href="" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;">cart</a><a href="">wish list</a>
						</div>
					</section>
					
					<section>
						<a href=""><img src="<?php echo base_url()?>template/client/images/ronin/ronin1.jpg" alt=""/></a>
						<div class="price">9 &euro;</div>
						<div class="fig_name">NAME</div><br/><br/>
						<div class="add_to">
							add to: <a href="" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;">cart</a><a href="">wish list</a>
						</div>
					</section>
				
					<section>
						<a href=""><img src="<?php echo base_url()?>template/client/images/ronin/ronin1.jpg" alt=""/></a>
						<div class="price">9 &euro;</div>
						<div class="fig_name">NAME</div><br/><br/>
						<div class="add_to">
							add to: <a href="" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;">cart</a><a href="">wish list</a>
						</div>
					</section>
					
					<section>
						<a href=""><img src="<?php echo base_url()?>template/client/images/ronin/ronin1.jpg" alt=""/></a>
						<div class="price">9 &euro;</div>
						<div class="fig_name">NAME</div><br/><br/>
						<div class="add_to">
							add to: <a href="" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;">cart</a><a href="">wish list</a>
						</div>
					</section>
					
					<section>
						<a href=""><img src="<?php echo base_url()?>template/client/images/ronin/ronin1.jpg" alt=""/></a>
						<div class="price">9 &euro;</div>
						<div class="fig_name">NAME</div><br/><br/>
						<div class="add_to">
							add to: <a href="" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;">cart</a><a href="">wish list</a>
						</div>
					</section>
					
					<section>
						<a href=""><img src="<?php echo base_url()?>template/client/images/ronin/ronin1.jpg" alt=""/></a>
						<div class="price">9 &euro;</div>
						<div class="fig_name">NAME</div><br/><br/>
						<div class="add_to">
							add to: <a href="" style="margin-right:5px; padding-right:5px; border-right:1px solid #2e2d29;">cart</a><a href="">wish list</a>
						</div>
					</section>
				</div>
			</div>
			
			<?require_once 'include/right_col.php'?>
			
		</div>
		<?require_once 'include/footer.php'?>
	</div>	

<script>
$('ul .up').click(function() {
$(this).next().slideToggle().toggleClass('noactive');
$(this).toggleClass('up');
$(this).toggleClass('down');
});

$('ul .down').click(function() {
$(this).next().slideToggle().toggleClass('noactive');
$(this).toggleClass('down');
$(this).toggleClass('up');
});
</script>

  </body>
</html>