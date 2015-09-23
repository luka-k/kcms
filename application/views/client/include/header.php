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
			<div class="profileblock">
            
				<form class="navbar-form pull-right" method="post" action="">
					<div id="block-login">
						<label id="user"><i class="fa fa-user"></i></label>	
						<input class="span2" type="text" name="username" onFocus="if(this.value =='Username' ) this.value=''" value="Логин" style="margin-bottom:10px;">
						<label id="pass"><i class="fa fa-key"></i></label>
						<input class="span2" type="text" name="password1" id="password1" value="Пароль">
						<input type="submit" id="submit" name="submit" value=""/>
					</div>
				</form>
        
				<script type="text/javascript">
					if (window.addEventListener)
					addEvent = function(ob, type, fn ) {
						ob.addEventListener(type, fn, false );
					};
					else if (document.attachEvent)
						addEvent = function(ob, type, fn ) {
							var eProp = type + fn;
							ob['e'+eProp] = fn;
							ob[eProp] = function(){ob['e'+eProp]( window.event );};
							ob.attachEvent( 'on'+type, ob[eProp]);
						};
 
						(function() {
							var p = document.getElementById('password');
								/*@cc_on
								@if (@_jscript)
								@if (@_jscript_version < 9)
								var inp = document.createElement("<input name='password'>");
								inp.id = 'password1';
								inp.type = 'text';
								inp.value = 'Password';
								p.parentNode.replaceChild(inp,p);
								p = document.getElementById('password1');
								@else
								p.type = 'text';
								p.value = 'Password';
								@end
								@else */
								p.type = 'text';
								p.value = 'Password';
								/* @end @*/
								passFocus = function() {
									if ('text' === this.type) {
										/*@cc_on
										@if (@_jscript)
										@if (@_jscript_version < 9)
										var inp = document.createElement("<input name='password'>");
										inp.id = 'password';
										inp.type = 'password';
										inp.value = '';
										this.parentNode.replaceChild(inp,this);
										setTimeout(inp.focus,5);
										@else
										p.type = 'password';
										p.value = '';
										@end
										@else */
										this.value = '';
										this.type = 'password';
										/* @end @*/
									}
								}
								addEvent(p, 'focus', passFocus);
							}());
						</script>
					</div>
				</div>
			</div>
		</div>
	</header>

				<header role="banner" class="navbar">
					<nav role="navigation" class="navbar-inner">
						<div class="container-fluid">
							<a class="brand" href="<?=base_url()?>index">Главная</a>
							<!--<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>-->
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