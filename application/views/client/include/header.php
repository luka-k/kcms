<header id="page-header" class="clearfix">
	<div class="container-fluid">    
		<div class="row-fluid">
							
		<!-- HEADER: LOGO AREA -->
		<div class="logo-header">
			<a class="logo" href="index.html" title="Home">
				<img src="<?=base_url()?>template/client/img/logo-site.png" class="logo" alt="logo" />                    
			</a>
		</div>
                  	
		<div class="login-header">
			<div class="profileblock" style="text-align:right;">
      
      
            		<form class="navbar-form pull-right parent-form" method="post" action="<?=base_url()?>account/enter/">
		<div id="block-login" style=''>
            <div id="phonetop" style="font-size: 14px;line-height: 15px;text-align: right;"><i class="fa fa-mobile fa-2x maincolor"></i> <span style="font-size: 22px;line-height: 15px;">+7 (931) 701-3501</span><br><a href="#win2" style="font-size: 14px;line-height: 15px;">перезвоните мне</a><br><br><a href="#win2" style="font-size: 14px;padding-top:8px;" onclick="$('#phonetop').hide(); $('#entertop').show();return false;"><i class="fa fa-hand-o-right fa-1x maincolor"></i> вход в личный кабинет</a></div>
				<div id="entertop" style="display: none;">
					<?if(!$user || !in_array('parent', $user_groups)):?>
						<label id="user"><i class="fa fa-user"></i></label>	
						<input class="span2" type="text" name="name" onFocus="if(this.value =='Username' ) this.value=''" value="" placeholder="Логин" style="margin-bottom:10px;">
						<label id="pass"><i class="fa fa-key"></i></label>
						<input class="span2" type="password" name="password" id="password1" value="" placeholder="Пароль">
						<input type="submit" id="submit" name="submit" value=""/>
					<?else:?>
						<div style="text-align:center">
							<a class="btn btn-default fancybox" href="<?=base_url()?>account"><!--Здравствуйте, --><span><?=$user->short_name?></span></a>
							<a class="btn btn-danger" href="<?=base_url()?>account/log_out">Выход</a>
						</div>
					<?endif;?>
				</div>
			</form>
      
			</div>
					
		</div>
	</div>
	</div>
	</header>

				<header role="banner" class="navbar">
					<nav role="navigation" class="navbar-inner">
						<div class="container-fluid">
							<a class="brand" href="<?=base_url()?>index">Главная</a>
							<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>
							<div class="nav-collapse collapse">
								<ul class="nav">
									<?foreach($top_menu as $level_1):?>
										<li <?if(!empty($level_1->childs)):?>class="dropdown"<?endif;?>>
											<a href="<?=$level_1->full_url?>" class="dropdown-toggle" title="<?=$level_1->name?>">
												<?=$level_1->name?>
												<?if(!empty($level_1->childs)):?><b class="caret"></b><?endif;?>
											</a>
											<?if(!empty($level_1->childs)):?>
												<ul class="dropdown-menu">
													<?foreach($level_1->childs as $level_2):?>
														<li><a title="<?=$level_2->name?>" href="<?=$level_2->full_url?>"><?=$level_2->name?></a></li>
													<?endforeach;?>
												</ul>
											<?endif;?>
										</li>
									<?endforeach;?>
								</ul>               
								<div class="nav-divider-right"></div>
								<ul class="nav pull-right">
									<li></li>
								</ul>
                
								<form id="search" action="" method="GET">
									<div class="nav-divider-left"></div>							
									<input id="coursesearchbox" type="text" onFocus="if(this.value =='Поиск по сайту' ) this.value=''" onBlur="if(this.value=='') this.value='Поиск по сайту'" value="Поиск по сайту" name="search">
									<input type="submit" value="">							
								</form>
							</div>
						</div>
					</nav>
				</header>
				<div class="text-center" style="line-height:1em;">
	<img src="<?=base_url()?>template/client/img/shadow.png" class="slidershadow frontpage-shadow" alt="">
</div>