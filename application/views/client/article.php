<!DOCTYPE html>
<html lang="en">
	<? require 'include/head.php' ?>
	<body>
		<div id="wrapper" >
			<div id="page-content-wrapper" class="st-pusher">
				<div class="st-pusher-after"></div>
				<!-- ============================================== HEADER ============================================== -->
	
				<? require 'include/header.php' ?>

				<!-- ============================================== HEADER : END ============================================== -->           
					
				<div class="content">
					<div class="breadcrumb-inner">
						<div class="container">
							<div class="row">
								<? require 'include/breadcrumbs.php' ?>				
							</div><!-- /.row -->
							<div class="divider">
								<img class="img-responsive" src="<?= IMG_PATH?>blog/shadow.png" alt="">
							</div><!-- /.divider -->
						</div><!-- /.container -->
					</div><!-- /.breadcrumb-inner -->


					<div class='container wow fadeInUp'>
						<div class="row inner-top-xs">
							<div class='col-md-9 post'>
								<div class="post-entry">
									<div class="row">
										<div class="col-md-10 center-block">
											<div class="post-heading">
												<h1 class="post-title"><?= $content->name?></h1>
												<ul class="clearfix meta">
													<!--<li class="author"><a href="#">Hezy Theme</a></li>-->
													<li class="date"><?= $content->date?></li>
													<!--<li class="comment">42 comments</li>-->
												</ul><!-- /.meta -->
											</div><!-- /.post-heading -->
										</div><!-- /.col -->
									</div><!-- /.row -->

									<!--<div class="post-image inner-top-xs">
										<img class="img-responsive" src="assets/images/blank.gif" data-echo="assets/images/blog/post1.jpg" alt="">
									</div><!-- /.post-image -->
									<div class="row">
										<div class='col-md-10 center-block'>
											<div class="post-content">
												<!-- .blog post summary -->
												<!---<p class="meta-info m-t-20">Keith Haring,NYC,5/82</p>--->
												<!--<h2 class="post-content-heading">Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus.</h2>-->

												<?= $content->description?>
												<!-- /.blog post summary -->

												<!-- /.blog post comment -->

											</div><!-- /.post-content -->

										</div><!-- /.col -->
									</div><!-- /.row -->
								</div><!-- /.post-entry -->
							</div><!-- /.col -->
							<div class='col-md-3'>
								<!-- .blog sidebar -->
								<!-- ============================================== BLOG SIDEBAR ============================================== -->
								
								<?require "include/blog_sidebar.php";?>
								
								<!-- ============================================== BLOG SIDEBAR : END ============================================== -->	
								<!-- /.blog sidebar -->
							</div>
							<!---<div class="col-md-12 inner-top-sm">
				<a class="shipping-order-button big-button" href="#">
					<div class="text-center">
						<h3 class="big-text">free shipping on all orders over $75</h3>
						<p><span class="astk">*</span>Free over $150 for international orders</p> 
					</div>
				</a>
							</div>-->
						</div><!-- /.container -->
					</div><!-- /.row -->
				</div><!-- /.content -->            
				
				<!-- ============================================== FOOTER ============================================== -->
				
				<?require "include/footer.php";?>
				
				<!-- ============================================== FOOTER : END ============================================== -->        
			</div><!-- /.st-pusher -->
            
			<!-- ============================================== TOGGLE RIGHT CONTENT ============================================== -->
			
			<?require "include/toggle_cart.php";?>

			<!-- ============================================== TOGGLE RIGHT CONTENT : END ============================================== -->

		</div><!-- /#wrapper -->
		
		<?require "include/scripts.php";?>
	</body>
</html>