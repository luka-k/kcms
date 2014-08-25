<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
			<div class="col_12">
					<div id="left_col" class="col_6 back">
						<h6 class="col_8 left">Последние 5 работ</h6> 
												
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">№</th>
									<th class="tb_11">Имя</th>
								</tr>
							</thead>
							<tbody id="sortable">
								<form id="form" method="get" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_page"/>
									<?$news_count = 1?>
									<?php foreach ($news as $news_item): ?>
										<tr>
											<td class="tb_1"><?=$news_count?></td>
											<td class="tb_11"><a href="<?=base_url()?>admin/page/works/<?=$news_item->id?>"><?=$news_item->title?></a></td>
										</tr>
										<?$news_count++?>
									<?php endforeach ?>
								</form>
							</tbody>
						</table>
					</div>						
			</div>
		</div>
	</div>
	<? require 'include/footer_scripth.php' ?>
	<? require 'footer.php' ?>
	</body>
</html>