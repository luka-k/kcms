<!DOCTYPE html>
<html class="no-js">

<?require 'include/head.php'?>

<body>

	<?require 'include/top-menu.php'?>
	<?require 'include/header.php'?>
        
	<div class="main-catalog" id="main-catalog">
		<div class="main-catalog__wrap wrap">
			
			<?require_once 'include/leftside.php'?>	
			
			<div class="catalog">				
				<div class="shop-catalog-nav-search">
					<form action="<?=base_url()?>search" id="searchform" class="form" method="get">
						<input type="text" id="search_input" class="form__input shop-search__input search" name="name" placeholder="Поиск по сайту"/>
					</form>
					<a href="" class="shop-search__button">&nbsp;</a>
				</div> <!-- /.main-catalog-nav__columns -->
				
				<?require 'include/shop_slider.php'?>
				<?require 'include/breadcrumbs.php'?>
			
			<div class="catalog_book">
				<div class="book_title"><?=$product->name?></div>
				<div class="book_content">
					<div class="book_cover">
						<img src="images/catalog/001.jpg" alt="" />
					</div>
					<div class="book_info">
						<div class="book_autor">Автор: <span class="autor_name"><?=$product->autor?></span></div>
						<div class="in_stock">в наличии</div>
						<div style="margin-top:20px">
							<?if(!empty($product->year)):?>
								<div class="info_item">
									<div class="info_title">Год:</div>
									<div class="info_value"><?=$product->year?> г.</div>
								</div>
							<?endif;?>
							<?if(!empty($product->cover)):?>
								<div class="info_item">
									<div class="info_title">Обложка:</div>
									<div class="info_value"><?=$product->cover?></div>
								</div>
							<?endif;?>
							<?if(!empty($product->amount)):?>
								<div class="info_item">
									<div class="info_title">Объем:</div>
									<div class="info_value"><?=$product->amount?> страниц</div>
								</div>
							<?endif;?>
						</div>
					</div>
					<div class="buy_info">
						<div class="price"><?=$product->price?> руб.</div>
						<div class="to_cart">
							<a href="" class="to_cart_button">В корзину</a>
						</div>
					</div>
				</div>
				<div class="book_description"><?=$product->description?></div>
			</div>			
				
			<?if(!empty($product->recommended_products)):?>
				<div class="anchor_books clearfix">
					<h2 class="catalog__subtitle">С этим товаром смотрят</h2>
				
					<div class="anchor_list">
						<?foreach($product->recommended_products as $rp):?>
							<div class="anchor-item">
								<div class="anchor-item-top">
									<a href="#" class="anchor-item__autor"><?=$rp->autor?></a>
									<a href="#" class="anchor-item__name"><?=$rp->name?></a>
								</div>
								<div class="anchor-item__image-box">
									<a href="<?=$rp->full_url?>">
										<img src="<?=$rp->img->catalog_small_url?>" class="anchor-item__image" alt="<?=$rp->name?>"/>
									</a>
								</div> <!-- /.catalog-item__image-box -->
								<div class="anchor-item__price"><?=$rp->price?> р.</div>
							</div>
						<?endforeach;?>	
					</div> <!-- /.catalog__list -->
				</div> <!-- /.catalog -->
			<?endif;?>
		</div> <!-- /.main-catalog__wrap wrap -->
	</div> <!-- /.main-catalog -->

	<? /*require 'include/footer.php'*/?>
	<? /*require 'include/footer.php'*/?>
	<div class="footer-top">&nbsp;</div>
	<div class="footer-middle">
		<div class="footer__wrap wrap">
			<div class="footer__contacts">
				<div class="contacts-info">
					<div class="contacts-info__item _1">
						<div class="contacts-info__copy">&copy; 2015 Книжный дом</div> <!-- /.contacts-info__copy -->
					</div> <!-- /.contacts-info__item -->
			
					<div class="contacts-info__item _2">
						<div class="footer-mail">info@bookhouse.ru</div>
					</div>
			
					<div class="contacts-info__item _3">
						<div class="footer-address">Санкт-Петербург,</br> ул. Малая Конющенная, 5</div>
					</div>
				
					<div class="contacts-info__item _4">
						<div class="footer-phone">/812/380-73-00</br>/812/380-73-22</div>
					</div>
				
				</div> <!-- /.contacts-info -->
			</div>
		</div> <!-- /.footer__contacts -->
	</div>
	
	<footer class="footer" id="footer">
		<div class="footer__wrap wrap">
			<div class="contacts-info">
				<div class="contacts-info__item _1">
					<div class="footer-title">Магазин</br> на малой конющенной</div> 
					будни: 9.30 - 20.00</br>
					суббота, воскресенье: 11.00 - 18.00
				</div> <!-- /.contacts-info__item -->
				
				<div class="contacts-info__item _2">
					<div class="footer-title">Издательский отдел</div>
					будни: 10.00 - 18.00</br>
				</div>
				
				<div class="contacts-info__item _3">
					<div class="footer-title">Экзаменационный центр</div>
					ул. Большая Конюшенная, 8</br>
					Тел. 244-54-88</br>
					будни: 11.00 - 19.00</br>
					суббота, воскресенье: выходной
				</div>
				
				<div class="contacts-info__item _4">
					<div class="footer-title">Букхауз</div>
					Проспект Испытателей, 7А</br>
					Тел. 995-73-74</br>
					будни: 11.00 - 20.00</br>
					Обед: 14.00 - 15.00
				</div>
				
			</div> <!-- /.contacts-info -->	
		</div> <!-- /.footer__wrap wrap -->
	</footer> <!-- /.header -->
	
	<?/* require 'include/modal.php'*/?>

    </body>
	<script>
		$( ".datepicker" ).datepicker();
	</script>
</html>