<!--delete popup-->
<div id="delete_item" style="display:none;">
	<div class="pop-up">
		<div>
			Вы точно уверены что хотите удалить - <strong id="item_name"></strong>
			<?if(isset($type) && $type == "categories"):?> и все связанные с ней товары и подкатегории<?endif;?>?
		</div><br/>
		<a href="" class="delete_button button small">Удалить?</a>
		<a href="#" class="button small" onclick="$.fancybox.close();">Нет</a>
	</div>
</div>