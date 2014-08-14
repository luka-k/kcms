<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_4 back">
						<h6>Страницы по категориям</h6>
						<div id="left-menu">
							<? require 'include/products_tree.php' ?>
						</div>
					</div>
					<div id="right_col" class="col_8 back">
						<h6 class="col_8 left">Редактировать страницы</h6> 
						<div class="col_4 right">
							<a href="<?=base_url()?>admin/product/" class="button small lightbox">Создать новую</a>
						</div>
												
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">id</th>
									<th class="tb_3">Фотография</th>
									<th class="tb_6">Имя</th>
									<th class="tb_2">Действие</th>
								</tr>
							</thead>
							<tbody id="sortable">
							
								<form id="form" method="get" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_product"/>
								
									<?php foreach ($pages as $page): ?>
									<tr>
										<td class="tb_1"><?=$page->id?></td>
										<td class="tb_3">
											<?if($page->img <> NULL):?>
												<a href="<?=base_url()?>admin/product/<?=$page->id?>"><img src="<?=base_url()?>download/images/catalog_small<?=$page->img->url?>" /></a>
											<?endif;?>
										</td>
										<td class="tb_6"><a href="<?=base_url()?>admin/product/<?=$page->id?>"><?=$page->title?></a></td>
										<td class="tb_2"><a href="#delete_<?=$page->id?>" class="lightbox"><i class="icon-minus-sign icon-2x"></i></a></td>
										<div id="delete_<?=$page->id?>" style="display:none;">
											<div class="pop-up">
												<div>
													Вы точно уверены что хотите удалалить товар <strong><?=$page->title?></strong>?
												</div><br/>
												<a href="<?=base_url()?>admin/delete_product/<?=$page->id?>" class="button small">Удалить?</a>
												<a href="#" class="button small" onclick="">Нет</a>
											</div>
										</div>
									</tr>
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