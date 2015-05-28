<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
			<div class="col_12 back">
				<?if(empty($log_items)):?>
					Логов нет.
				<?else:?>	
					<div class="col_12" style="border:1px solid red; border-radius:5px; padding:5px;">
						Кнопка - "Логи" в меню показывается если константа ENVIRONMENT = "development", что бы их видели только мы.</br>
						Надпись после проверки уберу.</br>
						Тип лога пока оставил. если например поиск по типу понадобиться.</br>
						Наверно надо подумать о просмотре из админки архивированных логов.
					</div><!--Удалить после одобрения формата просмотров логов-->
						
					<h6 class="col_12">Логи</h6>
						
					<div class="col_1">Время</div>
					<div class="col_1">Тип</div>
					<div class="col_10">Содержание</div>
					<?foreach($log_items as $item):?>
						<div class="col_1"><?=$item[0]?></div>
						<div class="col_1"><?=$item[1]?></div>
						<div class="col_10"><?=$item[2]?></div>
					<?endforeach;?>
					
					<div class="col_12">
						<a href="<?=base_url()?>admin/logs/clear" class="button"><i class="icon-remove"></i> Очистить все логи</a>
					</div>					
				<?endif;?>
			</div>
		</div>
	</div>
	<? require 'include/footer_script.php' ?>
	<? require 'include/footer.php' ?>
	</body>
</html>