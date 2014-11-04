<?require_once 'include/head.php'?>

<div id="parent" class="clearfix">
	<?require_once 'include/header.php'?>
	
	<div id="wrapper">
	    <?require_once 'include/left_col.php'?>
		
		<div id="main-content">
			<div class="title">Wishlist</div>
			
			<div id="content">
				<div id="checkout">
					<table cellspacing="0">
						<tr class="tbl-ttl">
							<td class="td-1">&nbsp;</td><td class="td-2">Name</td><td class="td-3">Art.</td><td class="td-4">Per Unit</td><td class="td-5">Qty</td><td class="td-6">&nbsp;</td>
						</tr>
						
						<?foreach($wishlist as $item):?>
							<tr class="tbl-item">
								<td class="td-1"><img src="<?=base_url()?>download/images/catalog_small/<?=$item->img->url?>" alt=""/></td>
								<td class="td-2"><?=$item->title?></td>
								<td class="td-3"><span class=""><?=$item->article?></span></td>
								<td class="td-4"><span class="unit-pr"><?=$item->price?></span>&euro;</td>
								<td class="td-5"><input type="text" size="1" name="qty" id="qty-<?=$item->id?>" placeholder = "1"/></td>
								<td class="td-6-wish">
									<div class="td-6-wish">
										<span class=""><a href="#" onclick="add_to_cart('<?=$item->id?>', $('#qty-<?=$item->id?>').val()); return false">add to cart</a></span>
										<span class="close" onclick="delete_from_wishlist('<?=$item->id?>')">&nbsp;</span>
									</div>
								</td>
							</tr>	
						<?endforeach;?>
					</table>
				</div>
			</div>
		</div>
		
		<?require_once 'include/right_col.php'?>
	</div>
	<?require_once 'include/footer.php'?>
</div>
</body>
</html>