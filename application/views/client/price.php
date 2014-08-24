<?require_once('include/head.php')?>    
<body>

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
							<div class="clearfix">
								<select class="select-calc">
									<option>Пункт 1</option>
									<option>Пункт 2</option>
								</select>
								<input type="text" class="input-calc" placeholder=""/>
								<div class="txt-calc"> 20000 руб.</div>
							</div>

							<div class="clearfix">
								<select class="select-calc">
									<option>Пункт 1</option>
									<option>Пункт 2</option>
								</select>
								<input type="text" class="input-calc" placeholder=""/>
								<div class="txt-calc"> 20000 руб.</div>
							</div>
						
							<div class="clearfix">
								<select class="select-calc">
									<option>Пункт 1</option>
									<option>Пункт 2</option>
								</select>
								<input type="text" class="input-calc" placeholder=""/>
								<a href="#" class="btn">Рассчитать</a>
							</div>
							<div>
								<a href="#" class="add_item">Добавить позицию</a>
							</div>
						</div>
					</div>
					<div class="itogo">
						ИТОГО: <span class="blue"><span class="qty">20000</span> руб.</span>
					</div>
					<div class="usluga-item clearfix">
						<div class="left-col">
							<img src="<?=base_url()?>template/client/images/partneri.png" alt=""/>
						</div>
						<div class="right-col">
							<div class="usluga-title">
								Обшивка вагонкой
							</div>
							<div class="usluga-text">
								Небольшое описание позиции. Так же, как квартира, дом или любое другое строение, гараж нуждается в качественном и своевременном ремонте. Для заядлых автомобилистов гараж является вторым домом, где можно посвятить время ремонту и тюнингу. Небольшое описание позиции. Так же, как квартира, дом или любое другое строение, гараж нуждается в качественном и своевременном ремонте. 
							</div>
						</div>
					</div>
					<div class="usluga-item clearfix" style="border:none;">
						<div class="left-col">
							<img src="<?=base_url()?>template/client/images/partneri.png" alt=""/>
						</div>
						<div class="right-col">
							<div class="usluga-title">
								Обшивка вагонкой
							</div>
							<div class="usluga-text">
								Небольшое описание позиции. Так же, как квартира, дом или любое другое строение, гараж нуждается в качественном и своевременном ремонте. Для заядлых автомобилистов гараж является вторым домом, где можно посвятить время ремонту и тюнингу. Небольшое описание позиции. Так же, как квартира, дом или любое другое строение, гараж нуждается в качественном и своевременном ремонте. 
							</div>
						</div>
					</div>
					<table>
						<tr>
							<td class="col_1">
								Наименование услуги
							</td>
							<td class="col_2">
								20000-30000 руб.
							</td>
						</tr>
						<tr class="grey">
							<td class="col_1">
								Наименование услуги
							</td>
							<td class="col_2">
								20000-30000 руб.
							</td>
						</tr>						
					</table>
				</div>
            </div>
        </div>
    </section>
<?require_once('include/footer.php')?>   