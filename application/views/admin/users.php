<!DOCTYPE html>
<html>
	<? require 'head.php' ?>
	<body>
	<div id="page" class="grid flex">
		<div id="wrap" class="clearfix">	
			<? require 'include/top_menu.php' ?>
				<div  class="col_12 clearfix">
					<div id="right_col" class="col_12 back">
						<h6 class="col_8 left">Редактировать пользователей</h6> 
						<div class="col_4 right">
							<a href="<?=base_url()?>/admin/users/new" class="button small">Создать нового</a>
						</div>
												
						<table  id="sort" class="sortable" cellspacing="2" cellpadding="2" >
							<thead>
								<tr>
									<th class="tb_1">№</th>
									<th class="tb_9">Имя</th>
									<th class="tb_2">Действие</th>
								</tr>
							</thead>
							<tbody id="sortable">
							
								<form id="form" method="get" accept-charset="utf-8"  enctype="multipart/form-data" action="<?=base_url()?>admin/edit_user"/>
									<?$counter = 1?>
									<?php foreach ($users as $user): ?>
									<tr>
										<td class="tb_1"><?=$counter?></td>
										<td class="tb_9"><a href="<?=base_url()?>admin/users/<?=$user->id?>"><?=$user->name?></a></td>
										<td class="tb_2"><a href="<?=base_url()?>admin/delete_user/<?=$user->id?>"><i class="icon-minus-sign icon-2x"></i></a></td>
									</tr>
									<?$counter++?>
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