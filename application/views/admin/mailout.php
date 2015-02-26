<!DOCTYPE html>
<html>
	<?require 'include/head.php'?>
	<body>
	
		<div id="page" class="grid flex">
			<div id="wrap" class="clearfix">	
				<?require 'include/top_menu.php'?>
				<div  class="col_12 clearfix">

					<div id="left_col" class="col_12 back">
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="subscribe_form" action="#"/>
							<input type="hidden" id="template_id" name="template" value="<?=$template_id?>">
							<div  class="col_12">
								<div class="col_2"><label for="lbl_1">От кого</label></div>
								<div class="col_10"><input type="text" id="lbl_1" class="col_12 validate subscribe_info" name="from_name" value="<?=$user['name']?>"/></div>
							</div>
							<div  class="col_12">
								<div class="col_2"><label for="lbl_1">Email отправителя</label></div>
								<div class="col_10"><input type="text" id="lbl_1" class="col_12 validate subscribe_info" name="from_email" value="<?=$user['email']?>"/></div>
							</div>
							<div  class="col_12">
								<div class="col_2"><label for="lbl_1">Тема расссылки</label></div>
								<div class="col_10"><input type="text" id="lbl_1" class="col_12 validate subscribe_info" name="subject" value="<?=$template->subject?>"/></div>
							</div>
							<div id="subscribes" class="col_12" style="border-radius:10px;">
								<div class="col_2"><label for="">Подписчики</label></div>
								<div class="col_10">
									<div class="col_2">
										<div class="col_1"><input type="checkbox" id="all_subscribe" class="validate " onchange="all_sub('main');"/></div>
										<div class="col_11"><label for="all_subscribe">&nbsp;Все подписки</label></div>
									</div>
									<?$counter = 1?>
									<?foreach($users_groups as $group):?>
										<div class="col_2">
											<div class="col_1"><input type="checkbox" id="lbl_<?=$counter?>" class="subscribe_input validate" name="users_groups[]" onchange="all_sub('child');" value="<?=$group->id?>"/></div>
											<div class="col_11"><label for="lbl_<?=$counter?>">&nbsp;<?=$group->name?></label></div>
										</div>
										<?$counter++?>
									<?endforeach;?>
								</div>
							</div>
							
							<div  class="col_12">
								<div class="col_2"><label for="lbl_">Текст рассылки</label></div>
								<div class="col_10"><textarea class="editor" id="editor" id="message" name="message" class="textarea col_12" rows="20" cols="50" placeholder=""><?=$template->description?></textarea></div>
							</div>
							
							<div class="col_12"><input type="submit" id="send_button" class="small" value="Отправить" /></div>
						</form>
					</div>
					
					<div class="modal" id="mailout" style="display:none;">
						<div class="block-title">Отправка писем</div>
	
						<div class="text">
							Отправлено <span class="success">0</span> из <span class="all"></span> писем.<br/>
							<span class="no_success">0</span> писем не отправлено.
						</div>
					</div> <!-- /.modal --> 
				</div>
			</div>
		</div>
		<?require 'include/mailouts_script.php'?>
		<?require 'include/footer_script.php'?>
		<?require 'include/footer.php'?>
	</body>
</html>