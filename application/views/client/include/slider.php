<?if(!empty($slider)):?>
	<div class="home-slider outer-bottom-vs">
		<!-- ========================================== SECTION – HERO : START ========================================= -->
		<div id="hero">
			<div id="owl-main" class="owl-carousel owl-theme">
				<?foreach($slider as $slide):?>
					<div class="item">
						<div class="container">
							<div class="content">
								<div class="row">
									<div class="col-md-7 col-sm-12 col-xs-12">
										<div class="book-in-shelf">
											<div class="book-shelf">
												<div class="book-cover slider-book-cover bk-cover m-t-20">
													<img class="img-responsive" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $slide->img->slider_url?>"> <!--slider_url-->
													<div class="fade"></div>
												</div> <!-- /.book-cover -->                        
											</div><!-- /.book-shelf -->
										</div><!-- /.book-in-shelf -->
									</div><!-- /.col -->
									
									<div class="col-md-5 col-sm-12 col-xs-12">
										<div class="clearfix caption vertical-center text-left">
											<div class="slider-caption-heading">
												<h1 class="slider-title">
													<span class="fadeInDown-1 main"><?= $slide->autor?>:</span>
													<span class="fadeInDown-2 sub"><?= $slide->name?></span>
												</h1>
											</div><!-- /.slider-caption-heading -->
											<div class="clearfix slider-button hidden-xs fadeInDown-3">
												<a class="btn btn-primary btn-uppercase" role="button" href="<?= $slide->full_url?>">view more</a>
											</div> <!-- /.slider-price -->
										</div><!-- /.slider-caption -->
									</div><!-- /.col -->
								</div><!-- /.row -->
							</div><!-- /.content.caption -->
						</div><!-- /.container -->
					</div><!-- /.item -->
				<?endforeach;?>
			</div><!-- /# owl-main -->
		</div><!-- /#hero -->
		<!-- ========================================== SECTION – HERO : END ========================================= -->
	</div><!-- /.home-slider -->
<?endif;?>

<script src="<?= base_url()?>template/client/js/echo.min.js"></script>