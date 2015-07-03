<!DOCTYPE html>
<html>
	<?require_once 'include/head.php'?>	
	<body>
		<!-------------------header--------------------->
		<? require 'include/header.php'?>
		<!-----------------end_header-------------------->
		
		<div id="wrapper clearfix">
			<div class="section maxw clearfix">
				<div class="mainwrap">
					<main id="brightbild">
						<article>

							<div id="" class="main-content clearfix">
		
								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									<div class="bb_description">
										<div class="bb_main_block">
											<?foreach($brightbild as $bb):?>
												<div class="bb_block" id="bb-<?=$bb->id?>">
													<h3><?=$bb->name?></h3>
													<?=$bb->description?>
												</div>
											<?endforeach;?>
										</div>
									</div>
								</div>
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1>bрайтbилд</h1>
					<?require "include/bb_left_menu.php"?>
				</aside><!--end_leftcol-->
                   
				<!-----rightcol----->
                <aside id="s_right">
					<?require "include/news_collumn.php"?>
				</aside><!--end_rightcol-->
			</div>
		</div>
		
		<script>
			function active_bb(id){
				$('.bb_block').css('background-color', '#fff'); 
				$('.leftsubmenu').removeClass('selected');
				$('#lm_'+id).addClass('selected');
				$('#bb-'+id).css('background-color', '#c6cee8');
			}
		</script>
	</body>
</html>