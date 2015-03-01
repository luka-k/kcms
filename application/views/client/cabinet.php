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
			<?else:?>
				Вы еще не сделали заказов.
			<?endif;?>
			
			<h1 class="page__title">Персональные данные</h1>
			
			<div class="avatar page__form">
				<?if(!empty($user->vk_avatar)):?>
					<div>
						<img width="120px" src="<?=$user->vk_avatar?>" alt=""/>
					</div>
				<?elseif(!empty($user->img)):?>
					<div style="position:relative; float:left;">
						<img src="<?=$user->img->catalog_small_url?>" alt=""/>
					</div>
				
				<div>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" class="form" action="<?=base_url()?>cabinet/update_info/image"/>
						<input type="hidden" name="id"  value="<?=$user->id?>"/>
						<div class="form__line" style="float:left; padding-top:20px;">
							<a href="#" id="psevdoInput" class="upload" onclick="file_input.click(); return false;"><?if(!empty($user->img)):?>Изменить аватар<?else:?>Выбрать изображение<?endif;?></a>
							<input id="psevdoFileValue" class="inputFileText" type="text" style="display:none;"/>
							<input type="file" id="file_input" name="avatar" onchange="document.getElementById('psevdoFileValue').value = this.value; document.getElementById('psevdoFileValue').style.display='block'; document.getElementById('psevdoInput').style.display='none'; document.getElementById('fileInputButton').style.display='inline-block';"/>
						</div>
						<div class="form__button avatar__button skew">
							<button type="submit" id="fileInputButton" class="button button--normal button--auto-width" style="display:none;"><?if(!empty($user->img)):?>Изменить<?else:?>Загрузить<?endif;?></button>
							<?if(!empty($user->img)):?>
								<button class="button button--normal button--auto-width" onclick="document.location.assign('/cabinet/delete_avatar/<?=$user->img->id?>'); return false;">Удалить</button>
							<?endif;?>
						</div>
					</form>
				</div>
				<?endif;?>
			</div>
			
			<div class="clearfix page__form">
				<form method="post" class="form" action="<?=base_url()?>cabinet/update_info/personal"/>
					<input type="hidden" name="id"  value="<?=$user->id?>"/>
				
					<div class="form__line skew">
						<input type="text" class="form__input" name="last_name" placeholder="Фамилия" value="<?if($user->last_name):?><?=$user->last_name?><?endif;?>"/>
					</div> <!-- /.form__line -->
				
					<div class="form__line skew">
						<input type="text" class="form__input required" name="name" placeholder="Имя" value="<?if($user->name):?><?=$user->name?><?endif;?>"/>
					</div> <!-- /.form__line -->
				
					<div class="form__line skew">
						<input type="text" class="form__input" name="patronymic" placeholder="Отчество" value="<?if($user->patronymic):?><?=$user->patronymic?><?endif;?>"/>
					</div> <!-- /.form__line -->
				
					<div class="form__line skew">
						<input type="text" class="form__input required" name="email" placeholder="E-mail" value="<?if($user->email):?><?=$user->email?><?endif;?>" />
					</div> <!-- /.form__line -->
							
					<div class="form__line skew">
						<input type="text" class="form__input" name="phone" placeholder="Телефон" value="<?if($user->phone):?><?=$user->phone?><?endif;?>" />
					</div> <!-- /.form__line -->
				
					<div class="form__line skew">
						<input type="text" class="form__input" name="city" placeholder="Город" value="<?if($user->city):?><?=$user->city?><?endif;?>" />
					</div> <!-- /.form__line -->
				
					<div class="form__line skew">
						<input type="text" class="form__input" name="street" placeholder="Улица" value="<?if($user->street):?><?=$user->street?><?endif;?>" />
					</div> <!-- /.form__line -->
				
					<div class="form__line skew">
						<input type="text" class="form__input" name="house" placeholder="Дом" value="<?if($user->house):?><?=$user->house?><?endif;?>" />
					</div> <!-- /.form__line -->
				
					<div class="form__line skew">
						<input type="text" class="form__input" name="building" placeholder="Корпус" value="<?if($user->building):?><?=$user->building?><?endif;?>" />
					</div> <!-- /.form__line -->
				
					<div class="form__line skew">
						<input type="text" class="form__input" name="apartment" placeholder="Квартира" value="<?if($user->apartment):?><?=$user->apartment?><?endif;?>" />
					</div> <!-- /.form__line -->
				
					<div class="form__line skew">
						<input type="text" class="form__input" name="zip_code" placeholder="Индекс" value="<?if($user->zip_code):?><?=$user->zip_code?><?endif;?>" />
					</div> <!-- /.form__line -->
				
					<div class="form__button cart-order__button skew">
						<button type="submit" class="button button--normal button--auto-width">Изменить данные</button>
					</div> <!-- /.form__button -->
				</form>
			</div>
			
			<h1 class="page__title">Изменить пароль</h1>
			<div class="page__form">
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
			</div>
		</div> <!-- /.page__wrap wrap -->
	</div> <!-- /.page -->
		
	<? require 'include/footer.php'?>
	<? require 'include/modal.php'?>
	<? require 'include/scripts.php'?>
	</body>
</html>