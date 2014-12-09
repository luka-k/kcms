<div style="clear: both;"></div>
<div style="text-align: left;color:#aaa;font-size: 12px;margin-top:-20px;margin-bottom:5px; padding-left:5px;" id="breadcrumbs">
	<div class="breadcrumbs">
		<? foreach ($breadcrumbs as $link):?>
			<?if($link['last'] == false):?>
				<a href="<?=$link["url"]?>"><?=$link["name"]?></a> &raquo; 
			<?else:?>
				<span class="current"><?=$link["name"]?></span>
			<?endif;?>
		<?endforeach;?>
	</div>		
</div>	