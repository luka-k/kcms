<? foreach($products as $p):?>
	<div class="col-md-3 col-sm-6">
		<div class="book">
			<a href="<?= $p->full_url?>">
				<div class="<?if($p->cover == 'book'):?>book-cover<?elseif($p->cover == 'album'):?>album-cover<?else:?>cd-cover<?endif;?>">
					<?if($p->cover == 'book'):?>
						<img width="140" height="212" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $p->img->catalog_mid_url?>">
					<?elseif($p->cover == 'album'):?>
						<img width="160" height="106" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $p->img->catalog_mid_album_url?>">
					<?else:?>
						<img width="140" alt="" src="<?= IMG_PATH?>blank.gif" data-echo="<?= $p->img->catalog_mid_cd_url?>">
					<?endif;?>
					
					<?if(false):?>
						<div class="tag"><span>sale</span></div>
					<?endif;?>
				</div>
			</a>
			<div class="book-details clearfix">
				<div class="book-description">
					<h3 class="book-title"><a href="single-book.html"><?=  $p->name?></a></h3>
					<p class="book-subtitle">автор <a href="single-book.html"> <?=  $p->autor?></a></p>
				</div>
				<div class="text-center">
					<div class="actions">
						<span class="book-price price"><?= $p->price?> р.</span>
						<div class="cart-action">
							<a class="add-to-cart" title="Add to Cart" href="#" onclick="addToCart('<?= $p->id?>', 1); return false;">В корзину</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<? endforeach;?>

<script src="<?= base_url()?>template/client/js/echo.min.js"></script>

<script>
	$(document).ready(function () { 
        /*===================================================================================*/
        /*  LAZY LOAD IMAGES USING ECHO
        /*===================================================================================*/

        echo.init({
            offset: 100,
            throttle: 250,
            unload: false
        });});
</script>