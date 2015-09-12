<?if(isset($content->menu)):?>
	<div class="tab-title col_12">Меню</div>
	<div class="col_12">
		<table class="tight">
			<thead>
				<tr>
					<th>Наименование</th>
					<th>Вес</th>
					<th>Цена</th>
					<th>Разрешено</th>
				</tr>
			</thead>
			<tbody>
				<?foreach($content->menu->categories as $menu_category):?>
					<tr>
						<td class="menu_type"><?=$menu_category->name?></td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<?if(!empty($menu_category->products)):?>
						<?foreach($menu_category->products as $menu_product):?>
							<tr>
								<td><?=$menu_product->name?></td>
								<td><?=$menu_product->weight?> г.</td>
								<td><?=$menu_product->price?> р</td>
								<td>
									<input type="checkbox" 
										   id="" 
										   name="child2products[]" 
										   value="<?=$menu_product->id?>" 
										   <?if(!in_array($menu_product->id, $content->disabled_products)):?>checked<?endif;?> />
								</td>
							</tr>
						<?endforeach;?>
					<?endif;?>
				<?endforeach;?>
			</tbody>
		</table>
	</div>
<?endif;?>