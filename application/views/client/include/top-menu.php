<ul class="menu col_12">
	<?foreach ($menu as $item):?>
		<li <?if ($item[2] == 1):?> class="current"<?endif;?>><a href="<?=$item[1]?>"><?=$item[0]?></a></li>
	<?endforeach;?>
</ul>
<!--<ul class="menu col_12">
	<li>
		<a href="<?=base_url()?>">Главная</a>
	</li>
	<li>
		<a href="<?=base_url()?>news">Новости</a>
	</li>
	<li>
		<a href="<?=base_url()?>catalog">Каталог</a>
	</li>
	<li>
		<a href="<?=base_url()?>blog">Блог</a>
	</li>
</ul>-->