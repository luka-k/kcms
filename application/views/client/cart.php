<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
	<? require 'include/head.php' ?>	
	<script>	
	function validation (element, errorClass) {
   var input = element.find('input[type="text"]'),
       spaces = new RegExp(/^(\s|\u00A0)+|(\s|\u00A0)+$/g),
       isNecessatily,
       isError = false;
   input.on('focus', function () {
       var el = $(this);
     
       if (el.hasClass(errorClass)) el.removeClass(errorClass);
   });
        input.each(function () {
            var el = $(this);
            if (el.attr('data-necessarily') == 'true' && el.val().replace(spaces, '') == '') {
                el.addClass(errorClass);
                isError = true;
            }
			if (el.attr('data-id') == 'name' && el.val() == null) {
                el.addClass(errorClass);
                isError = true;
            }
            if (el.attr('data-id') == 'email' && el.val().match('@') == null) {
                el.addClass(errorClass);
                isError = true;
            }
            if (el.attr('data-id') == 'phone' && el.val() == null) {
                el.addClass(errorClass);
                isError = true;
            }
            if (el.attr('data-id') == 'address' && el.val() == null) {
                el.addClass(errorClass);
                isError = true;
            }
        });
   return isError;
}
	
	
	function sub_form(){
		var errorClass = 'frame-input_error';

			if (validation($("#order"), errorClass)) return false;
			$("#order").submit();
		}
