<!DOCTYPE html>
<html>
	<?require 'include/head.php'?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<?require 'include/top_menu.php'?>
				<div  class="col_12 clearfix">
					<div class="col_12 clearfix">
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>admin/mails/edit_mails/"/>
							<a href="#" onClick="document.forms['form1'].submit()" class="btn small">Сохранить</a>
							
							<table>
								<thead>
									<th style="width:10%;">Номер</th>
									<th style="width:20%;">Тип</th>
									<th style="width:30%;">Тема</th>
									<th style="width:40%;">Текст сообщение</th>
								</thead>
								<tbody>
									<?$counter = 1?>
									<?foreach($emails as $mail):?>
										<tr>
											<td><?=$counter?><input type="hidden" name="id[]" value="<?=$mail->id?>"></td>
											<?$counter++?>
											<td>
												<select name="type[]">
													<?foreach($select as $value => $title):?>
														<option value="<?=$value?>" <?if($value == $mail->type):?>selected<?endif;?>><?=$title?></option>
													<?endforeach;?>
												</select>
											</td>
											<td>
												<input type="text" name="subject[]" value="<?=$mail->subject?>" style="width:100%"/>
											</td>
											<td>
												<textarea name="description[]" style="width:100%; height:100px;"><?=$mail->description?></textarea>
											</td>
										</tr>
									<?endforeach;?>
								</tbody>
							</table>
							
							<a href="#" onClick="document.forms['form1'].submit()" class="btn small">Сохранить</a>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?require 'include/footer.php'?>
	</body>
</html>