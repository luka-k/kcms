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
				
				<?require 'include/breadcrumbs.php'?>
			
			<div class="catalog_book">
				<div class="book_title"><?=$product->name?></div>
				<div class="book_content">
					<div class="book_cover">
						<img src="<?=$product->images[0]->catalog_big_url?>" alt="" />
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
							<a href="" class="to_cart_button" onclick="fancy_to_cart('<?=$product->id?>', '<?=$product->name?>', 1); return false;">В корзину</a>
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

	<?require 'include/footer.php'?>
	
	<?require 'include/modal.php'?>

    </body>
</html>