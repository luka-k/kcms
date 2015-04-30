
	<aside id="s_left">
	<input type="hidden" name="filter" value="true"/>
	
	 <? if (empty($filters_checked)): ?>
				 <div id="shadow"></div>
				 <? endif ?>
	
		<h1><?if(empty($categories_ch)):?>
				<?if(!empty($manufacturer_ch)):?>
					<?=$manufacturer_ch[0]->name?>
				<?else:?>
					Все товары
				<?endif;?>
			<?else:?>
				<?=$categories_ch[0]->name?>
			<?endif;?>
			(<?=$total_rows ?>)
		</h1>
		<div class="leftmenu">
			<div class="lm-block">
				<div class="lm-caption">
					Группа товаров:
				</div>
				<div class="lm-item" prop="secondcolumn">
					<?if(empty($categories_ch)):?>
						Все товары
					<?else:?>
						<?=$categories_ch[0]->name?>
						<?if(count($categories_ch) > 1):?>
							, ... [<?= count($categories_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Производители:
				</div>
				<div class="lm-item" prop="secondcolumn2">
					<?if(empty($manufacturer_ch)):?>
						Все производители
					<?else:?>
						<?=$manufacturer_ch[0]->name?>
						<?if(count($manufacturer_ch) > 1):?>
							, ... [<?= count($manufacturer_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Коллекция/Серия:
				</div>
				<div class="lm-item" prop="secondcolumn3">
					<?if(empty($collection_ch)):?>
						Все коллекции
					<?else:?>
						<?=$collection_ch[0]?>
						<?if(count($collection_ch) > 1):?>
							, ... [<?= count($collection_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Артикулы:
				</div>
				<div class="lm-item" prop="secondcolumn4">
					<?if(empty($manufacturer_ch)):?>
						Все артикулы
					<?else:?>
						<?=$manufacturer_ch[0]->name?>
						<?if(count($manufacturer_ch) > 1):?>
							, ... [<?= count($manufacturer_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Название/Описание/Комплектация:
				</div>
				<div class="lm-item" prop="secondcolumn5">
					<?if(empty($name_ch)):?>
						Все названия
					<?else:?>
						<?=$name_ch[0]?>
						<?if(count($name_ch) > 1):?>
							, ... [<?= count($name_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Цвет:
				</div>
				<div class="lm-item" prop="secondcolumn6">
					<?if(empty($color_ch)):?>
						Все цвета
					<?else:?>
						<?=$color_ch[0]?>
						<?if(count($color_ch) > 1):?>
							, ... [<?= count($color_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Материал:
				</div>
				<div class="lm-item" prop="secondcolumn7">
					<?if(empty($material_ch)):?>
						Все материалы
					<?else:?>
						<?=$material_ch[0]?>
						<?if(count($material_ch) > 1):?>
							, ... [<?= count($material_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Отделка:
				</div>
				<div class="lm-item" prop="secondcolumn8">
					<?if(empty($finishing_ch)):?>
						Все варианты
					<?else:?>
						<?=$finishing_ch[0]?>
						<?if(count($finishing_ch) > 1):?>
							, ... [<?= count($finishing_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Разворот:
				</div>
				<div class="lm-item" prop="secondcolumn9">
					<?if(empty($turn_ch)):?>
						Все варианты
					<?else:?>
						<?=$turn_ch[0]?>
						<?if(count($turn_ch) > 1):?>
							, ... [<?= count($turn_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Размеры:
				</div> 
								
				<div class="range-input">
					<input type="text" readonly name="width_to" id="width-hi">
					<div class="caption">Ширина:</div>
					<input type="text" readonly name="width_from" id="width-low">
					<div style="clear: both;"></div>
					<div id="width-range" class="block-range"></div>
				</div>
											
				<div class="range-input">
					<input type="text" name="height_to" readonly id="height-hi">
					<div class="caption">Высота(h):</div>
					<input type="text" name="height_from" readonly id="height-low">
					<div style="clear: both;"></div>
					<div id="height-range" class="block-range"></div>
				</div>
										
				<div class="range-input">
					<input type="text" name="depth_to" readonly id="weight-hi">
					<div class="caption">Глубина:</div>
					<input type="text" name="depth_from" readonly id="weight-low">
					<div style="clear: both;"></div>
					<div id="weight-range" class="block-range"></div>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Цена:
				</div> 
											
				<div class="range-input">
					<input type="text" name="price_to" readonly id="price-hi">
					<div class="caption"> </div>
					<input type="text" name="price_from" readonly id="price-low">
					<div style="clear: both;"></div>
					<div id="price-range" class="block-range"></div>
				</div>
			</div>
			<div class="lm-block" style="margin-top:28px; padding-bottom:10px; text-align:center;">
				<a href="#" class="submit-btn" onclick="document.forms['filter-form'].submit()">Применить</a>
			</div>
		</div>
	</aside>

