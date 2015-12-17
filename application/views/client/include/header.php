<header class="header">
	<nav class="navbar navbar-bookshop navbar-static-top" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-md-5 hidden-xs hidden-sm">
					<ul class="nav navbar-nav">
						<li><a href="single-book.html">Online Store</a></li>
						<li><a href="about.html">About Us</a></li>
										<li><a href="about.html">Delivery</a></li>
										<li><a href="contact.html">FAQs</a></li>
										<li><a href="contact.html">Contacts</a></li>
					</ul><!-- /.nav -->
				</div><!-- /.col -->
								
				<div class="col-md-3 col-xs-10 col-sm-10 navbar-left">
					<p class='text-center'><a href="#"><span class="icon glyphicon glyphicon-earphone"></span> +1-234-567-8910</a></p>
				</div><!-- /.col -->
								
				<div class="col-md-4 col-sm-2">
					<ul class="nav navbar-nav navbar-right">
						<li class="hidden-xs hidden-sm"><a href="contact.html">Wishlist</a></li>
										<li class="hidden-xs hidden-sm"><a href="single-book.html">Shopping Cart</a></li>
										<li class="hidden-xs hidden-sm"><a href="contact.html">My Account</a></li>
										<li class="icon icon-small hidden-xs"><a data-toggle="modal" data-target="#modal-login-big" href="#"><i class="icon fa fa-lock"></i></a></li>
										<li class="icon hidden-lg hidden-sm hidden-md"><a data-toggle="modal" data-target="#modal-login-small" href="#"><i class="icon fa fa-lock"></i></a></li>
					</ul><!-- /.nav -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</nav><!-- /.navbar -->
					
	<div class="main-header">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-4 col-md-4 top-search-holder m-t-10">
					<!-- ============================================== SEARCH BAR ============================================== -->
					<form class="search-form" role="search">
						<div class="form-group">
							<label class="sr-only" for="page-search">Type your search here</label>
							<input id="page-search" class="search-input form-control" type="search" placeholder="Поиск по товарам">
						</div>
						<button class="page-search-button">
							<span class="fa fa-search"><span class="sr-only">Поиск</span></span>
						</button>
					</form>
					<!-- ============================================== SEARCH BAR : END ============================================== -->					
				</div><!-- /.top-search-holder -->
				
				<div class="col-xs-12 col-sm-4 col-md-4 text-center logo-holder">
					<!-- ============================================== LOGO ============================================== -->
					<a href="<?= base_url()?>">
						<img src="<?= IMG_PATH?>logo.png" class="logo" style="margin-top:0px;"/>
						<!---<h1 class="logo">BookHouse</h1>
						<div class="logo-subtitle">
							<span>World of books</span>
						</div><!-- /.logo-subtitle -->
					</a>
					<!-- ============================================== LOGO : END ============================================== -->					
				</div><!-- /.logo-holder -->
				
				<div class="col-xs-12  col-md-2 header-shippment hidden-sm m-t-10">
					<!-- ============================================== FREE DELIVERY ============================================== -->
					<div class="media free-delivery hidden-xs ">
						<span class="media-left"><img src="assets/images/delivery-icon.png" height="48" width="48" alt=""></span>
						<div class="media-body"><h5 class="media-heading">Free delivery</h5></div>
					</div>
					<!-- ============================================== FREE DELIVERY : END ============================================== -->					
				</div><!-- /.header-shippment -->
				
				<div class="col-xs-12 col-sm-4 col-md-2 animate-dropdown1 top-cart-row m-t-10">
					<!-- ============================================== SHOPPING CART DROPDOWN ============================================== -->                              
					<ul class="clearfix shopping-cart-block list-unstyled">
						<li class="dropdown">
							<a class="menu-toggle-right clearfix" href=".menu-toggle-right">
								<span class="pull-right cart-right-block">
									<img src="<?= IMG_PATH?>cart-icon.png" alt="" width="46" height="39" />
								</span><!-- /.cart-right-block -->
								<span class="pull-right cart-left-block">
									<span class="cart-block-heading "><span class="total_price" style="display:inline-block;"><?=$total_price?></span> р.</span>
									<span class="hidden-xs total_qty"><?=$total_qty?></span>
								</span><!-- /.cart-left-block -->
							</a>
						</li>
					</ul> <!-- /.list-unstyled --> 
					<!-- ============================================== SHOPPING CART DROPDOWN : END ============================================== -->					
				</div><!-- /.top-cart-row -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</div><!-- /.main-header -->
	
	<!-- ============================================== NAVBAR ============================================== -->
	<div class="header-nav animate-dropdown">
		<div class="container">			
			<div class="nav-bg-class">
				<!-- ============================================================= NAVBAR PRIMARY ============================================================= -->
				<nav class="yamm navbar navbar-primary animate-dropdown" role="navigation">
					<div class="navbar-header">
						<button id="btn-navbar-primary-collapse" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-primary-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div><!-- /.navbar-header -->
    <div class="collapse navbar-collapse" id="navbar-primary-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="home.html">Books</a></li>
            <li class="dropdown yamm-fw"><a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Textbooks</a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="yamm-content">
                            <div class="row">
                                <div class="col-md-2 col-sm-6">  
                                    <div class="section">
                                        <h5 class="title">History</h5>
                                        <ul class="links list-unstyled">
                                            <li><a href="books.html">Indian Independence</a></li>
                                            <li><a href="books.html">French Revolution</a></li>
                                            <li><a href="books.html">Industrial Revolution</a></li>
                                            <li><a href="books.html">Vietnam War</a></li>
                                            <li><a href="books.html">World War I &amp; II</a></li>
                                            <li><a href="books.html">Operation Desert Storm</a></li>
                                        </ul>
                                    </div><!-- /.section -->
                                </div><!-- /.col -->

                                <div class="col-md-2 col-sm-6">
                                    <div class="section">
                                        <h5 class="title">Science</h5>
                                        <ul class="links list-unstyled">
                                            <li><a href="books.html">Applied Science</a></li>
                                            <li><a href="books.html">Astronomy</a></li>
                                            <li><a href="books.html">Biotechnology</a></li>
                                            <li><a href="books.html">Chemistry</a></li>
                                            <li><a href="books.html">Cognitive Science</a></li>
                                            <li><a href="books.html">Cosmology</a></li>
                                        </ul>
                                    </div><!-- /.section -->
                                </div><!-- /.col -->

                                <div class="col-md-2 col-sm-6">  
                                    <div class="section">
                                        <h5 class="title">History</h5>
                                        <ul class="links list-unstyled">
                                            <li><a href="books.html">Indian Independence</a></li>
                                            <li><a href="books.html">French Revolution</a></li>
                                            <li><a href="books.html">Industrial Revolution</a></li>
                                            <li><a href="books.html">Vietnam War</a></li>
                                            <li><a href="books.html">World War I &amp; II</a></li>
                                            <li><a href="books.html">Operation Desert Storm</a></li>
                                        </ul>
                                    </div><!-- /.section -->
                                </div><!-- /.col -->

                                <div class="col-md-2 col-sm-6">
                                    <div class="section">
                                        <h5 class="title">Science</h5>
                                        <ul class="links list-unstyled">
                                            <li><a href="books.html">Applied Science</a></li>
                                            <li><a href="books.html">Astronomy</a></li>
                                            <li><a href="books.html">Biotechnology</a></li>
                                            <li><a href="books.html">Chemistry</a></li>
                                            <li><a href="books.html">Cognitive Science</a></li>
                                            <li><a href="books.html">Cosmology</a></li>
                                        </ul>
                                    </div><!-- /.section -->
                                </div><!-- /.col -->

                                <div class="col-md-2 col-sm-6">
                                    <div class="section">
                                        <h5 class="title">History</h5>
                                        <ul class="links list-unstyled">
                                            <li><a href="books.html">Indian Independence</a></li>
                                            <li><a href="books.html">French Revolution</a></li>
                                            <li><a href="books.html">Industrial Revolution</a></li>
                                            <li><a href="books.html">Vietnam War</a></li>
                                            <li><a href="books.html">World War I &amp; II</a></li>
                                            <li><a href="books.html">Operation Desert Storm</a></li>
                                        </ul>
                                    </div><!-- /.section -->
                                </div><!-- /.col -->

                                <div class="col-md-2 col-sm-6">
                                    <div class="section">
                                        <h5 class="title">Science</h5>
                                        <ul class="links list-unstyled">
                                            <li><a href="books.html">Applied Science</a></li>
                                            <li><a href="books.html">Astronomy</a></li>
                                            <li><a href="books.html">Biotechnology</a></li>
                                            <li><a href="books.html">Chemistry</a></li>
                                            <li><a href="books.html">Cognitive Science</a></li>
                                            <li><a href="books.html">Cosmology</a></li>
                                        </ul>
                                    </div><!-- /.section -->
                                </div><!-- /.col -->
                            </div>
                        </div>

                    </li>
                </ul>
            </li>
             <li><a href="books.html">Nook Books</a></li>
             <li class="hidden-sm"><a href="books.html">Audiobooks</a></li>
             <li class="hidden-sm hidden-md"><a href="books.html">Magazines</a></li>
             <li class="hidden-sm hidden-md"><a href="books.html">Movies</a></li>
             <li><a href="books.html">Music</a></li>
             <li class="dropdown navbar-right"><a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Pages</a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="yamm-content">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <ul class="links">
                                        <li><a href="home.html">Home</a></li>
                                        <li><a href="home-2.html">Home II</a></li>
                                        <li><a href="books.html">Books</a></li>
                                        <li><a href="books-2.html">Books II</a></li>
                                        <li><a href="single-book.html">Book</a></li>
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="blog-post.html">Blog Post</a></li>
                                    </ul>
                                </div>
                            <div class="col-md-6 col-sm-6">
                                <ul class="links">
                                    <li><a href="about.html">About</a></li>
                                    <li><a href="contact.html">Contact</a></li>
                                    <li><a href="contact-2.html">Contact II</a></li>
                                    <li><a href="categories.html">Categories</a></li>
                                    <li><a href="magazine.html">Magazine</a></li>
                                    <li><a href="all-brands.html">All Brands</a></li>
                                    <li><a href="error.html">Error</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                    
                    
                </ul>
             </li>
        </ul><!-- /.nav -->
    </div><!-- /.collapse navbar-collapse -->   
</nav><!-- /.yamm -->
<!-- ============================================================= NAVBAR PRIMARY : END ============================================================= -->			</div><!-- /.nav-bg-class -->
		</div><!-- /.container -->
	
</div><!-- /.header-nav -->
<!-- ============================================== NAVBAR : END ============================================== -->
	</header>