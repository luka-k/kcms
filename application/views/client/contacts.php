<!DOCTYPE html>
<html>
	<?require_once 'catalog/include/head.php'?>	
	<body>
		<!-------------------header--------------------->
		<? require 'catalog/include/header.php'?>
		<!-----------------end_header-------------------->
		
		<div id="wrapper clearfix">
			<div class="section maxw clearfix">
				<div class="mainwrap">
					<main class="contacts">
						<article>
							<div id="" class="main-content clearfix">
		
								<div id="scroll-content" class="contacts clearfix" style="overflow-y:scroll;">
									<?foreach($contacts as $c):?>
										<div id="contact-<?=$c->id?>" class="contact_item clearfix">
											<div class="contact_description">
												<h3><?=$c->name?>:</h3>
												<?=$c->description?>
											</div>
											<div class="map">
												<a href="<?=$c->img->full_url?>" class="fancybox">
													<img src="<?=$c->img->small_map_url?>" alt="<?=$c->name?>"/>
												</a>
											</div>
											<div class="ya_map">
												<a href="#ymap-<?=$c->id?>" class="fancybox">
													<script type="text/javascript" 
															charset="utf-8" 
															src="<?=$c->ya_map?>&width=300&height=150">
													</script>
													Посмотреть карту проезда
												</a>
												<div id="ymap-<?=$c->id?>" style="display: none;">
													<script type="text/javascript" 
															charset="utf-8" 
															src="<?=$c->ya_map?>&width=700&height=700">
													</script>
												</div>
											</div>
										</div>
									<?endforeach;?>
								</div>
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1>Контакты</h1>
					<?require "include/left_menu.php"?>
				</aside><!--end_leftcol-->
                   
			</div>
		</div>
		<?require "catalog/include/contacts_script.php"?>
	</body>
</html>