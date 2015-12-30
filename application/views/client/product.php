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
            <div class="content wow fadeInUp">
	<div class="container">
		<div class="row">
			<? require 'include/breadcrumbs.php' ?>
							<div class="divider">
								<img class="img-responsive" src="<?= IMG_PATH?>all-categories/shadow.png" alt="">
							</div><!-- /.divider -->
		</div>
		<div class="row inner-top-xs single-book-block">
			<div class="col-md-9 col-md-push-3">
				<!-- .primary block -->
				<div class="single-book primary-block">
	<div class="row">
		<div class="col-md-5 col-sm-5">
			<div class="book-cover">
				<img width="268" height="408" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?=$product->images[0]->catalog_big_url?>">
			</div><!-- /.book-cover -->
			<div class="share-button">
				
				<!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_native_toolbox inner-top-vs"></div>
			</div>
			<div class="list-unstyled link-block inner-top-50">
				<!--<a href="#customer-reviews" class='customer-review'><i class="icon fa fa-comment"></i><span class="customer-review">Customer Reviews(7) &darr; </span></a>-->
			</div>
		</div>
		<div class="col-md-7 col-sm-7">
			<div class="featured-book-heading">
				<h1 class="title"><?=$product->name?></h1>
				<p class="singl-book-author">
					автор
					<a href="#"><?=$product->autor?></a>
				</p>
			</div>

			<div class="row">
				<div class="col-md-3">
					<p class="single-book-price"><?=$product->price?></p>
				</div>
				<div class="col-md-9">
					<div class="add-cart-button btn-group">
						<button class="btn btn-single btn-sm" onclick="addToCart('<?= $product->id?>', 1); return false;" type="button" data-toggle="dropdown">
							<img src="<?= IMG_PATH?>add-to-cart.png" alt="">
						</button>
						<button class="btn btn-single btn-uppercase" onclick="addToCart('<?= $product->id?>', 1); return false;" type="button">В корзину</button>
					</div>
				</div>
			</div>


			<div class="description"><?=$product->description?></div>
				</div>
			</div>
		</div>			    <!-- /.primary block -->

				<div class="divider inner-top-xs">
                    <img src="<?= IMG_PATH?>shadow.png" class="img-responsive" alt=""/>
				</div>

				 

				

			</div><!-- /.col -->
			<div class="col-md-3 col-md-pull-9">
				<?require "include/sidebar.php";?>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /.content -->
            <!-- ============================================== FOOTER ============================================== -->
				<?require "include/footer.php";?>
				<!-- ============================================== FOOTER : END ============================================== -->        
			</div><!-- /.st-pusher -->
			<!-- ============================================== TOGGLE RIGHT CONTENT ============================================== -->
			<?require "include/toggle_cart.php";?>
			<!-- ============================================== TOGGLE RIGHT CONTENT : END ============================================== -->
			
			<?require "include/modal.php";?>
		</div><!-- /#wrapper -->

		<?require "include/scripts.php";?>
</body>
</html>