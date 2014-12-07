<div id="header">
	<div id="logo">
		<a href="<?=base_url()?>" alt=""/><img src="<?=base_url()?>template/client/img/logo.png" alt=""/></a>
	</div>
	<div id="register">
		<a href="http://register.lt-pro.ru"><img src="<?=base_url()?>template/client/img/register.png" alt=""/></a>
	</div>
				
	<? if (false && isset($_GET['testreg'])): ?>
		<div id="reg">
			<a href="">
				<div id="reg_img">
					<img src="<?=base_url()?>template/client/img/reg.png" alt=""/>
				</div>
				Регистрация
			</a>
		</div> 
	<? endif; ?>
				
	<div id="phone"><sup>(812)</sup> <span>244-54-88</span></div>
</div>