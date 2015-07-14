<div class="footer-top">&nbsp;</div>
	<div class="footer-middle">
		<div class="footer__wrap wrap">
			<div class="footer__contacts">
				<div class="contacts-info">
					<div class="contacts-info__item _1">
						<div class="contacts-info__copy">&copy; 2015 Книжный дом</div> <!-- /.contacts-info__copy -->
					</div> <!-- /.contacts-info__item -->
			
					<div class="contacts-info__item _2">
						<div class="footer-mail"><?=$settings->email?></div>
					</div>
			
					<div class="contacts-info__item _3">
						<div class="footer-address"><?=$settings->address?></div>
					</div>
				
					<div class="contacts-info__item _4">
						<div class="footer-phone"><?=$settings->phones[0]?></br><?=$settings->phones[1]?></div>
					</div>
				
				</div> <!-- /.contacts-info -->
			</div>
		</div> <!-- /.footer__contacts -->
	</div>
	
	<footer class="footer" id="footer">
		<div class="footer__wrap wrap">
			<div class="contacts-info">
				<?$dep_counter = 1?>
				<?foreach($departments as $d):?>
					<div class="contacts-info__item _<?=$dep_counter?>">
						<div class="footer-title"><?=$d->name?></div> 
						<?if(!empty($d->address)):?><?=$d->address?></br><?endif;?>
						<?if(!empty($d->phone)):?>тел:  <?=$d->phone?></br><?endif;?>
						<?foreach($d->opened as $op):?>
							<?=$op?></br>
						<?endforeach;?>
					</div> <!-- /.contacts-info__item -->
					<?$dep_counter++?>
				<?endforeach;?>
			</div> <!-- /.contacts-info -->	
		</div> <!-- /.footer__wrap wrap -->
	</footer> <!-- /.header -->
