<ul class="navi clearfix">
	<?$count = 1?>
	<?foreach ($menu as $item):?>
		<li class="<?if ($item[2] == 1):?>active<?endif;?><?if ($count == 1):?> first<?elseif ($count == 6):?> last<?endif;?>"><a href="<?=$item[1]?>"><?=$item[0]?></a></li>
		<?$count++?>
	<?endforeach;?>
</ul>