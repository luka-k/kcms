<div class="scroll-contentd" id="leftscroll" style="height: 410px;">
	<div id="filter" class="clearfix scroll-content"  style="height: 400px;overflow-y: hidden;">
		
		<div class="clearfix" >
			<div class="filter-titl">Группа товаров:</div>
			<div class="help">i
				<div class="popup-help">
					Окно с подсказкой
				</div>
			</div>
									
			<div id="filt-1" class="filtr-noact <?if($left_active == "filt-1"):?>filtr-act<?endif;?>" onclick="menu(1)">
				<?if(empty($categories_ch)):?>
					Все товары
				<?else:?>
					<?=$categories_ch[0]->name?>
					<?if(count($categories_ch) > 1):?>
						<div class="count">
							<?=count($categories_ch)?>
							<div class="popup-count">
								<ul>
									<?foreach($categories_ch as $item):?>
										<li><?=$item->name?></li>
									<?endforeach;?>
								</ul>
							</div>
						</div>
					<?endif;?>
				<?endif;?>
			</div>
		</div>
								
		<div class="clearfix" style="margin-top:5px">
			<div class="filter-titl">Производитель:</div>
			<div class="help">i
				<div class="popup-help">
					Окно с подсказкой
				</div>
			</div>
							
			<div id="filt-2" class="filtr-noact" onclick="menu(2)">Kludi</div>
									
			<div class="filter-titl">Колекция/Серия:</div>
			<div class="help">i
				<div class="popup-help">
				Окно с подсказкой
				</div>
			</div>
			<div id="filt-2" class="filtr-noact" onclick="return false">balance</div>
				<input class="input" type="text" name="" />
				<div class="filter-titl">Артикул/Модель:</div>
				<div class="help">i
					<div class="popup-help">
						Окно с подсказкой
					</div>
				</div>
				<input class="input" type="text" name="" />
		</div>
		<div class="clearfix" style="margin-top:10px">
			<div class="filter-titl">Название товара:</div>
			<div class="help">i
				<div class="popup-help">
					Окно с подсказкой
				</div>
			</div>
			<div id="filt-2" class="filtr-noact" onclick="return false">Kludi Balance 2532255<div class="count">2</div></div>
			<div class="filter-titl">Описание товара:</div>
			<div class="help">i
				<div class="popup-help">
					Окно с подсказкой
				</div>
			</div>
			<div id="filt-2" class="filtr-noact" onclick="return false">Сместиель для раковины</div>
		</div>
		<div class="clearfix" style="margin-top:5px">
			<div class="help">i
				<div class="popup-help">
					Окно с подсказкой
				</div>
			</div>
			<div class="filter-titl">Характеристики:</div>
			<div class="clearfix">

			<div class="filter">	
				<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="filter-form-2" class="filter-form-2" action="" >
					<div class="filtr-razmer-1">Размеры(мм):</div>
					<div class="filtr-razmer-2">от:</div>	
					<div class="filtr-razmer-2">до:</div>
					<div class="filtr-razmer-1">ширина:</div>
					<input class="filtr-razmer-3 filter-input" type="text" name="width_from" value="<?=$filters['width_from']?>" onchange="filter()"/>
					<input class="filtr-razmer-3 filter-input" type="text" name="width_to" value="<?=$filters['width_to']?>" onchange="filter()"/>
					<div class="filtr-razmer-1">высота(h):</div>	
					<input class="filtr-razmer-3 filter-input" type="text" name="height_from" value="<?=$filters['height_from']?>" onchange="filter()"/>
					<input class="filtr-razmer-3 filter-input" type="text" name="height_to" value="<?=$filters['height_to']?>" onchange="filter()"/>
					<div class="filtr-razmer-1">глубина:</div>
					<input class="filtr-razmer-3 filter-input" type="text" name="depth_from" value="<?=$filters['depth_from']?>" onchange="filter()"/>
					<input class="filtr-razmer-3 filter-input" type="text" name="depth_to" value="<?=$filters['depth_to']?>" onchange="filter()"/>
					<div class="filter-titl">Цвет:</div>
					<div class="help">i</div>
					<input class="input filter-input" type="text" name="color" value="<?=$filters['color']?>" onchange="filter()"/>
					<div class="filter-titl">Материал:</div>
					<div class="help">i</div>
					<input class="input filter-input" type="text" name="material" value="<?=$filters['material']?>" onchange="filter()"/>
					<div class="filter-titl">Отделка:</div>
					<div class="help">i</div>
					<input class="input filter-input" type="text" name="finishing" value="<?=$filters['finishing']?>" onchange="filter()"/>
					<div class="filter-titl">Разворот:</div>
					<div class="help">i</div>
					<input class="input filter-input" type="text" name="turn" value="<?=$filters['turn']?>" onchange="filter()"/>
				</form>	
			</div>
			</div>
		</div>
	</div>
</div><!-- .left-sidebar -->