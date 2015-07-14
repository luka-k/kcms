<div class="menu clearfix" id="menu">
	<div class="menu__wrap wrap">
		<div class="menu_lang">
			<a href="" class="rus">&nbsp;</a>
			<a href="" class="eng">&nbsp;</a>
		</div>
		
		<?if(isset($shop)):?>
			<a href="<?=base_url()?>">
				<div class="menu_main">
					На главную
				</div>
			</a>
		<?endif;?>
		
		<nav class="menu__nav">
			<ul class="menu-nav main">
				<?foreach($top_menu as $item):?>
					<li class="menu-nav__item">
						<a href="<?=$item->full_url?>" class="menu-nav__href <?if($item->url == $select_item)?>active"><?=$item->name?></a>
					</li>
				<?endforeach;?>
			</ul> <!-- /.menu -->
		</nav> <!-- /.menu__nav -->
				
		<div class="menu-enter">
			<?if(empty($user)):?>
				<a href="#">Вход</a><span style="color:#a294c0">|</span>
				<a href="#">Регистрация</a><span style="color:#a294c0">|</span>
				<a href="#" class="enter-cart"><span id="total_qty" class="total-qty">0</span></a>
			<?else:?>
				<a href="<?=base_url()?>cabinet" class="user_name">
					<span class="avatar">&nbsp;</span><?=$user->name?>
				</a>|
				<a href="<?=base_url()?>cart/" class="enter-cart">
					<span id="total_qty" class="total-qty">0</span>
				</a>|
				<a href="" class="logout">&nbsp;</a>
			<?endif;?>
		</div>
			
	</div> <!-- /.menu__wrap wrap -->
</div> <!-- /.menu -->