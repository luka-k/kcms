<div class="footer__nav">
	<div class="footer-nav">
		<?foreach($top_menu as $level_1):?>
			<ul class="footer-nav__list">
				<li class="footer-nav__item">
					<a href="<?=$level_1->url?>" class="footer-nav__href footer-nav__title skew"><?=$level_1->name?></a>
				</li> <!-- /.footer-nav__item -->
				<?if($level_1->childs):?>
					<?foreach($level_1->childs as $level_2):?>
						<li class="footer-nav__item">
							<a href="<?=$level_2->url?>" class="footer-nav__href"><?=$level_2->name?></a>
						</li> <!-- /.footer-nav__item -->
					<?endforeach;?>
				<?endif;?>
			</ul>
		<?endforeach;?>
	</div> <!-- /.footer-nav -->
</div> <!-- /.footer__nav -->   