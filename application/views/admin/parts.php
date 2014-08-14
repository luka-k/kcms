<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="left_col" class="col_4 back">
						<h5>Разделы</h5>
						<div id="left-menu">
							<? require 'include/parts_tree.php' ?>
						</div>
					</div>
					<div id="right_col" class="col_8 back">
						<div class="col_12">
							<h5 class="col_8">Редактировать разделы</h5>			
						</div>
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">Номер</th>
									<th class="tb_9">Имя</th>
									<th class="tb_2">Действие</th>
								</tr>
							</thead>
							<tbody id="sortable">
								<?php foreach ($parts as $part): ?>
								<tr>
									<td class="tb_1"><?=$part->id?></td>
									<td class="tb_9"><a href="<?=base_url()?>admin/parts/<?=$part->id?>"><?=$part->title?></a></td>
									<td class="tb_2"><a href="<?=base_url()?>admin/delete_cat/<?=$part->id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
								</tr>
								<?php endforeach ?>
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