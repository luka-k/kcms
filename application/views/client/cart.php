<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_8 clearfix">
				<div class="col_12">
					<h5>Корзина</h5>
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
							<a href="<?=base_url()?>/registration/cabinet">Личный кабинета</a>
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
				<?if($cart <> NULL):?>
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