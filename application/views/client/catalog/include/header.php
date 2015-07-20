<header class="clearfix">
	<div class="maxw clearfix">
		<a href="/"><img class="logo" src="<?=base_url()?>/template/client/catalog/images/logo.png" /></a>
				
		<div class="catalog-btn">
			<a href="http://shop.brightbuild.ru/catalog/<?if(isset($shop_link)):?><?=$shop_link?><?endif;?>">
				Интернет магазин<?if(isset($shop_link_title)):?><?=$shop_link_title?><?endif;?>
			</a>
		</div><!--ru-->
				
		<div class="top-menu">
			<ul class="clearfix">
				<li class="<?if($top_active == 'catalog'):?>current<?endif;?>"><a href="<?=base_url()?>catalog"> Производители </a></li>
				<li class="<?if($top_active == 'vendors'):?>current<?endif;?>"><a href="<?=base_url()?>vendors"> Продавцы </a></li>
				<li class="<?if($top_active == 'contractors'):?>current<?endif;?>"><a href="<?=base_url()?>contractors"> Подрядчики </a></li>
				<li class="<?if($top_active == 'bb'):?>current<?endif;?>"><a href="<?=base_url()?>bb"> bрайтbилd </a></li>
				<li class="<?if($top_active == 'inventory'):?>current<?endif;?>"><a href="<?=base_url()?>inventory"> Складские остатки </a></li>
				<li class="<?if($top_active == 'contacts'):?>current<?endif;?>"><a href="<?=base_url()?>contacts"> Контакты </a></li>
				<li class="<?if($top_active == 'articles'):?>current<?endif;?> right"><a href="<?=base_url()?>articles/novosti/"> Новости </a></li>
			</ul>
		</div>
		<div class="right-contacts">
			<ul>
				<li class="phone">+7 (812) 633-04-20</li>
				<li class="phone">+7 (911) 831-10-25</li>
				<li><a href="mailto:info@brightbuild.ru" style="color: black;text-decoration: underline;">info@brightbuild.ru</a></li>
				<li class="right">&copy; Брайтбилд-2015</li>
			</ul>
		</div>
	</div>
</header>