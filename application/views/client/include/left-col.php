<div class="scroll-contentd" id="leftscroll" style="height: 550px;">
	<div id="filter" class="clearfix scroll-content"  style="height: 500px; overflow-y: hidden;">
		
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
			<input type="hidden" name="filter" value="true"/>
			<div class="clearfix" style="margin-top:3px;">
				<div class="filter-titl">Производитель:</div>
				<div class="help">i
					<div class="popup-help">
						Окно с подсказкой
					</div>
				</div>
							
				<div id="filt-2" class="filtr-noact" onclick="menu(2)">
					<?if(empty($manufacturer_ch)):?>
						Все производители
					<?else:?>
						<?=$manufacturer_ch[0]->name?>
						<?if(count($manufacturer_ch) > 1):?>
							<div class="count">
								<?=count($manufacturer_ch)?>
								<div class="popup-count">
									<ul>
										<?foreach($manufacturer_ch as $item):?>
											<li><?=$item->name?></li>
										<?endforeach;?>
									</ul>
								</div>
							</div>
						<?endif;?>
					<?endif;?>
				</div>
				
				<div class="filter-titl">Колекция/Серия:</div>
				<div class="help">i
					<div class="popup-help">
						Окно с подсказкой
					</div>
				</div>
				
				<input class="input" type="text" name="collection" value="<?if(isset($filters['collection'])):?><?=$filters['collection']?><?endif;?>"/>
				
				<div class="filter-titl">Артикул/Модель:</div>
				<div class="help">i
					<div class="popup-help">
						Окно с подсказкой
					</div>
				</div>
				
				<input class="input" type="text" name="article" value="<?if(isset($filters['article'])):?><?=$filters['article']?><?endif;?>"/>
			</div>
			
			<div class="clearfix" style="margin-top:3px">
				<div class="filter-titl">Название товара:</div>
				<div class="help">i
					<div class="popup-help">
						Окно с подсказкой
					</div>
				</div>
				<input class="input" type="text" name="name" value="<?if(isset($filters['name'])):?><?=$filters['name']?><?endif;?>"/>
				<div class="filter-titl">Описание товара:</div>
				<div class="help">i
					<div class="popup-help">
						Окно с подсказкой
					</div>
				</div>
				<input class="input" type="text" name="description" value="<?if(isset($filters['description'])):?><?=$filters['description']?><?endif;?>"/>
			</div>
			<div class="clearfix" style="margin-top:3px;">
				<div class="clearfix">
				<div class="help">i
					<div class="popup-help">
						Окно с подсказкой
					</div>
				</div>
				<div class="filter-titl">Характеристики:</div>
				</div>
				<div class="clearfix">

					<div class="filter">	
						<div class="filtr-razmer-1">Размеры(мм):</div>
						<div class="filtr-razmer-2">от:</div>	
						<div class="filtr-razmer-2">до:</div>
						<div class="filtr-razmer-1">ширина:</div>
						<input class="filtr-razmer-3 attributes" type="text" name="width_from" value="<?if(isset($filters['width_from'])):?><?=$filters['width_from']?><?endif;?>" onchange="--filter()"/>
						<input class="filtr-razmer-3 attributes" type="text" name="width_to" value="<?if(isset($filters['width_to'])):?><?=$filters['width_to']?><?endif;?>" onchange="--filter()"/>
						<div class="filtr-razmer-1">высота(h):</div>	
						<input class="filtr-razmer-3 attributes" type="text" name="height_from" value="<?if(isset($filters['height_from'])):?><?=$filters['height_from']?><?endif;?>" onchange="filter()"/>
						<input class="filtr-razmer-3 attributes" type="text" name="height_to" value="<?if(isset($filters['height_to'])):?><?=$filters['height_to']?><?endif;?>" onchange="--filter()"/>
						<div class="filtr-razmer-1">глубина:</div>
						<input class="filtr-razmer-3 attributes" type="text" name="depth_from" value="<?if(isset($filters['depth_from'])):?><?=$filters['depth_from']?><?endif;?>" onchange="--filter()"/>
						<input class="filtr-razmer-3 attributes" type="text" name="depth_to" value="<?if(isset($filters['depth_to'])):?><?=$filters['depth_to']?><?endif;?>" onchange="--filter()"/>
						<div class="filter-titl">Цвет:</div>
						<div class="help">i</div>
						<input class="input attributes" type="text" range="false" name="color" value="<?if(isset($filters['color'])):?><?=$filters['color']?><?endif;?>" onchange="--filter()"/>
						<div class="filter-titl">Материал:</div>
						<div class="help">i</div>
						<input class="input attributes" type="text" range="false" name="material" value="<?if(isset($filters['material'])):?><?=$filters['material']?><?endif;?>" onchange="--filter()"/>
						<div class="filter-titl">Отделка:</div>
						<div class="help">i</div>
						<input class="input attributes" type="text" range="false" name="finishing" value="<?if(isset($filters['finishing'])):?><?=$filters['finishing']?><?endif;?>" onchange="--filter()"/>
						<div class="filter-titl">Разворот:</div>
						<div class="help">i</div>
						<input class="input attributes" type="text" range="false" name="turn" value="<?if(isset($filters['turn'])):?><?=$filters['turn']?><?endif;?>" onchange="--filter()"/>
					</div>
				</div>
			</div>
			<div class="clearfix" style="margin-top:8px; padding-bottom:10px; text-align:center;">
				<a href="#" class="submit-btn" onclick="document.forms['filter-form'].submit()">Применить</a>
			</div>

	</div>
	
</div><!-- .left-sidebar -->