<aside class="sidebar blog-sidebar">
	<div class="widget clearfix outer-bottom-xs">
		<h4 class="blog-sidebar-title">Мы в соцсетях</h4>
		<div class="body m-t-20">
			<ul class="clearfix list-unstyled sidebar-social-contact list-inline">
                <li><a href="#" class="fa fa-facebook" title="Facebook"></a></li>
                <li><a href="#" class="fa fa-pinterest" title="Pinterest"></a></li>
                <li><a href="#" class="fa fa-linkedin" title="linkedin"></a></li>
                <li><a href="#" class="fa fa-twitter" title="Twitter"></a></li>
                <li><a href="#" class="fa fa-google-plus" title="Google Plus"></a></li>
                <li><a href="#" class="fa fa-rss" title="Rss"></a></li>
                <li><a href="#" class="fa fa-facebook" title="Facebook"></a></li>
          
            </ul><!-- /.list-unstyled -->
		</div><!-- /.body -->
	</div><!-- /.widget -->

	<!---popular_blog_sidebar--->

	<!--<div class="widget clearfix outer-bottom-xs">
		<h4 class="blog-sidebar-title">Text Widget</h4>
		<div class="body m-t-20">
			<p><span class="black-box"></span>A cras tincidunt, ut tellus et. Gravida scele risque, ipsum sed iacul is, nunc non namtellus.purus purus elit. Cras ante eros. Erat vel. Donec vestibulum sed, vel euismod donec. </p>
		</div><!-- /.body -->
	<!--</div><!-- /.widget -->

	<!--<div class="widget clearfix outer-bottom-xs">
		<h4 class="blog-sidebar-title">Meta</h4>
		<div class="body m-t-20">
			<ul class="clearfix list-unstyled category-list">
                <li><a href="#">Site Admin</a></li>
                <li><a href="#">Log Out</a> </li>
                <li><a href="#">Enteries RSS</a></li>
                <li><a href="#">Comments RSS</a></li>
                <li><a href="#">Wordpress.org</a></li>
            </ul><!-- /.list-unstyled -->
		<!--</div><!-- /.body -->
	<!--</div><!-- /.widget -->

	<div class="widget clearfix outer-bottom-xs">
		<?if(!empty($left_menu)):?>
			<h4 class="blog-sidebar-title">Статьи</h4>
			<div class="body m-t-20">
				<ul class="clearfix list-unstyled category-list">
					<?foreach($left_menu as $level_1):?>
						<li class="<?if(!empty($lavel_1->childs)):?>sub-menu<?endif;?>">
							<a class="dropdown-toggle" data-toggle="dropdown" href="<?= $level_1->full_url?>"><?= $level_1->name?></a>
							<?if(!empty($level_1->childs)):?>
								<ul>
									<?foreach($lavel_1->childs as $level_2):?>
										<li><a href="<?= $level_2->full_url?>"><?= $level_2->name?></a></li>
									<?endforeach;?>
								</ul>
							<?endif;?>
						</li>
					<?endforeach;?>
				</ul><!-- /.list-unstyled -->
			</div><!-- /.body -->
		<?endif;?>
	</div><!-- /.widget -->
</aside><!-- /.sidebar -->