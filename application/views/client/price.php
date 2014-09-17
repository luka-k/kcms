<?require_once('include/head.php')?>    
<body>
	<script>
		function add_item(){
			$(".add_item").before('<div class="calc-item clearfix"><select class="select-calc"><option>Пункт 1</option><option>Пункт 2</option></select><input type="text" class="input-calc" placeholder=""/><div class="txt-calc"> 20000 руб.</div></div>');
		}
	</script>
	<?require_once('include/header.php')?> 
    <section>
        <div class="services clearfix">
            <div class="wrap">
				<div class="content">
					<div class="title">Услуги и цены</div>
					<div class="clearfix">
						<div class="left-col">
							<div class="calc-title">Калькулятор ремонта</div>
						</div>
						<div class="right-col clearfix">
							<div class="calc-item clearfix">
								<select class="select-calc">
									<option>Пункт 1</option>
									<option>Пункт 2</option>
								</select>
								<input type="text" class="input-calc" placeholder=""/>
								<div class="txt-calc"> 20000 руб.</div>
							</div>
						
							<div class="clearfix">
								<select class="select-calc">
									<option class="grey">Выберите позицию</option>
									<option>Пункт 1</option>
									<option>Пункт 2</option>
								</select>
								<input type="text" class="input-calc" placeholder="введите метраж"/>
								<a href="#" class="btn">Рассчитать</a>
							</div>
							<div>
								<a href="#" class="add_item" onclick="add_item()">Добавить позицию</a>
							</div>
						</div>
					</div>
					<div class="itogo">
						ИТОГО: <span class="blue"><span class="qty">20000</span> руб.</span>
					</div>
					<?foreach($calculator as $item):?>
						<div class="usluga-item clearfix">
							<div class="left-col">
								<?if($item->img <> NULL):?>
									<img src="<?=base_url()?>download/images/catalog_mid/<?=$item->img->url?>" alt=""/>
								<?else:?>
									&nbsp;
								<?endif;?>
							</div>
							<div class="right-col">
								<div class="usluga-title">
									<?=$item->title?>
								</div>
								<div class="usluga-text">
									<?=$item->description?>
								</div>
							</div>
						</div>
					<?endforeach;?>
					<table>
						<?$counter = 1?>
						<?foreach($calculator as $item):?>
							<tr <?if(($counter % 2) == 0):?>class="grey"<?endif;?>>
								<td class="col_1">
									<?=$item->title?>
								</td>
								<td class="col_2">
									<?=$item->price?> руб.
								</td>
							</tr>
							<?$counter++?>
						<?endforeach;?>						
					</table>
				</div>
            </div>
        </div>
    </section>
<?require_once('include/index-script.php')?>
<?require_once('include/footer.php')?>   