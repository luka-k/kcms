<aside id="s_left">
	<h1><?if(isset($total_rows)):?>
			<?if(empty($categories_ch)):?>
				<?if(!empty($manufacturer_ch)):?>
					<?=$manufacturer_ch[0]?>
				<?else:?>
					Все товары
				<?endif;?>
			<?else:?>
				<?if(!empty($parent_ch)):?>
					<?=$parent_ch[0]?>
				<?else:?>
					<?=$categories_ch[0]?>
				<?endif;?>
			<?endif;?>(<?=$total_rows ?>)
		<?else:?>
			<?=$title?><?if(isset($search)):?> (<?=$total_rows?>)<?endif;?>
		<?endif;?>
	</h1>

	<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form" class="filter-form" action="<?=base_url()?>catalog/" >
	<?require_once "columns.php"?>
	<div class="leftmenu shop">
		<div class="lm-block">

			<input type="text" 
				id="search_input" 
				class="search" 
				name="name" 
				autocomplete="off"
				placeholder="Поиск" 
				value="<?if(isset($search)):?><?=$search?><?endif;?><?if(isset($filters['name'])):?><?=$filters['name']?><?endif;?>" 
				onkeypress="autocomp()"
				onfocus="search_focus()"
				onblur="search_blur()"/>
				<!--onchange="document.forms['filter-form'].submit()"/>-->
						
		</div>
		
			<input type="hidden" name="filter" value="true"/>
			<input type="hidden" id="last_type_filter" name="last_type_filter" value=""/>
			<input type="hidden" id="ajax_from" class="ajax_from" name="from" value="10"/>
			<input type="hidden" id="sorting_order" name="order" value="name"/>
			<input type="hidden" id="sorting_direction" name="direction" value="asc"/>

			<div class="lm-block">
				<div class="lm-caption">
					Группа товаров:
				</div>
				<div class="lm-item" prop="secondcolumn">
					<?if(empty($categories_ch)):?>
						Все товары
					<?else:?>
						<span class="lm-title"><?=$categories_ch[0]?></span>
						<?if(count($categories_ch) > 1):?>
							[<?= count($categories_ch)?>]
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
						<span class="lm-title">Все производители</span>
					<?else:?>
						<?=$manufacturer_ch[0]?>
						<?if(count($manufacturer_ch) > 1):?>
							[<?= count($manufacturer_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Коллекция/Серия:
				</div>
				<div class="lm-item" prop="secondcolumn3">
					<?if(empty($collections_ch)):?>
						Все коллекции
					<?else:?>
						<span class="lm-title"><?=$collections_ch[0]?></span>
						<?if(count($collections_ch) > 1):?>
							[<?= count($collections_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Артикулы:
				</div>
				<div class="lm-item" prop="secondcolumn4">
					<?if(empty($sku_ch)):?>
						<span class="lm-title">Все артикулы</span>
					<?else:?>
						<?=$sku_ch[0]?>
						<?if(count($sku_ch) > 1):?>
							[<?= count($sku_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Название/Описание/Комплектация:
				</div>
				<div class="lm-item" prop="secondcolumn5">
					<?if(!empty($shortname_ch)):?>
						<span class="lm-title"><?=$shortname_ch[0]?></span>
						<?if(count($shortname_ch) > 1):?>
							[<?= count($shortname_ch)?>]
						<?endif;?>
					<?elseif(!empty($shortdesc_ch)):?>
						<span class="lm-title"><?=$shortdesc_ch[0]?></span>
						<?if(count($shortdesc_ch) > 1):?>
							[<?= count($shortdesc_ch)?>]
						<?endif;?>	
					<?else:?>
						Все названия
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
						<span class="lm-title"><?=$color_ch[0]?></span>
						<?if(count($color_ch) > 1):?>
							[<?= count($color_ch)?>]
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
						<span class="lm-title"><?=$material_ch[0]?></span>
						<?if(count($material_ch) > 1):?>
							[<?= count($material_ch)?>]
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
						<span class="lm-title"><?=$finishing_ch[0]?></span>
						<?if(count($finishing_ch) > 1):?>
							[<?= count($finishing_ch)?>]
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
						<span class="lm-title"><?=$turn_ch[0]?></span>
						<?if(count($turn_ch) > 1):?>
							[<?= count($turn_ch)?>]
						<?endif;?>
					<?endif;?>
				</div>
			</div>
			
			<div class="lm-block">
				<div class="lm-caption">
					Размеры:
					<div style="float: right;font-weight: bold;color: red;padding: 0px 5px; margin-right: 7px;cursor: pointer;" onmouseover="$('#whd').show();" onmouseout="$('#whd').hide();">i</div>
				</div> 
				<div style="position: absolute;left: 170px;top: 305px;z-index: 10000;display: none;" id="whd" ><img src="/template/client/images/whd.png" /></div>
								
				<div class="range-input">
					<input type="text" readonly name="" id="width-hi">
					<div class="caption">Ширина:</div>
					<input type="text" readonly name="" id="width-low">
					<div style="clear: both;"></div>
					<div id="width-range" class="block-range"></div>
				</div>
											
				<div class="range-input">
					<input type="text" name="" readonly id="height-hi">
					<div class="caption">Высота(h):</div>
					<input type="text" name="" readonly id="height-low">
					<div style="clear: both;"></div>
					<div id="height-range" class="block-range"></div>
				</div>
										
				<div class="range-input">
					<input type="text" name="" readonly id="weight-hi">
					<div class="caption">Глубина:</div>
					<input type="text" name="" readonly id="weight-low">
					<div style="clear: both;"></div>
					<div id="weight-range" class="block-range"></div>
				</div>
			</div>
			<div class="lm-block">
				<div class="lm-caption">
					Цена:
				</div> 
											
				<div class="range-input">
					<input type="text" name="" readonly id="price-hi">
					<div class="caption"> </div>
					<input type="text" name="" readonly id="price-low">
					<div style="clear: both;"></div>
					<div id="price-range" class="block-range"></div>
				</div>
			</div>
			<div class="lm-block" style="margin-top:28px; padding-bottom:10px; text-align:center;">
				<a href="/catalog" class="submit-btn" >Сбросить</a> &nbsp;&nbsp;
				<a href="#" class="submit-btn" onclick="document.forms['filter-form'].submit()">Применить</a>
			</div>
		</div>
	</form>
</aside>

