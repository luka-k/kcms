<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top-menu.php' ?>
			<div class="col_12">
					<div id="left_col" class="col_6 back">
						<h6 class="col_8 left">Последние 5 новостей</h6> 
												
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">id</th>
									<th class="tb_9">Имя</th>
									<!--<th>Статус</th>-->
									<th class="tb_2">Действие</th>
								</tr>
							</thead>
							<tbody id="sortable">
							
								<form id="form" method="get" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_page"/>
								
									<?php foreach ($news as $news_item): ?>
									<tr>
										<td class="tb_1"><?=$news_item->id?></td>
										<td class="tb_9"><a href="<?=base_url()?>admin/page/news/<?=$news_item->id?>"><?=$news_item->title?></a></td>
										<!--<td><input type="checkbox" id="check_<?=$news_item->id?>" name="status_<?=$news_item->id?>" value="1" <?php if ($news_item->status== 1):?> checked <?php endif;?>/></td>-->
										<td class="tb_2"><!--<a href="<?=base_url()?>admin/edit_page.html?id=<?=$news_item->id?>&fast_edit=true&status="><i class="icon-save icon-2x"></i></a>--> <a href="<?=base_url()?>admin/delete_page/<?=$news_item->id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
									</tr>
									<?php endforeach ?>
								</form>
							</tbody>
						</table>
					</div>	

					<div id="left_col" class="col_6 back">
						<h6 class="col_8 left">Последние 5 записей в блоге</h6> 
												
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">id</th>
									<th class="tb_9">Имя</th>
									<!--<th>Статус</th>-->
									<th class="tb_2">Действие</th>
								</tr>
							</thead>
							<tbody id="sortable">
							
								<form id="form" method="get" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_page"/>
								
									<?php foreach ($blog as $blog_item): ?>
									<tr>
										<td class="tb_1"><?=$blog_item->id?></td>
										<td class="tb_9"><a href="<?=base_url()?>admin/page/blog/<?=$blog_item->id?>"><?=$blog_item->title?></a></td>
										<!--<td><input type="checkbox" id="check_<?=$blog_item->id?>" name="status_<?=$blog_item->id?>" value="1" <?php if ($blog_item->status== 1):?> checked <?php endif;?>/></td>-->
										<td class="tb_2"><!--<a href="<?=base_url()?>admin/edit_page.html?id=<?=$blog_item->id?>&fast_edit=true&status="><i class="icon-save icon-2x"></i></a>--> <a href="<?=base_url()?>admin/delete_page/<?=$blog_item->id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
									</tr>
									<?php endforeach ?>
								</form>
							</tbody>
						</table>
					</div>						
			</div>
		</div>
	</div>
	<? require 'footer.php' ?>
	</body>
</html>