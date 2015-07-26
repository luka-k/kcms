<div id="scroll-left" class="leftmenu">
	<div class="div">
		<a href="<?=base_url()?>bb" id="" class="main-item down-item" onclick="">
			<span class="menu-pic"><img src="<?=base_url()?>template/client/images/blue_brightbuild.png" alt=""></span>
			<span class="menu-text">bрайтbилд</span>
		</a> 
			
		<?if(!empty($brightbild)):?>
			<ul class="sub-menu active">
				<?foreach($brightbild as $b):?>
					<li id="lm_<?=$b->id?>" class="c<?=$b->id?>   leftsubmenu"><a href="#" onclick="active_bb('<?=$b->id?>'); return false;"><?=$b->name?></a></li>
				<?endforeach;?>
			</ul>
		<?endif;?>
	</div>
</div>	