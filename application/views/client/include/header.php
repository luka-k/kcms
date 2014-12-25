<div class="col_12">
	<div class="col_5">
	</div>
	<div class="col_7">
		<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="search" action="<?=base_url()?>search"/>
			<input type="text" name="search" class="col_12" placeholder="Поиск" onchange="document.forms['search'].setAttribute('action', '<?=base_url()?>search?name='+this.value); document.forms['search'].submit()"/>
		</form>
	</div>
</div>