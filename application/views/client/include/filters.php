<div class="filters">
	<h5>Фильтры</h5>
	<form method="get" accept-charset="utf-8"  enctype="multipart/form-data" id="filters" class="filters" action="<?=base_url()?>catalog" >
		<div class="col_12">
			<div class="col_12">
				<a href="" class="button small" onclick="document.forms['filters'].submit(); return false;">Применить</a>
			</div>
			<div class="col_12">
				<?foreach($filters as $key => $item):?>
					<?require "filters/{$item->editor}.php"?>
				<?endforeach;?>
			</div>
			
			<div class="col_12">
				<a href="" class="button small" onclick="document.forms['filters'].submit(); return false;">Применить</a>
			</div>
		</div>
	</form>
</div>