<div class="scroll-contentd" id="leftscroll" style="height: 410px;">
	<div id="filter" class="clearfix scroll-content"  style="height: 400px;overflow-y: hidden;">
		<div class="clearfix">
			<div class="filter-titl">Группа товаров:</div>
			<div class="help">i
				<div class="popup-help">
					Окно с подсказкой
				</div>
			</div>
									
			<div id="filt-1" class="filtr-noact" onclick="return false">
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
								
		<div class="clearfix" style="margin-top:40px">
			<div class="filter-titl">Производитель:</div>
			<div class="help">i
				<div class="popup-help">
					Окно с подсказкой
				</div>
			</div>
							
			<div id="filt-2" class="filtr-noact" onclick="return false">Kludi</div>
									
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
		<div class="clearfix" style="margin-top:40px">
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
		<div class="clearfix" style="margin-top:40px">
			<div id="filt-3" class="filtr-noact" onclick="return false">Характеристики:</div>
			<div class="help">i
				<div class="popup-help">
					Окно с подсказкой
				</div>
			</div>
		</div>
	</div>
</div><!-- .left-sidebar -->