</script>
	<body>
		<div class="wrap">
			<? require 'include/header.php'?>
			
			<div class="main">
				<div class="middle">
					<div class="container">
						<div class="content">
							<? require 'include/breadcrumbs.php' ?>
							<div class="middle2">
								<div class="container2">
									<div id="shop-item" class="cart-content">
										<div class="good-page" style="height: 100px; width: 100%; overflow-y: scroll;overflow-x:hidden;" id="good_page_scroll">
											
										<?if($cart <> NULL):?>	
											<table>
												<thead>
													<th>№</th>
													<th>Наименование</th>
													<th>Цена</th>
													<th>Количество</th>
													<th>Сумма</th>
													<th>Удалить</th>
												</thead>
												<tbody>
													<?$counter = 1?>
													<?foreach($cart as $item_id => $item):?>
														<tr id="<?=$item_id?>">
															<td><?=$counter?></td>
															<td><?=$item['name']?></td>
															<td><?=$item['price']?></td>
															<td><input type="text" name="qty_<?=$item_id?>" id="qty_<?=$item_id?>" value="<?=$item['qty']?>" onchange="update_cart('<?=$item_id?>', this.value);"/></td>
															<td><span id="item_total_<?=$item_id?>"><?=$item['item_total']?></span></td>
															<td><a href="#" onclick="delete_item('<?=$item_id?>');">X</a></td>
														<tr>
														<?$counter++?>
													<?endforeach;?>
												</tbody>
												<tfoot>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
													<th><span id="total_qty"><?=$total_qty?></span></th>
													<th><span id="total_price"><?=$total_price?></span></th>
													<th>&nbsp;</th>
													</tfoot>
												</table>
												
												<div >
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="order" class="js-form	" action="<?=base_url()?>order/edit_order/"/>
							<div class="order clearfix">
								<h5>Быстрый заказ</h5>
								<div style="position:relative; float:left; width:45%">
									<input type="text" name="name" placeholder="Имя" data-id="name" data-necessarily="true"/><br/>
									<input type="text" name="phone" placeholder="Телефон" data-id="phone" data-necessarily="true"/><br/>
									<input type="text" name="email" placeholder="E-mail" data-id="email" data-necessarily="true"/><br/>
									<input type="text" name="address" placeholder="Адрес" data-id="address" data-necessarily="true"/>
								</div>
								<div style="position:relative; float:left; width:45%">
									<?foreach($selects as $name => $select):?>
										<?require "include/editors/select.php"?>
									<?endforeach;?>
									<br/>
									<a href="#" class="button small" onClick="sub_form()">Оформить</a>
								</div>
							</div>
						</form>
					</div>												
												
											
											<?else:?>
												Ваша корзина пуста.
											<?endif;?>
										</div>
									</div><!-- .content-->
								</div><!-- .container-->
								
								<div class="left-sidebar-attr clearfix" >
									<div class="logo-column scroll-content1" style="height: 400px; oveflow: auto;">
										<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="" >
										
										<div id="attr-4" class="clearfix noactive">
											<div id="attribut" class="clearfix">
												<div style="margin-bottom:5px;">Корзина:</div>
												<div class="cart">
													<?if($cart):?>
														<?foreach($cart as $item_id => $item):?>
															<div class="<?=$item_id?>  clearfix">
																<div style="width:10%; float:left;"><?=$item['qty']?></div>
																<div style="width:85%; float:left;"><?=$item['name']?></div>
																<div style="width:5%; float:left; text-align:right;"><a href="#" onclick="delete_item('<?=$item_id?>')" class="delete">X</a></div>
															</div>
														<?endforeach;?>
														<div>
															<a href="<?=base_url()?>pages/cart">Оформить заказ</a>
														</div>
													<?else:?>
														Ваша корзина пуста.
													<?endif;?>
												</div>
											</div>
										</div>
										
										<? require 'include/left-menu.php'?>
										
										<div id="attr-2" class="clearfix noactive">
											<div id="attribut" class="clearfix">
												<ul>
													<li class="accd">
														<div class="attr-titl open">Производители</div>
														<ul class="show">
															<?$counter_2 = 1?>
															<?foreach($manufacturer as $firma):?>
																<li>
																	<input type="checkbox" class="manufacturer_checked" name="manufacturer_checked[]" num="<?=$counter_2?>" value="<?=$firma->id?>" id="c_1_1" onclick="filter()" 
																		<?if(!empty($manufacturer_checked)):?>
																			<?foreach($manufacturer_checked as $ch):?>
																				<?if($ch == $firma->id):?>checked<?endif;?>
																			<?endforeach;?>
																		<?endif;?>>
																		<a href="#"><?=$firma->name?></a>
																</li>
																<?$counter_2++?>
															<?endforeach;?>
														</ul>
													</li>
												</ul>
											</div>
										</div>
										
										<div id="attr-3" class="clearfix noactive">
											<div id="attribut" class="clearfix">
												<div style="margin-bottom:5px;">Характеристики:</div>
												<div class="filter">	
													<div class="filtr-razmer-1">Размеры(мм):</div>
													<div class="filtr-razmer-2">от:</div>	
													<div class="filtr-razmer-2">до:</div>
													<div class="filtr-razmer-1">ширина:</div>
													<input class="filtr-razmer-3" type="text" name="" />
													<input class="filtr-razmer-3" type="text" name="" />
													<div class="filtr-razmer-1">высота(h):</div>	
													<input class="filtr-razmer-3" type="text" name="" />
													<input class="filtr-razmer-3" type="text" name="" />
													<div class="filtr-razmer-1">глубина:</div>
													<input class="filtr-razmer-3" type="text" name="" />
													<input class="filtr-razmer-3" type="text" name="" />
													<div class="filter-titl">Цвет:</div>
													<div class="help">i</div>
													<input class="input" type="text" name="" />
													<div class="filter-titl">Материал:</div>
													<div class="help">i</div>
													<input class="input" type="text" name="" />
													<div class="filter-titl">Отделка:</div>
													<div class="help">i</div>
													<input class="input" type="text" name="" />
													<div class="filter-titl">Разворот:</div>
													<div class="help">i</div>
													<input class="input" type="text" name="" />
												</div>
											</div>
										</div>

										</form>
									</div>
								</div>
							</div>
						</div><!-- .content-->
					</div><!-- .container-->
					<div class="left-sidebar-filtr clearfix">
						<? require 'include/left-col.php'?>
					</div>
				</div><!-- .middle-->
			</div><!--/main-->
			
			<div class="footer"></div><!--/footer-->
			
		</div><!--/wrap-->
		
		<? require 'include/footer_script.php'?>
	</body>
</html>