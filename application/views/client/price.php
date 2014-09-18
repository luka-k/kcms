<?require_once('include/head.php')?>    
<body>
	<script>
		var items = [<?foreach($calculator as $i=>$item):?><?= $i > 0 ? ',':''?>"<?=$item->title?>"<?endforeach;?>];
		var prices = [<?foreach($calculator as $i=>$item):?><?= $i > 0 ? ',':''?><?=$item->price?><?endforeach;?>];
	
		function calc()
		{
			var sum = 0;
			$('.select-calc').each(function( index ) {
				var itemsum = parseInt(parseInt($(this).val())*parseInt($(this).parent().children('.input-calc').val()));
				if (!isNaN(itemsum))
				{
					sum += itemsum;
					$(this).parent().children('.txt-calc').html(itemsum +' руб.');
				}
			});
			$('.qty').html(sum);
		}
	
		function add_item(){
			$(".add_block").before('<div class="calc-item clearfix">\
								<select class="select-calc" onchange="calc()">\
									<option class="grey">Выберите позицию</option>\
									<?foreach($calculator as $i=>$item):?><option value="<?= $item->price?>"><?= $item->title?></option><? endforeach ?> \
								</select>\
								<input type="text" onchange="calc()" onkeyup="calc()" class="input-calc" placeholder="введите метраж"/>\
								<div class="txt-calc"> 0 руб.</div>\
							</div>');
		}
		$(document).ready(function(){
			add_item(); 
		});
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
						
							<div class="clearfix add_block">
								<div style="float: left;width: 240px;margin-right: 20px;">
									<a href="#" class="add_item" onclick="add_item()">Добавить позицию</a>
								</div>
								<div style="float: left;width: 240px;height: 30px;margin-right: 20px;"></div>
								<a href="#" onclick="calc(); return false;" class="btn">Оформить заявку</a>
							</div>
						</div>
					</div>
					<div class="itogo">
						ИТОГО: <span class="blue"><span class="qty">0</span> руб.</span>
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
						<?$count = 1?>
						<?foreach($calculator as $item):?>
							<tr <?if(fmod($count, 2) == 0):?>class="grey"<?endif;?>>
								<td class="col_1">
									<?=$item->title?>
								</td>
								<td class="col_2">
									<?=$item->price?> руб.
								</td>
							</tr>
							<?$count++?>
						<?endforeach;?>						
					</table>
				</div>
            </div>
        </div>
    </section>
<?require_once('include/footer.php')?>   