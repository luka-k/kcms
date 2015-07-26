<div id="scroll-left" class="leftmenu">
	<div class="div">
		<a href="#" id="" class="main-item down-item" onclick="select_office('false')">
			<span class="menu-pic"><img src="<?=base_url()?>template/client/images/spb.gif" alt=""></span>
			<span class="menu-text">Санкт-Петербург</span>
		</a> 
			
		<?if(!empty($contacts)):?>
			<ul class="sub-menu active">
				<?foreach($contacts as $c):?>
					<li><a href="#" onclick="select_office('<?=$c->id?>')"><?=$c->name?></a></li>
				<?endforeach;?>
			</ul>
		<?endif;?>
	</div>
</div>	