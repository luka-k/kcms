<div class="prefooter">
	<div class="container">
		<?if(!isset($no_public)):?>
			<div class="publishing">
				<h2>Публикации</h2>

                <div class="rss">
                    <a href="#"><img src="<?= base_url()?>template/client/images/rss.png"></a>
                </div>

                <div class="all_publishing">
                    <a href="#">Все материалы</a>
                </div>

                <div class="owl-carousel">
					<?foreach($publications as $pub):?>
						<div class="item">
							<div class="publication">
								<div class="publication_image"><img src="<?= $pub->img->publication_url?>"></div>

								<div class="publication_text">
									<p><a href="#"><p><?= $pub->short_description?></a></p>
									<span><?= $pub->date?></span>
								</div>
							</div>
						</div>
					<?endforeach;?>
                </div>
            </div>
		<?endif;?>
		
		<div class="partners">
			<h2>С нами работают</h2>

                <div class="owl-carousel1">
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                    <div class="item"><img src="<?= base_url()?>template/client/images/partner.jpg"></div>
                </div>
		</div>
	</div>
</div>