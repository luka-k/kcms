<div class="main-catalog-nav clearfix" id="main-catalog-nav">
	<div class="main-catalog-nav__wrap wrap">
		<div class="main-catalog-nav-search">
			<form action="<?=base_url()?>search" id="searchform" class="form" method="get">
				<input type="text" id="search_input" class="form__input menu-search__input search" name="name" placeholder="Поиск по сайту" value="<?if(isset($search)):?><?=$search?><?endif;?>" onkeypress="autocomp()"/>
				<a href="" class="search__button">&nbsp;</a>
			</form>
		</div> <!-- /.main-catalog-nav__columns -->
				
		<div class="main-catalog-nav-button">
			<a href="<?=base_url()?>catalog" class="catalog-button">ИНтернет магазин</a>
		</div> 
	</div> <!-- /.main-catalog-nav__wrap wrap -->
</div> <!-- /.main-catalog-nav -->