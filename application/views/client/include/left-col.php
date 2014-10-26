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
					<input class="filtr-razmer-3 attributes" type="text" range="true" name="width" value="<?//=$filters['attributes_range']['width'][0]?>" onchange="filter()"/>
					<input class="filtr-razmer-3 attributes" type="text" range="true" name="width" sort="to" value="<?//=$filters['attributes_range']['width'][1]?>" onchange="filter()"/>
					<div class="filtr-razmer-1">высота(h):</div>	
					<input class="filtr-razmer-3 attributes" type="text" range="true" name="height" value="<?//=$filters['attributes_range']['height'][0]?>" onchange="filter()"/>
					<input class="filtr-razmer-3 attributes" type="text" range="true" name="height" value="<?//=$filters['attributes_range']['height'][1]?>" onchange="filter()"/>
					<div class="filtr-razmer-1">глубина:</div>
					<input class="filtr-razmer-3 attributes" type="text" range="true" name="depth" value="<?//=$filters['attributes_range']['depth'][0]?>" onchange="filter()"/>
					<input class="filtr-razmer-3 attributes" type="text" range="true" name="depth" value="<?//=$filters['attributes_range']['depth'][1]?>" onchange="filter()"/>
					<div class="filter-titl">Цвет:</div>
					<div class="help">i</div>
					<input class="input attributes" type="text" range="false" name="color" value="<?//=$filters['color']?>" onchange="filter()"/>
					<div class="filter-titl">Материал:</div>
					<div class="help">i</div>
					<input class="input attributes" type="text" range="false" name="material" value="<?//=$filters['material']?>" onchange="filter()"/>
					<div class="filter-titl">Отделка:</div>
					<div class="help">i</div>
					<input class="input attributes" type="text" range="false" name="finishing" value="<?//=$filters['finishing']?>" onchange="filter()"/>
					<div class="filter-titl">Разворот:</div>
					<div class="help">i</div>
					<input class="input attributes" type="text" range="false" name="turn" value="<?//=$filters['turn']?>" onchange="filter()"/>
				</form>	
			</div>
			</div>
		</div>
	</div>
</div><!-- .left-sidebar -->