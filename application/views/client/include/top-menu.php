<ul class="menu col_12">
	<?foreach ($menu as $item):?>
		<li <?if ($item[2] == 1):?> class="current"<?endif;?>><a href="<?=$item[1]?>"><?=$item[0]?></a></li>
	<?endforeach;?>
</ul>