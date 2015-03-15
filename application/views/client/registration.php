<? require 'include/head.php' ?>
	<div class="grid flex">
		<div id="menu col_12">
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
		</div>
		<div class="wrap col_12 clearfix">
			<div id="main_content" class="col_8 clearfix">
				<div class="col_12">
					<h5>Регистрация</h5>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="form1" action="<?=base_url()?>account/new_user/"/>					
						<div id="" class="clearfix">
							<?=$error;?>
							<?=validation_errors(); ?>
							
							<div class="col_12">
								<input type="text" name="name" value=""/>
							</div>
						
							<div class="col_12">
								<input type="text" name="email" value=""/>
							</div>
						
							<div class="col_12">
								<input type="password" name="password" value=""/>
							</div>
							
							<div class="col_12">
								<input type="password" name="conf_password" value=""/>
							</div>
							
							<div  class="col_12">
								<a href="#" class="btn small" onClick="document.forms['form1'].submit()">Зарегистрировать</a>
							</div>					
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<? require 'include/footer.php' ?>