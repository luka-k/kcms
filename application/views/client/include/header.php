<header>
    <div id="search">
		<input type="text" name="search" value="Search..."/>
	</div>
	
	<?require_once 'top-menu.php'?>
	 
	<div id="logo">
		<a href="<?=base_url()?>"><img src="<?=base_url()?>template/client/images/logo.png"></a>
		<div id="slogan">
			custom miniatures and bits</br>
			for gamers and collectors			
		</div>
	</div>
	
	<div id="slider" class="slider_wrap">
		<?foreach($slider as $item):?>
			<a href="<?=$item->link?>"><img src="<?=$item->img->url?>" alt="" /></a>
		<?endforeach;?>
	</div>
</header>