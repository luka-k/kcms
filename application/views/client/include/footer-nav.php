<div class="footer__nav">
	<div class="footer-nav">
		<?foreach($top_menu as $level_1):?>
			<ul class="footer-nav__list">
				<li class="footer-nav__item">
					<a href="<?=$level_1->full_url?>" class="footer-nav__href footer-nav__title skew"><?=$level_1->name?></a>
				</li> <!-- /.footer-nav__item -->
				<?if($level_1->childs):?>
					<?foreach($level_1->childs as $level_2):?>
						<li class="footer-nav__item">
							<a href="<?=$level_2->full_url?>" class="footer-nav__href"><?=$level_2->name?></a>
							<?if($level_2->childs):?>
								<ul class="footer-nav-level-2">
									<?foreach($level_2->childs as $level_3):?>
										<li class="footer-nav-level-2__item">
											<a href="<?=$level_3->full_url?>" class="footer-nav-level-2__href"><?=$level_3->name?></a>
										</li> <!-- /.footer-nav-level-2__item -->
									<?endforeach;?>
								</ul>
							<?endif;?>
						</li> <!-- /.footer-nav__item -->
					<?endforeach;?>
				<?endif;?>
			</ul>
		<?endforeach;?>
	</div> <!-- /.footer-nav -->
</div> <!-- /.footer__nav --> 