<div class="scroll-contentd" id="leftscroll" style="height: 410px;">
	<div id="filter" class="clearfix scroll-content"  style="height: 400px;overflow-y: hidden;">
	
		<div class="clearfix" style="margin-top:10px">
			<div id="filt-4" class="filtr-noact" <?if($cart):?><?endif;?> onclick="return false">Корзина</div>
			<div style="width:100%; clear:both;" class="clearfix">
				<div>В корзине: <span class="total_qty"><?=$total_qty?></span> <?=$product_word?></div>
				<div>На сумму: <span class="total_price"><?=$total_price?></span> руб.</div>
			<div>
		</div>
		
		<div class="clearfix" style="margin-top:10px">
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
								
		<div class="clearfix" style="margin-top:10px">
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
		<div class="clearfix" style="margin-top:10px">
			<div class="help">i
				<div class="popup-help">
					Окно с подсказкой
				</div>
			</div>
			<div id="filt-3" class="filtr-noact" onclick="return false">Характеристики:</div>
		</div>
	</div>
</div><!-- .left-sidebar -->