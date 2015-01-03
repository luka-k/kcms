<? require 'include/head.php' ?>

<div id="body">
	<div id="wrapper" class="clearfix">
		<? require 'include/header.php' ?>
		<? require 'include/top-menu.php' ?>
		
		<div id="main-3" class="grid clearfix">
			<div id="left-col" class="col_3">
				<div class="left-col">
					<div class="name-cat">
					</div>
					<nav>
						<ul>
							<? foreach($tree as $s):?>
								<li>
									<a href="<?= $s->full_url ?>"><?= $s->name ?></a>
									<? if ($this->uri->segment(3) == $s->url) : ?>
										<ul class="active">
											<? $screens = $s->childs;
											$names = array();
											foreach ($screens as $i => $scr)
											{
												if ($screens[$i]->caption)
													$screens[$i]->name = $screens[$i]->caption;
												$names[] = $screens[$i]->name;
											}
											array_multisort($names, $screens);
											foreach ($screens as $scr) : ?>
												<li><a <?= $scr->url == $this->uri->segment(4) ? 'class="active"' : '' ?> href="<?= $scr->full_url?>"><?= $scr->name ?></a></li>
											<? endforeach ?>
										</ul>
									<? endif ?>
								</li>
							<? endforeach ?>
						</ul>
					</nav>
				</div>
				<aside>
					<div class="text-1" style="color: white;padding-top: 20px;">СПЕЦПРЕДЛОЖЕНИЯ</div>
					<h6>"Клуб Газелистов России" <a href="http://www.gazelleclub.ru" target="_blank">www.gazelleclub.ru</a></h6>
					<p>Скидка 7% от цены заявленной на сайте всем участникам Клуба Газелистов России.</p>
					<img src="img/banner.png" alt=""/>
							
					<!--
							<div class="news clearfix">
								<div class="col_12">
									<div class="text-1">НОВОСТИ</div>
									<? foreach ($news as $el) : ?>
									<div class="news-item">
										<div class="news-date"><?= $el->date?></div>
										<div class="news-title"><a href="<?= $el->url?>"><?= $el->name?></a></div>
									</div>
									<? endforeach ?>
								</div>
							</div>
							
							<div class="blog clearfix">
								<div class="col_12">
									<div class="text-1">СТАТЬИ</div>
									<? foreach ($articles as $el) : ?>
									<div class="blog-item">
										<div class="blog-date"><?= $el->date?></div>
										<div class="blog-title"><a href="<?= $el->url?>"><?= $el->name?></a></div>
									</div>
									<? endforeach ?>
								</div>
							</div>
							
							<div class="video clearfix">
								<div class="col_12">
									<div class="text-1">Видео</div>
									<? foreach ($videos as $v) : ?>
									<div class="video-item">
										<iframe width="100%" src="http://www.youtube.com/embed/<?= $v->video ?>" frameborder="0" allowfullscreen></iframe>
										<span class="title"><?= $v->name ?></span> <span class="time"></span>
									</div>
									<? endforeach ?>
									
								</div>
							</div>
							-->
				</aside>
			</div>
			
			<div id="content" class="col_9 clearfix">
				<? require 'include/breadcrumbs.php'?>	
				
				<?if($cart_items):?>
					<div class="title col_12">Ваши заказы</div>
					<div id="cart">
						<table  cellspacing="0" cellpadding="0" class="cart-table">
							<thead>
								<tr>
									<th class="tbl-col-1">&nbsp;</th>
									<th class="tbl-col-2">Наименование</th>
									<th class="tbl-col-3">Цена</th>
									<th class="tbl-col-4">Количество</th>
									<th class="tbl-col-5">Стоимость</th>
									<th class="tbl-col-6">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								<?foreach($cart_items as $item_id => $item):?>
									<tr id="cart-<?=$item_id?>">
										<td class="tbl-col-1"><img src="<?=$item->img->catalog_small_url?>"/></td>
										<td class="tbl-col-2"><?=$item->name?></td>
											<td class="tbl-col-3"><?=$item->price?> руб.</td>
											<td class="tbl-col-4">
												<span class="btn plusminus" onclick="change_qty('-', '<?=$item_id?>'); return false;">-</span>
												<input type="text" id="qty-<?=$item_id?>" class="inpt square" size=1 value="<?=$item->qty?>" disabled />
												<span class="btn plusminus" onclick="change_qty('+', '<?=$item_id?>'); return false;">+</span>
											</td>
										<td class="tbl-col-5"><span id="<?=$item_id?>"><?=$item->item_total?></span> руб.</td>
										<td class="tbl-col-6"><div class="cart-del" onclick="delete_item('<?=$item_id?>')">&nbsp;</div></td>
									</tr>
								<?endforeach;?>
							</tbody>
							<tfoot>
								<th >&nbsp;</th>
								<th >&nbsp;</th>
								<th >&nbsp;</th>
								<th class="tbl-col-7" colspan="3">Итого: <span class="total-price total_price"><?=$total_price?></span> руб.</th>
							</tfoot>
						</table>
					</div>
					<div id="cart-info" class="page-cart__order clearfix">
						<form action="<?=base_url()?>order/edit_order" class="order_form" method="post">
							<div class="title-2">Информация о покупателе</div>
							<div class="col_6" style="margin-right:3.22222222%;">
								<label for="text1">Имя</label><br/>	
								<input id="text1" type="text" name="name" class="square"/><br/>	
								<label for="text2">Эл. почта</label><br/>	
								<input id="text2" type="text" name="email" class="square"//><br/>	
								<label for="textarea1">Адрес доставки</label><br/>	
								<textarea id="textarea1" placeholder="Введите адрес"  name="address" class="square"/></textarea>
							</div>
							<div class="col_6">
								<label for="text1">Телефон</label><br/>	
								<input id="text1" type="text" name="phone" class="square"/><br/>	
								<label for="text2">Местоположение</label><br/>	
								<select id="select1" name="city_id" size="1" class="select">
									<option>Необходимо выбрать</option>
									<?foreach($city_id as $value => $c_i):?>
										<option value="<?=$value?>"><?=$c_i?></option>
									<?endforeach;?>
								</select><br/>
								<label for="textarea1">Коментарии</label><br/>	
								<textarea id="textarea1" placeholder="При необходимости оставте коментарий" name="message" class="square"/></textarea>
							</div>
							<div style="width:100%; position:relative; float:left;" class="clearfix">
								<div id="dostavka-info" class="col_6" style="margin-right:3.22222222%;">
									<h3 class="title-2">Доставка</h3>
									<?$counter = 1?>
									<?foreach($delivery_id as $value => $d_i):?>
										<div class="clearfix">
											<div class="col_1"><div><input type="radio" name="delivery_id" id="radio_<?=$counter?>" class="inline" <?if($counter == 1):?>checked <?endif;?> value="<?=$value?>"/></div></div>
											<div class="col_11"><label for="radio_<?=$counter?>" class="inline"><div class="first-line"><?=$d_i[0]?></div><div class="second-line"><?=$d_i[0]?></div></label></div>
										</div>
										<?$counter++?>
									<?endforeach;?>
								</div>
								<div id="oplata-info" class="col_6">
									<h3 class="title-2">Оплата</h3>
									<?$counter = 1?>
									<?foreach($payment_id as $value => $p_i):?>
										<div class="clearfix">
											<div class="col_1"><div><input type="radio" name="payment_id" id="radio1" class="inline" <?if($counter == 1):?>checked <?endif;?> value="<?=$value?>"/></div></div>
											<div class="col_11"><label for="radio1" class="inline"><div class="first-line"><?=$p_i?></div></label></div>
										</div>
										<?$counter++?>
									<?endforeach?>
								</div>
							</div>
							<div class="col_12" style="text-align:right;">
								<button class="red-btn square" onclick="document.forms['order_form'].submit(); return false;">Оформить заказ</button>
							</div>
						</form>
					</div>
				<?else:?>
					<div id="cart" style="padding:10px 20px;">
						<div class="title-2">Корзина пуста</div>
					</div>
				<?endif;?>
			</div>

		</div>

		<script>
			$('ul .up').click(function() {
				$(this).next().slideToggle().toggleClass('active');
				$(this).toggleClass('up');
				$(this).toggleClass('down');
			});

			$('ul .down').click(function() {
				$(this).next().slideToggle().toggleClass('noactive');
				$(this).toggleClass('down');
				$(this).toggleClass('up');
			});
		</script>
		
