<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_4 back">
						<h6>Страницы по разделам</h6>
						<div id="left-menu">
							<? require 'include/part_pages_tree.php' ?>
						</div>
					</div>
					
					<div id="right_col" class="col_8 back">
						<h6 class="col_8 left">Редактировать страницы</h6> 
						<div class="col_4 right">
							<a href="#new-page" class="button small lightbox">Создать новую</a>
							<div id="new-page">
								<div class="pop-up">	
									<form method="post" accept-charset="utf-8" enctype="multipart/form-data" id="form2" action="<?=base_url()?>admin/page/"/>
										<select id="select1" size="" name="url" class="col_12">
											<?php foreach ($parts as $part): ?>
												<option value="<?=$part->url?>"><?=$part->title?></option>
											<?php endforeach ?>
										</select>
										<a class="button small" href="#" onClick="document.forms['form2'].submit()">Создать новую</a>
									</form>
								</div>
							</div>
						</div>
												
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">id</th>
									<th class="tb_9">Имя</th>
									<th class="tb_2">Действие</th>
								</tr>
							</thead>
							<tbody <?if(isset($sortable)):?> id="sortable" <?endif?>>
							
								<form id="form" method="get" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_page"/>	
									<?if(isset($pages)):?>
										<?php foreach ($pages as $page): ?>
										<tr>
											<td class="tb_1"><?=$page->id?></td>
											<td class="tb_9"><a href="<?=base_url()?>admin/page/<?=$page->part_url?>/<?=$page->id?>"><?=$page->title?></a></td>
											<td class="tb_2"><a href="#delete_<?=$page->id?>" class="lightbox"><i class="icon-minus-sign icon-2x"></i></a></td>
											<div id="delete_<?=$page->id?>" style="display:none;">
												<div class="pop-up">
													<div>
														Вы точно уверены что хотите удалалить страницу <strong><?=$page->title?></strong>?
													</div><br/>
													<a href="<?=base_url()?>admin/delete_page/<?=$page->id?>" class="button small">Удалить?</a>
													<a href="#" class="button small" onclick="">Нет</a>
												</div>
											</div>
										</tr>
										<?php endforeach ?>
									<?endif;?>
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