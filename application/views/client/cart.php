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
				<?if(!empty($action)):?>
					<div id="cart" style="padding:10px 20px;">
						<div class="title-2">Ваш заказ успешно оформлен.</div>
					</div>
				<?else:?>
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
						<form action="<?=base_url()?>order/edit_order?action=order_from_cart" id="order_form" class="order_form" method="post">
							<div class="title-2">Информация о покупателе</div>
							<div class="col_6" style="margin-right:3.22222222%;">
								<label for="text1">Имя</label><br/>	
								<input id="text1" type="text" name="name" class="validate square"/><br/>	
								<label for="text2">Эл. почта</label><br/>	
								<input id="text2" type="text" name="email" class="validate square"//><br/>	
								<label for="textarea1">Адрес доставки</label><br/>	
								<textarea id="textarea1" placeholder="Введите адрес"  name="address" class="validate square"/></textarea>
							</div>
							<div class="col_6">
								<label for="text1">Телефон</label><br/>	
								<input id="text1" type="text" name="phone" class="validate square"/><br/>	
								<label for="text2">Местоположение</label><br/>	
								<select id="select1" name="city_id" size="1" class="validate select">
									<option value="">Необходимо выбрать</option>
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
								<button class="red-btn square" onclick="validate_form('order_form'); return false;">Оформить заказ</button>
							</div>
						</form>
					</div>
				<?else:?>
					<div id="cart" style="padding:10px 20px;">
						<div class="title-2">Корзина пуста</div>
					</div>
				<?endif;?>
				<?endif;?>
			</div>

		</div>
<? require 'include/footer.php' ?>		