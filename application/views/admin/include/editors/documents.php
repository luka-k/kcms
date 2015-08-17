<div class="col_12">
	<a href="<?=base_url()?>admin/content/item/edit/documents?m_id=<?=$content->id?>">Создать документ</a>
</div>
<div class="col_12">
	<?$doc_counter = 1?>
	<?foreach($content->documents as $doc):?>
		<div class="col_1"><?=$doc_counter?></div>
		<div class="col_11"><a href="<?=base_url()?>admin/content/item/edit/documents/<?=$doc->id?>"><?=$doc->name?></div>
		<?$doc_counter++?>
	<?endforeach;?>
</div>