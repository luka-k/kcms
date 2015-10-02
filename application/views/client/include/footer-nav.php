<?foreach($top_menu as $level_1):?>
	<?if(!empty($level_1->childs)):?>
		<div class="footerlink">
			<h6><a href="#"><?= $level_1->name?></a></h6>
			<ul>
				<?foreach($level_1->childs as $level_2):?>
					<li><a href="<?= $level_2->full_url?>"><?= $level_2->name?></a></li>
				<?endforeach;?>
			</ul>
		</div>
	<?endif;?>
<?endforeach;?>