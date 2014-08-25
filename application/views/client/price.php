<?require_once('include/head.php')?>    
<body>

<script>
	function add_item(){
		$(".add_item").before('<div class="calc-item clearfix"><select class="select-calc"><option>Пункт 1</option><option>Пункт 2</option></select><input type="text" class="input-calc" placeholder=""/><div class="txt-calc"> 20000 руб.</div></div>');
	}
</script>
    <!-- HEADER & LOGO -->
    <header>
        <div class="header-top">
            <div class="wrap">
                <div class="content">
                    <div class="logo">
                        <a href="<?=base_url()?>main"><img src="<?=base_url()?>template/client/images/logo.png" alt="" /></a>
                    </div>
                    <div class="phone">
                        <span class="ph"><span class="ph-style">+7(921)</span>123 45 67</span>
                    </div>
					<div class="search">
						<input type="text" name="search" />
					</div>
                    <div class="order-phone">
                        <a href="#callrequest" class="btn js-callback callback-phone fancybox">Заказать звонок</a>
                    </div>
                </div>
            </div>
        </div>
	
        <div class="nav-bg"></div>
        <div class="nav">
            <div class="wrap-2">
				<?require_once('include/top-menu.php')?>   
            </div>
        </div>
	</header>
	
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
						
							<!--<div class="clearfix">
								<select class="select-calc">
									<option>Пункт 1</option>
									<option>Пункт 2</option>
								</select>
								<input type="text" class="input-calc" placeholder=""/>
								<a href="#" class="btn">Рассчитать</a>
							</div>-->
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