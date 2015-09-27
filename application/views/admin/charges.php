<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
			<div class="col_12">
				<h4>Загрузить начисления</h4>
				<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="upload_charges" action="<?=base_url()?>admin/charges/parse">
					<input type="file" name="charges" />
					<button type="submit"/>Загрузить</button>
				</form>
			</div>
		</div>
	</div>
	<? require 'include/footer_script.php' ?>
	<? require 'include/footer.php' ?>
	</body>
</html>