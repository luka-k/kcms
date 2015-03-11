<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
			<div class="col_12 back" >
				<a href="http://autocummins.ru/admin/import/load1C" target="_blank">Лог последнего обмена с 1С</a>
			</div>
				<div  class="col_12 back">
				<h5>Импорт csv</h5>
				<form action="/admin/import" method="post" enctype="multipart/form-data">
				<input type="file" name="csv" />
				<input type="submit" value="ok" />
				</form>
				</div> 
		</div>
	</div>
	<? require 'include/footer_script.php' ?>
	<? require 'include/footer.php' ?>
	</body>
</html>