<div id="menu" class="grid clearfix">
	<nav>
		<ul>
			<?foreach($top_menu as $item):?>
				<li><a href="<?=$item->full_url?>"><?=$item->name?></a></li>
			<?endforeach;?>
		</ul>
	</nav>
	<form action="/search/" id="searchform" method="get">
		<input type="text" id="search_input" name="q" class="search square" value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>" autocomplete="off" placeholder="Поиск по номеру или именованию" onkeyup="autocomp(this.value)"/>
		<a href="#" class="search-btn" onclick="document.forms['searchform'].submit(); return false;">&nbsp;</a>
	</form>
</div>