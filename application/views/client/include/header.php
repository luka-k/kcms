<header class="header" id="header">
	<div class="header__wrap wrap">
		<div class="header__logo">
			<a href="/" class="logo">БрайтБерри</a>
		</div> <!-- /.header__logo -->
		
		<div class="header__content">
			<div class="header__search search">
				
				<form action="<?=base_url()?>search" id="searchform" class="" method="get">
					<div class="search__fields">
						<div class="search__line">
							<div class="form__input-border">
								<input type="text" id="search_input" class="form__input search__input search" name="name" placeholder="Поиск по сайту" <?if(isset($search)):?>value="<?=$search?>"<?endif;?> onkeypress="autocomp()"/>
							</div> <!-- /.form__input-border -->
						</div> <!-- /.search__line -->
						<div class="search__button">
							<button type="submit" class="button button--search">Отправить</button>
						</div> <!-- /.search__button -->
					</div> <!-- /.search__fields -->
				</form> <!-- /.form -->
			</div> <!-- /.header__search search-->
			
			<div class="header__description">Интерьерные решения из массива ценных пород дерева</div> <!-- /.header__description -->
			
			<? require "top-menu.php" ?>
		</div> <!-- /.header__content -->
	</div> <!-- /.header__wrap wrap -->
</header> <!-- /.header -->	