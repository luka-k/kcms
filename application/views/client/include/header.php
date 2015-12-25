<header class="header">
	<nav class="navbar navbar-bookshop navbar-static-top" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-md-5 hidden-xs hidden-sm">
					<ul class="nav navbar-nav">
						<?foreach($top_left_menu as $tlm):?>
							<li><a href="<?=$tlm->full_url?>"><?=$tlm->name?></a></li>
						<?endforeach;?>
					</ul><!-- /.nav -->
				</div><!-- /.col -->
								
				<div class="col-md-3 col-xs-10 col-sm-10 navbar-left">
					<p class='text-center'><a href="#"><span class="icon glyphicon glyphicon-earphone"></span> +1-234-567-8910</a></p>
				</div><!-- /.col -->
								
				<div class="col-md-4 col-sm-2">
					<ul class="nav navbar-nav navbar-right">
						<?foreach($top_right_menu as $trm):?>
							<li class="hidden-xs hidden-sm"><a href="<?=$trm->full_url?>"><?=$trm->name?></a></li>
						<?endforeach;?>				
										
										<!---<li class="hidden-xs hidden-sm"><a href="single-book.html">Shopping Cart</a></li>
										<li class="hidden-xs hidden-sm"><a href="contact.html">My Account</a></li>
										<li class="icon icon-small hidden-xs"><a data-toggle="modal" data-target="#modal-login-big" href="#"><i class="icon fa fa-lock"></i></a></li>
										<li class="icon hidden-lg hidden-sm hidden-md"><a data-toggle="modal" data-target="#modal-login-small" href="#"><i class="icon fa fa-lock"></i></a></li>-->
					</ul><!-- /.nav -->
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container -->
	</nav><!-- /.navbar -->
					
	<div class="main-header">
		<div class="container">
			<div class="row">				
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
				
				<div class="col-xs-12  col-md-2 header-shippment hidden-sm m-t-10">
					<!-- ============================================== FREE DELIVERY ============================================== -->
					<div class="media free-delivery hidden-xs ">
						<!--<span class="media-left"><img src="<?= IMG_PATH?>delivery-icon.png" height="48" width="48" alt=""></span>-->
						<div class="media-body">
							<?if(empty($user)):?>
								<h5 class="media-heading" style="float:left; margin-right:15px;">
									<a data-toggle="modal" data-target="#modal-login-big" href="#">Вход</a>
								</h5>
								<h5 class="media-heading" style="float:left;">
									<a data-toggle="modal" data-target="#modal-registration-big" href="#">Регистрация</a>
								</h5>				
							<?else:?>
								<h5 class="media-heading" style="float:left; margin-right:15px;">
									<a href="<?=base_url()?>cabinet" class="header-login__register"><?=$user->name?></a>
								</h5>
								<h5 class="media-heading" style="float:left;">
									<a href="<?=base_url()?>account/do_exit" class="header-login__register" style="float:right;">Выход</a>
								</h5>
							<?endif;?>
						</div>
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
			<?foreach($main_menu as $mm):?>
				<li class="active"><a href="<?=$mm->full_url?>"><?=$mm->name?></a></li>
			<?endforeach;?>
        </ul><!-- /.nav -->
    </div><!-- /.collapse navbar-collapse -->   
</nav><!-- /.yamm -->

<?require "modal.php";?>
<!-- ============================================================= NAVBAR PRIMARY : END ============================================================= -->			</div><!-- /.nav-bg-class -->
		</div><!-- /.container -->
	
</div><!-- /.header-nav -->
<!-- ============================================== NAVBAR : END ============================================== -->
	</header>