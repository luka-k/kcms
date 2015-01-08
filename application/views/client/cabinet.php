<!DOCTYPE html>
<!--[if lte IE 9]>      
	<html class="no-js lte-ie9">
<![endif]-->
<!--[if gt IE 8]><!--> 
	<html class="no-js">
<!--<![endif]-->

<? require 'include/head.php' ?>
    
<body>
	<!--[if lt IE 8]>
		<p class="browsehappy">Ваш браузер устарел! Пожалуйста,  <a rel="nofollow" href="http://browsehappy.com/">обновите ваш браузер</a> чтобы использовать все возможности сайта.</p>
	<![endif]-->

	<? require 'include/header.php'?>
	<? require 'include/top-menu.php'?>

	<div class="page page-about">
		<div class="page__wrap wrap">			
			<h1 class="page__title">Ваши заказы</h1>
			<?if(!empty($orders)):?>
				<div class="page-cart__products">
					<table class="cart-table">
						<tbody>
							<tr>
								<th></th>
								<th>Товары</th>
								<th>Дата</th>
								<th>Статус</th>
							</tr>
							<?$counter = 1?>
							<?foreach($orders as $item_id => $item):?>
								<tr>
									<td><?=$counter?></td>
									<td>
										<table>
											<tbody>
												<tr>
													<th>Товар</th>
													<th>Цена</th>
													<th>Количество</th>
												</tr>
												<?foreach($item->order_products as $p):?>
													<tr style="font-size:14px;">
														<th><?=$p->product_name?></th>
														<th><?=$p->product_price?></th>
														<th><?=$p->order_qty?></th>
													</tr>
												<?endforeach;?>
											</tbody>
										</table>
									</td>
									<td><div class="cart-table__price"><?=$item->date?></div> <!-- /.cart-table__price --></td>
									<td style="text-align:center"><?=$item->status?></td>
								</tr>
							<?endforeach;?>
						</tbody>
					</table> <!-- /.cart-table -->
				</div> <!-- /.page-cart__products -->
			<?endif;?>
			
			<h1 class="page__title">Персональные данные</h1>
			
			<form method="post" class="form" action="<?=base_url()?>cabinet/update_info/personal"/>
				<input type="hidden" name="id"  value="<?=$user->id?>"/>
				
				<div class="form__line skew">
					<input type="text" class="form__input required" name="name" placeholder="Имя" value="<?if($user->name):?><?=$user->name?><?endif;?>"/>
				</div> <!-- /.form__line -->
				
				<div class="form__line skew">
					<input type="text" class="form__input required" name="email" placeholder="E-mail" value="<?if($user->email):?><?=$user->email?><?endif;?>" />
				</div> <!-- /.form__line -->
							
				<div class="form__line skew">
					<input type="text" class="form__input required" name="phone" placeholder="Телефон" value="<?if($user->phone):?><?=$user->phone?><?endif;?>" />
				</div> <!-- /.form__line -->
				
				<div class="form__line skew">
					<textarea name="address" class="form__textarea" placeholder="Адрес доставки" value=""><?if($user->address):?><?=$user->address?><?endif;?></textarea>
				</div> <!-- /.form__line -->
				
				<div class="form__button cart-order__button skew">
					<button type="submit" class="button button--normal button--auto-width">Изменить данные</button>
				</div> <!-- /.form__button -->
			</form>
			
			<h1 class="page__title">Изменить пароль</h1>
			
			<form method="post" class="form" action="<?=base_url()?>cabinet/update_info/pass"/>
				<input type="hidden" name="id"  value="<?=$user->id?>"/>
				
				<div class="form__line skew">
					<input type="text" class="form__input required" name="password" autocomplete="off" placeholder="Пароль" value=""/>
				</div> <!-- /.form__line -->
				
				<div class="form__line skew">
					<input type="text" class="form__input required" name="conf_password" autocomplete="off" placeholder="Повторите" value="" />
				</div> <!-- /.form__line -->
				
				<div class="form__button cart-order__button skew">
					<button type="submit" class="button button--normal button--auto-width">Изменить пароль</button>
				</div> <!-- /.form__button -->
			</form>
		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->
		
	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>
	</body>
</html>