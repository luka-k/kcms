<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
			<div class="col_12 back">
				<?if(isset($logs)):?>
					
						<div class="col_12" style="border:1px solid red; border-radius:5px; padding:5px;">
							Кнопка - "Логи" в меню показывается если константа ENVIRONMENT = "development", что бы их видели только мы.</br>
							Надпись после проверки уберу.
						</div><!--Удалить после одобрения формата просмотров логов-->
						
						<h6 class="col_12">Логи</h6>
						<div class="col_12">
							<?foreach($logs as $log_type):?>
								<a href="<?=base_url()?>admin/logs/?log_name=<?=$log_type?>"><?=$log_type?></a>&nbsp;
							<?endforeach;?>
						</div>
						
						<?if(empty($log_items)):?>
							<div class="col_12">Логи <?=$viewed_log?> пусты</div>
						<?else:?>
							<?foreach($log_items as $log_time => $item):?>
								<div class="col_2"><?=$log_time?></div>
								<div class="col_10"><?=$item?></div>
							<?endforeach;?>
						<?endif;?>
					
						<div class="col_12">
							<a href="<?=base_url()?>admin/logs/clear/<?=$viewed_log?>" class="button"><i class="icon-remove"></i> Очистить логи <?=$viewed_log?></a>
							<a href="<?=base_url()?>admin/logs/clear" class="button"><i class="icon-remove"></i> Очистить все логи</a>
						</div>
				<?else:?>
					Логов нет.
				<?endif;?>
			</div>
		</div>
	</div>
	<? require 'include/footer_script.php' ?>
	<? require 'include/footer.php' ?>
	</body>
</html>