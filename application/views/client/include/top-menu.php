<ul class="menu col_12">
	<?foreach ($top_menu as $item):?>
		<li <?if ($item[2] == 1):?> class="current"<?endif;?>><a href="<?=$item[1]?>"><?=$item[0]?></a></li>
	<?endforeach;?>
	<li class="right col_5">
		<form method="get" accept-charset="utf-8"  enctype="multipart/form-data" id="searchform" action="<?=base_url()?>search"/>
			<input type="text" id="search_input" name="name" class="col_12 search" placeholder="Поиск" value="<?if(isset($search)):?><?=$search?><?endif;?>" onkeypress="autocomp()" autocomplete="off"/>
		</form>
	</li>
</ul>