<header class="header <?if(isset($shop)):?>shop<?endif;?> clearfix" id="header">
	<div class="header__wrap wrap">
		<div class="header__logo">
			<a href="/" class="logo">&nbsp;</a>
		</div> <!-- /.header__logo -->
		
		<div class="header__phone">
			<div class="header-phone">
				<div class="header-phone__number"><?=$settings->phones[0]?></div> <!-- /.header-phone__number -->
			</div> <!-- /.header-phone -->
		</div> <!-- /.header__phone -->
		
		<div class="header__callback">
			<div class="header-callback">
				<div class="header-phone__callback">
					<a href="#callback" class="header-phone__callback-link lightbox">обратный звонок</a>
				</div> <!-- /.header-phone__callback -->
			</div> <!-- /.header-login -->
		</div> <!-- /.header__login -->
		
		<div class="header__social">
			<a href="" class="twiter"></a>
			<a href="" class="facebook" ></a>
			<a href="" class="vk"></a>
		</div> <!-- /.header__cart -->
	</div> <!-- /.header__wrap wrap -->
</header> <!-- /.header -->