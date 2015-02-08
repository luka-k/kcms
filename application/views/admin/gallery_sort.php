<!DOCTYPE html>
<html>
	<? require 'include/head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="right_col" class="col_12 back">
						<div class="col_12">						
							<h6 class="col_8 left">Сортировка галлереи на главной</h6> 		
						</div>
						<table  id="sort" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">&nbsp;</th>
									<th class="tb_11">Фотография</th>
								</tr>
							</thead>
							<tbody class="<?if($sortable):?>sortable<?endif?>">
								<?$counter = 1?>
								<? foreach ($content as $item): ?>
									<tr id="<?=$type?>-<?=$item->id?>">
										<td class="tb_1"><?=$counter?></td>
										
										<td class="tb_11">
											<img src="<?=$item->catalog_mid_url?>" />
										</td>
									</tr>
									<?$counter++?>
								<? endforeach; ?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?require 'include/footer_script.php'?>
		<?require 'include/footer.php'?>
	</body>
</html>