<script type="text/javascript">
jQuery(document).ready(function(){
	function htmSlider(){
		var slideWrap = jQuery('.slide-wrap');
		var nextLink = jQuery('.next-slide');
		var prevLink = jQuery('.prev-slide');
		var playLink = jQuery('.auto');
		var is_animate = false;
		var slideWidth = jQuery('.slide-item').outerWidth();
		var scrollSlider = slideWrap.position().left - slideWidth;
		
		nextLink.click(function(){
			if(!slideWrap.is(':animated')) {
				slideWrap.animate({left: scrollSlider}, 150, function(){
					slideWrap
					.find('.slide-item:first')
					.appendTo(slideWrap)
					.parent()
					.css({'left': 0});
				});
			}
		});
 
		prevLink.click(function(){
			if(!slideWrap.is(':animated')) {
				slideWrap
				.css({'left': scrollSlider})
				.find('.slide-item:last')
				.prependTo(slideWrap)
				.parent()
				.animate({left: 0}, 150);
			}
		});
	}
 
	htmSlider();
});
</script>

<? require 'include/footer.php' ?>		



<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_8 clearfix">
				<div class="col_12">
					<h5>Корзина</h5>
					<?if($cart_items <> NULL):?>
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
								<?foreach($cart_items as $item_id => $item):?>
									<tr id="<?=$item_id?>">
										<td><?=$counter?></td>
										<td><?=$item['name']?></td>
										<td><?=$item['price']?></td>
										<td><input type="text" name="qty_<?=$item_id?>" id="qty_<?=$item_id?>" value="<?=$item['qty']?>" onchange="update_cart('<?=$item_id?>', this.value);"/></td>
										<td><span id="item_total_<?=$item_id?>"><?=$item['item_total']?></span></td>
										<td><a href="#" onclick="delete_item('<?=$item_id?>');"><i class="icon-minus-sign icon-2x"></i></a></td>
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
					<?else:?>
						Ваша корзина пуста.
					<?endif;?>
				</div>
			</div>
			<div id="main_content" class="col_4">
				<?if($user <> false):?>
					<div class="col_12">
						<div class="col_6">
							<a href="<?=base_url()?>cabinet">Личный кабинет</a>
						</div>
						<div class="col_6">
							<a href="<?=base_url()?>/registration/do_exit">Выйти</a>
						</div>
					</div>
				<?else:?>
					<div class="col_12">
						<h5>Войти</h5>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="login" action="<?=base_url()?>registration/do_enter/"/>
							<input type="text" name="login" placeholder="Логин"/></br></br>
							<input type="password" name="password" placeholder="Пароль"/></br></br>
							<a href="#" class="button small" onClick="document.forms['login'].submit()">Войти</a>
						</form>
						<div class="col_6">
							<a href="<?=base_url()?>registration/register_user/">Регистрация</a>
						</div>
						<div class="col_6">
							<a href="<?=base_url()?>registration/forgot_password/">Забыли пароль?</a>
						</div>
					</div>
				<?endif;?>
				<?if($cart_items <> NULL):?>
					<div class="col_12">
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="order" action="<?=base_url()?>order/edit_order/"/>
							<div class="cart">
								<h5>Быстрый заказ</h5>
								Имя:<br/>
								<input type="text" name="name" /></br>
								Телефон:<br/>
								<input type="text" name="phone" /></br>
								E-mail:<br/>
								<input type="text" name="email" /></br>
								Адрес:<br/>
								<input type="text" name="address" /></br>
								<?foreach($selects as $name => $select):?>
									<?require "include/editors/select.php"?>
								<?endforeach;?></br>
								<a href="#" class="button small" onClick="document.forms['order'].submit()">Оформить</a>
							</div>
						</form>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>