<!DOCTYPE html>
<html>
	<?require 'include/head.php'?>
	<body>
	
		<div id="page" class="grid flex">
			<div id="wrap" class="clearfix">	
				<?require 'include/top_menu.php'?>
				<div  class="col_12 clearfix">

					<div id="left_col" class="col_8 back">
						<h6>Рассылки</h6>
						<table>
							<thead>
								<tr>
									<th class="tb_1">&nbsp;</th>
									<th class="tb_3">Дата</th>
									<th class="tb_3">Группы пользователей</th>
									<th class="tb_3">Шаблон</th>
									<th class="tb_2">Статистика</th>
								</tr>
							</thead>
							<tbody>
								<?$counter = 1?>
								<?foreach($mailouts as $mail):?>
									<tr>
										<td><?=$counter?></td>
										<td><?=$mail->mailouts_date?></td>
										<td>
											<ul>
												<?foreach($mail->users_groups as $g):?>
													<li><?=$g?></li>
												<?endforeach;?>
											</ul>
										</td>
										<!--Тут есть мысль вставить ссыль на шаблон-->
										<td><?=$mail->template?></td>
										<td>
											<span style="color:green;">Удачно: <?=$mail->success?></span></br>
											<span style="color:red;">Неудачно: <?=$mail->no_success?></span>
										</td>
									</tr>
								<?endforeach;?>
							</tbody>
						</table>
					</div>
					
					<div id="right_col" class="col_4 back">
						<h6 class="col_12">Создать новую</h6>
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="new_subscribe" action="<?=base_url()?>admin/mailouts_module/mailout/"/>
							<?if(empty($templates)):?>
								<div class="col_12">Необходимо <a href="<?=base_url()?>admin/content/item/edit/emails?parent_id=2">создать шаблон рассылки</a></div>
							<?else:?>
								<select id="template" name="template" class="col_12" onchange="enabled_item(this.options[this.selectedIndex].value);">
									<option value="0" select>Необходимо выбрать</option>
									<?foreach($templates as $template):?>
										<option value="<?=$template->id?>"><?=$template->name?></option>
									<?endforeach?>
								</select>
								
								<div class="col_12 center"><input type="submit" id="template_button" class="small disabled" value="Создать" disabled="disabled" /></div>
							<?endif;?>
						</form>
					</div>

				</div>
			</div>
		</div>
		<?require 'include/mailouts_script.php'?>
		<?require 'include/footer_script.php'?>
		<?require 'include/footer.php'?>
	</body>
</html>