<h6>Все меню</h6>
<ul class="tree">
	<?foreach ($tree as $branch):?>
		<li><a href = "<?=base_url()?>menu_module/menu<?=$branch->id?>"><?=$branch_1->name?></a>
	<?endforeach?>
</ul>