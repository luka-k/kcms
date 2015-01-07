<?if(isset($level_2)):?>
<div class="page__nav">
	<ul class="page-nav">	
		<?foreach($level_2->items as $item):?>
			<li class="page-nav__item">
				<a href="<?=$item->full_url?>" class="page-nav__href <?if($level_2->active == $item->url):?>active<?endif;?>"><?=$item->name?></a>
			</li> <!-- /.page-nav__item -->
		<?endforeach;?>
	</ul> <!-- /.page-nav -->
</div> <!-- /.page__nav -->
<?endif;?>