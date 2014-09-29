<nav>
	<ul>
		<?$menu_counter = 1?>
		<?foreach ($top_menu as $item):?>
			<li <?if ($menu_counter == 1):?> class="first" <?elseif ($menu_counter == 6):?> class="last" <?endif;?>>
				<a href="<?=$item[1]?>"><?=$item[0]?></a>
			</li>
			<?$menu_counter++?>
		<?endforeach;?>
	</ul>
</nav>