
				<div id="social" class="grid clearfix">
					<div class="podlogka clearfix">
						<div class="soc-seti col_5">
							<div class="pod-text">Следите за нами в соцсетях</div> 	
							<button class="soc vk square">&nbsp;</button>
							<button class="soc facebook square">&nbsp;</button>
							<button class="soc twitter square">&nbsp;</button>
						</div>
						<div class="podpiska col_7">
							<form action="#" class="form subscribe_form" id="subscribe_form" method="post">
								<div class="pod-text">Подписка на новости</div> 
								<input id="subscribe_input" type="text" class="validate square" placeholder="Ваш e-mail"/>
								<button class="red-btn square" onclick="subscribe(); return false;">Подписаться</button>
							</form>
						</div>
					</div>
				</div>
				
				<script>
					function subscribe(){
						var data = {};
						if (validation($("#subscribe_form"), 'error')) return false;
						console.log($("#subscribe_input").val());
						data.email = $("#subscribe_input").val();
						var json_str = JSON.stringify(data);
	
						$.post ("/ajax/subscribe/", json_str, function showAnswer(res) { 
						
							$.fancybox('<div class="result" style="text-align:center; margin-top:40px;"><p>'+res.answer+'</p></div>', {
								autoSize: false,
								autoHeight: false,
								autoWidth: false,
								autoResize: false,
								width: 400,
								height: 100
							});
		
							setTimeout(function () {
								$.fancybox.close();
							}, 3000);
						}   , "json");
					}
					
				</script>
				<div id="footer" class="grid clearfix">
					<div class="footer-top clearfix">
						<div class="footer-menu col_6">
							<ul class="col_4">
								<li class="titl"><a href="">О нас</a>
								<li><a href="">Наша миссия</a></li>
								<li><a href="">Наша история</a></li>
								<li><a href="">Наши вакансии</a></li>
							</ul>
							<ul class="col_4">
								<li class="titl"><a href="">Доставка</a></li>
								<li><a href="">Самовывоз</a></li>
								<li><a href="">По городу</a></li>
								<li><a href="">Регионы</a></li>
							</ul>
							<ul class="col_4">
								<li class="titl"><a href="">Важно</a></li>
								<li><a href="">Новинки</a></li>
								<li><a href="">Акции</a></li>
							</ul>
						</div>
						<div class="col_3">
							&nbsp;
						</div>
						<div class="contact col_3">
							<div class="town">Санкт-Петербург</div>
							<div class="phone"><span class="phone-code">8(800)</span>700-56-47</div>
							<div class="email">info@autocummins.ru</div>
						</div>
					</div>
				</div>
				<div class="copyright grid">
					&copy; AutoCummins.ru, 2014 
				</div>
			</div>
		</div>
		
		<script>
var aside = document.getElementById('cart-top');
    t0 = aside.getBoundingClientRect().top - document.documentElement.getBoundingClientRect().top; // отступ от верхнего края окна браузера до элемента
    // window.pageYOffset - прокрутка веб-документа
window.addEventListener('scroll', function(e) {
  aside.className = (t0 < window.pageYOffset ? 'cart-top col_4' : 'cart col_4');
}, false);
</script>
	</body>
</html>