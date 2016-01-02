<footer class="footer clearfix">
	<div class="margin-top-10">
		<div class="container inner-top-vs">
			<!-- ============================================== FOOTER-TOP ============================================== -->
			<div class="row">
				<div class="col-md-3 col-sm-4">
					<div class="footer-module">
						<h4 class="footer-module-title">О нас</h4>
						<div class="footer-module-body m-t-20 clearfix">
							<p><span class="pull-left"><img src="<?= IMG_PATH?>footer-logo.png" alt="" width="75" height="75"></span>
								Здесь будет текст. Или не будет. 
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<div class="footer-module">
						<h4 class="footer-module-title">Категории</h4>
						<div class="footer-module-body clearfix">
						
							<?$counter = 1?>
							<?$line = ceil(count($left_menu)/2)?>
							<ul class="list-unstyled link-list">
								<?foreach($left_menu as $items):?>
									<li><a href="<?= $items->full_url?>"><?= $items->name?></a></li>
									<?if($counter == $line):?></ul><ul class="list-unstyled link-list"><?$counter = 0?><?endif;?>
									<?$counter++?>
								<?endforeach;?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 clearfix ">
					<div class="footer-module">
						<h4 class="footer-module-title">Информация</h4>
						<div class="footer-module-body clearfix">
							<ul class="list-unstyled link-list">
								<?foreach($footer_info as $fi):?>
									<li><a href="<?= $fi->full_url?>"><?= $fi->name?></a></li>
								<?endforeach;?>
							</ul>

                <!--<ul class="list-unstyled link-list">
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Store Locations</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Terms of Use</a></li>
                </ul>-->
						</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-12">
					<div class="footer-module">
						<h4 class="footer-module-title">Контакты</h4>
						<div class="footer-module-body clearfix">
						<ul class="clearfix list-unstyled footer-social-contact">
							<li><a href="#" class="fa fa-vk" title="Vk"></a></li>
							<li><a href="#" class="fa fa-facebook" title="Facebook"></a></li>
							<li><a href="#" class="fa fa-odnoklassniki" title="Odnoklassniki"></a></li>
							<li><a href="#" class="fa fa-instagram" title="Instagram"></a></li>

						</ul>


                <div class="inner-top-xs">
                    <p>Подпишитесь на наши новости</p>
                    <form class="searchform" action="http://inspectelement.com/" method="get">
                        <input class="s" type="text" placeholder="Email" name="s" value="">
                        <input class="searchsubmit" type="submit" value="Подписаться">
                    </form>
                </div>

            </div>
					</div>
				</div>
			</div>
			<!-- ============================================== FOOTER-TOP : END ============================================== -->            
			<hr>
            <!-- ============================================== FOOTER-BOTTOM ============================================== -->
			<div class="row">
				<div class="col-md-12">
					<div class="pull-left">
						<!---<ul class="payment-list list-unstyled">
							<li><a href="#"><img src="<?= IMG_PATH?>payments/1.png" class="img-responsive" height="22" alt=""></a></li>
						</ul>--->
					</div>
					<p class="copyright-footer pull-right">&copy; 2016 <a href="<?= base_url()?>">BookHouse</a></p>
				</div>
			</div>
			<!-- ============================================== FOOTER-BOTTOM : END ============================================== -->        
		</div>
    </div>
</footer>