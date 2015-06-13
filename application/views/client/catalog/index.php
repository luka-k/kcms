<!DOCTYPE html>
<html>
	<?require_once 'include/head.php'?>	
	<body>
		<!-------------------header--------------------->
		<? require 'include/header.php'?>
		<!-----------------end_header-------------------->
		
		<div id="wrapper clearfix">
			<div class="section maxw clearfix">
				<div class="mainwrap">
					<main id="main_page">
						<article>
							
							<div id="" class="main-content clearfix">

								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									<div class="main_description">
										<?=$settings->site_description?>
									</div>
									<div class="manufacturer">
										<?foreach($manufacturers as $m):?>
											<div class="manufacturer-item">
												<a href=""><img src="<?=$m->img->catalog_mid_url?>" alt="pic"/></a>
											</div>
										<?endforeach;?>
									</div>
								</div>
								
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1>Все товары</h1>
					<div id="scroll-left" class="leftmenu">
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic1.png" alt=""></span>
								<span class="menu-text">Ванная комната</span>
							</a> 
							<ul class="sub-menu"> 
								<li><a href="#1">аксессуары для ванной</a></li> 
								<li><a href="#2">бассейны (мини)</a></li> 
								<li><a href="#3">ванны</a></li> 
								<li><a href="#4">ванны для детей</a></li> 
								<li><a href="#5">ванны для ног</a></li> 
								<li><a href="#6">водопроводная арматура</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic2.png" alt=""></span>
								<span class="menu-text">Двери/Перегородки/Окна</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic3.png" alt=""></span>
								<span class="menu-text">Зеркала</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic4.png" alt=""></span>
								<span class="menu-text">Кухня</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic5.png" alt=""></span>
								<span class="menu-text">Лестницы</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>	
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic6.png" alt=""></span>
								<span class="menu-text">Мебель</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#"class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic7.png" alt=""></span>
								<span class="menu-text">Плитка</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic9.png" alt=""></span>
								<span class="menu-text">Полы</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic10.png" alt=""></span>
								<span class="menu-text">Свет/Электрика</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic11.png" alt=""></span>
								<span class="menu-text">Стекло</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li> 
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic12.png" alt=""></span>
								<span class="menu-text">Стены/потолки</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic13.png" alt=""></span>
								<span class="menu-text">Столярные изделия</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic14.png" alt=""></span>
								<span class="menu-text">Текстиль интерьерный</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
						
						<div class="div">
							<a href="#" class="main-item" onclick="return false;">
								<span class="menu-pic"><img src="images/left-menu/left-pic15.png" alt=""></span>
								<span class="menu-text">Элементы интерьера</span>
							</a>
							<ul class="sub-menu">
								<li><a href="#1">подпункт 1</a></li>
								<li><a href="#2">подпункт 2</a></li>
								<li><a href="#3">подпункт 3</a></li>
							</ul>
						</div>
					</div>
				</aside><!--end_leftcol-->
                   
				<!-----rightcol----->
                <aside id="s_right">
					<h1>Новости</h1>
					<div id="scroll-right" class="rightmenu">
						<?foreach($last_news as $item):?>
							<div class="news_item">
								<h2><?=$item->name?></h2>
								<div class="item_text"><?=$item->description?></div>
							</div>
						<?endforeach;?>
					</div>
				</aside><!--end_rightcol-->
			</div>
		</div>
	</body>
</html>