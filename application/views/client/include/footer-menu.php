<nav>
	<ul>
		<?$menu_counter = 1?>
		<?foreach ($footer_menu as $item):?>
			<li <?if ($menu_counter == 8):?> class="last" <?endif;?>>
				<a href="<?=$item[1]?>"><?=$item[0]?></a>
			</li>
			<?$menu_counter++?>
		<?endforeach;?>
	</ul>
</nav>