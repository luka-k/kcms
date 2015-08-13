<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
			<div class="col_12">
				<form>
					<div class="col_12">Издательство:</div>
					<?$publicher_counter = 1?>
					<?foreach($publishers as $p):?>
						<div class="col_12">
							<input type="radio" id="lbl_<?=$publicher_counter?>" name="publisher" value="<?=$p?>"/>
							<label for="lbl_<?=$publicher_counter?>"><?=$p?></label>
						</div>
						<?$publicher_counter++?>
					<?endforeach;?>
			
					<div class="col_12 clearfix">
						<div class="col_1">Файл</div>
						<div class="col_5"><input type="file" id="xml_file" name="xml_file" /></div>
					</div>
					<div class="col_12">
						<a href="#" class="button small">Импорт</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<? require 'include/footer_script.php' ?>
	<? require 'include/footer.php' ?>
	</body>
</html>