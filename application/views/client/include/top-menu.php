<div class="menu clearfix" id="menu">
	<div class="menu__wrap wrap">
		<div class="menu_lang">
			<a href="" class="rus">&nbsp;</a>
			<a href="" class="eng">&nbsp;</a>
		</div>
		
		<nav class="menu__nav">
			<?if(isset($shop)):?>
				<a href="<?=base_url()?>">
					<div class="menu_main">
						На главную
					</div>
				</a>
			<?endif;?>
			<ul class="menu-nav <?if(isset($shop)):?>shop<?else:?>main<?endif;?>">
				<?foreach($top_menu as $item):?>
					<li class="menu-nav__item">
						<a href="<?=$item->full_url?>" class="menu-nav__href <?if($item->url == $select_item):?>active<?endif;?>"><?=$item->name?></a>
					</li>
				<?endforeach;?>
			</ul> <!-- /.menu -->
		</nav> <!-- /.menu__nav -->
				
		<div class="menu-enter">
			<?if(empty($user)):?>
				<a href="<?=base_url()?>account/registration?activity=enter">Вход</a><span style="color:#a294c0">|</span>
				<a href="<?=base_url()?>account/registration?activity=reg">Регистрация</a><span style="color:#a294c0">|</span>
				<a href="<?=base_url()?>cart/" class="enter-cart"><span id="total_qty" class="total-qty"><?=$total_qty?></span></a>
			<?else:?>
				<a href="<?=base_url()?>cabinet" class="user_name">
					<span class="avatar">&nbsp;</span><?=$user->name?>
				</a>|
				<a href="<?=base_url()?>cart/" class="enter-cart">
					<span id="total_qty" class="total-qty">0</span>
				</a>|
				<a href="<?=base_url()?>account/do_exit" class="logout">&nbsp;</a>
			<?endif;?>
		</div>
			
	</div> <!-- /.menu__wrap wrap -->
</div> <!-- /.menu -->