<div class="col_12">
	<a href="<?=base_url()?>admin/content/item/edit/documents?m_id=<?=$content->id?>">Создать документ</a> &nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?=base_url()?>admin/content/items/documents/<?=$content->id?>">Сортировка документов</a>
</div>
<div class="col_12">
<table  id="sort" cellspacing="2" cellpadding="2" >
	<tbody class="sortable">
	<?$doc_counter = 1?>
	<?foreach($content->documents as $doc):?>
		<tr id="documents-<?=$doc->id?>">
			<td class="tb_1"><?=$doc_counter?></td>
			<td class="tb_7"><a href="<?=base_url()?>admin/content/item/edit/documents/<?=$doc->id?>"><?=$doc->name?></a></td>
			<?$doc_counter++?>
		</tr>
	<?endforeach;?>	
	</tbody>
</table>
</div>