<div id="left_cont">
	<?if($type <> "study" && $type <> "book-store" && $type <> "kontakty"):?>
		<div id="exam_logo">
			<a href="/category/cambridge/"><img src="<?=base_url()?>template/client/img/<?=$type?>.png" alt="<?=$type?>"/></a>
		</div>
	<?endif;?>
	<?if($type <> "book-store"):?>
		<div id="left_menu" class="rounded">
			<? require 'left-menu.php'?>
		</div>
		
		<?if($type <> "kontakty"):?>
			<div id="lead" class="rounded">
				<div id="lead_title">Руководитель направления <?=$content->direction?></div>
				<img width="70" height="83" src="<?=$content->img->url?>"/>
				<p>
					<?=$content->lead_name?><br/>
					<a href="mailto:<?=$content->lead_email?>"><?=$content->lead_email?></a>
				</p>
			</div>
		<?endif;?>
	<?endif;?>
	
	<?php require_once 'social.php' ?>
</div>