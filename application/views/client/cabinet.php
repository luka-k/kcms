<!DOCTYPE html>
<html>
	<head>
		<title><?=$user->name?>: личный кабинет</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/client/css/kickstart.css" media="all" /> <!--kickstart css-->
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/client//normalize.css" media="all" />
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/client/js/jquery-ui/jquery-ui.css" media="all" /> <!--jquery-ui css-->
		<link type="text/css" rel="stylesheet" href="<?=base_url()?>template/client/css/style.css" media="all" /> <!--custom css-->
		
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery.min.js"></script> <!--jquery js-->
		<script type="text/javascript" src="<?=base_url()?>template/client/js/kickstart.js"></script>  <!--kickstart js-->
		<script type="text/javascript" src="<?=base_url()?>template/client/js/script.js"></script> <!--jquery js-->
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery-ui/jquery-ui.js"></script>
		<script type="text/javascript" src="<?=base_url()?>template/client/js/jquery-ui/ru.js"></script>	
	</head>

	<body>
		<div id="content" class="grid flex">
			<div id="children_col" class="col_3">
				<ul class="children_list">
					<?foreach($children as $key => $child):?>
						<li class="col_12">
							<div class="avatar col_2">
								<a href="<?=base_url()?>account/<?=$key?>">
									<img src="<?=base_url()?>view_image?id=<?=$child->id?>" alt="<?=$child->full_name?>"/>
								</a>
							</div>
							<div class="name col_10">
								<a href="<?=base_url()?>account/<?=$key?>"><?=$child->full_name?></a>
							</div>						
						</li>
					<?endforeach;?>
				</ul>
			</div>
			<div id="info_col" class="col_9">
				<div id="child_info" class="clearfix">
					<div class="avatar col_2">
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="avatar_form" class="form" action="<?=base_url()?>account/update_child_photo/<?=$selected_child->id?>" >
							<img src="<?=base_url()?>view_image?id=<?=$selected_child->id?>" alt="<?=$selected_child->full_name?>" />
							<a href="#" id="psevdoInput" class="upload" onclick="$('#avatar').click();">
								Обновить фото
							</a>
							<input type="file" id="avatar" name="image" accept="application/msword" onchange="document.forms['avatar_form'].submit()"/>
						</form>
					</div>
					
					<div class="personal_info col_7">
						<div class="sub_wrap clearfix">
							<div style="float:left; width:60%">
								<div class="col_12">
									Ф.И.О.: <span><?=$selected_child->full_name?></span><br />
								</div>
								<div class="col_12">
									Школа: <span><?=$selected_child->school->name?></span><br />
								</div>
								<div class="col_12">
									Класс: <span><?=$selected_child->class?></span><br />
								</div>
							
							</div>
							
							<div class="balance" style="float:right; width:40%;">
								<div class="col_12 right">Баланс карты: <span style="color:red;"><?=$selected_child->card->card_balance?> р.</span></div>
							</div>
						</div>
					</div>
					
					<div class="col_2">
						<a href="" class="button orange center">Пополнить баланс</a>
					</div>
				</div>
			
				<div id="">
					<ul class="tabs left">
						<li><a href="#tabr1">Статистика</a></li>
						<li><a href="#tabr2">Меню</a></li>
						<li><a href="#tabr3">Настройки</a></li>
					</ul>

					<div id="tabr1" class="tab-content">
						<div class="tab-title col_12">Пополнения баланса и расходы</div>
						<div class="col_12">
						
							<table class="striped">
								<thead>
									<tr>
										<th>Дата, время</th>
										<th>Сумма</th>
										<th>Информация (состав заказа)</th>
									</tr>
								</thead>
								<tbody>
									<?foreach($selected_child->orders as $order):?>
										<tr>
											<td><?=$order->date?></td>
											<td class="<?if(mb_substr($order->summ, 0, 1) == '-'):?>red<?else:?>green<?endif;?>"><?=$order->summ?> р.</td>
											<td>
												<?if(!empty($order->products)):?>
													<?foreach($order->products as $key => $product):?>
														<?=$product->name?><?if($key <> count($order->products)-1):?>, <?endif;?>
													<?endforeach;?>
												<?endif;?>
											</td>
										</tr>
									<?endforeach;?>
								</tbody>
							</table>
							
						</div>
					</div>
					<div id="tabr2" class="tab-content">
						<div class="tab-title col_12">Меню</div>
						<div class="col_12">
							<table class="tight">
								<thead>
									<tr>
										<th>Наименование</th>
										<th>Вес</th>
										<th>Цена</th>
										<th>Разрешено</th>
									</tr>
								</thead>
								<tbody>
									<?foreach($child_menu->categories as $category):?>
										<tr>
											<td class="menu_type"><?=$category->name?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<?if(!empty($category->products)):?>
											<?foreach($category->products as $product):?>
												<tr>
													<td><?=$product->name?></td>
													<td><?=$product->weight?> г.</td>
													<td><?=$product->price?> р</td>
													<td>
														<input type="checkbox" 
															   id="<?=$product->id?>_pr" value="<?=$product->id?>" 
															   <?if(!in_array($product->id, $selected_child->disabled_products)):?>checked<?endif;?> 
															   onchange="set_product_status('<?=$product->id?>', <?=$selected_child->id?>)"/>
													</td>
												</tr>
											<?endforeach;?>
										<?endif;?>
									<?endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
					<div id="tabr3" class="tab-content">
						<div class="tab-title col_12">Настройки</div>
						<div class="col_12">
							<label for="" class="">Максимальная сумма в день:</label>
							<input type="text" name="" class="" value="<?=$selected_child->card->card_day_limit?> р." onchange="set_limit(this.value, '<?=$selected_child->card_number?>')" /><br /><br />
							<label for="" class="">СМС-информирование по питанию (100р в месяц):</label> 
							<input type="checkbox" id="dinner_ch" <?if($selected_child->dinner_sms_enabled == 1):?>checked<?endif;?> onchange="set_status('dinner', '<?=$selected_child->id?>');" /> 
							<span class="dinner_status <?if($selected_child->dinner_sms_enabled == 1):?>green<?else:?>red<?endif;?> "><?if($selected_child->dinner_sms_enabled == 1):?>включено<?else:?>выключено<?endif;?> </span> 
							
							<span class="dinner_date">
								<?if($selected_child->dinner_sms_enabled == 1):?>
									<?=$selected_child->dinner_sms_enabled_date?>
								<?endif;?>
							</span>
							<br /><br />
							
							<label for="" class="">СМС-информирование по посещению школы (100р в месяц):</label> 
							<input type="checkbox" id="visit_ch" <?if($selected_child->visit_sms_enabled == 1):?>checked<?endif;?> onchange="set_status('visit', '<?=$selected_child->id?>');" /> 
							<span class="visit_status <?if($selected_child->visit_sms_enabled == 1):?>green<?else:?>red<?endif;?>"><?if($selected_child->visit_sms_enabled == 1):?>включено<?else:?>выключено<?endif;?></span> 
							
							<span class="visit_date">
								<?if($selected_child->visit_sms_enabled == 1):?>
									<?=$selected_child->visit_sms_enabled_date?>
								<?endif;?>
							</span>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="parent-info" class="clearfix">
			<div class="personal-info clearfix">
				<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="parent_form" class="form" action="<?=base_url()?>account/update_info">
					<input type="hidden" name="id" value="<?=$user->id?>"/>
					<label for="" class="col_2">Ф.И.О:</label>
					<input type="text" name="name" class="require col_9" value="<?=$user->name?>"/>
					<label for="" class="col_2">Email:</label>
					<input type="text" name="email" class="require col_9" value="<?=$user->email?>"/>
					<label for="" class="col_2">Пароль:</label>
					<input type="text" name="password" class="col_9" value=""/>
					<a href="#" class="button green col_4" onclick="form_submit('parent_form'); return false">Изменить</a>
				</form>
			</div>
			<div class="p-btn log-out">
				<a href="<?=base_url()?>account/log_out">Выход</a>
			</div>
			<div class="p-btn info-link">
				<a href="#" onclick="$('#parent-info').toggleClass('active'); $('.info-link').toggleClass('active');return false;">Здравствуйте, <span><?=$user->short_name?></span></a>
			</div>
		</div>
	</body>
</html>