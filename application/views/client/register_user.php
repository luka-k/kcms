<?require_once 'include/head.php'?>

	<div id="parent" class="clearfix">
		<?require_once 'include/header.php'?>
		
		<div id="wrapper">
			<?require_once 'include/left_col.php'?>
			
			<div id="main-content">
				<div class="title">Login</div>
				<div style="text-align:center"><?=$error?></div>
				<div id="content">
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="login" action="<?=base_url()?>registration/do_enter?page=registration/cabinet"/>
						<table>
							<tr>
								<td class="tb_left">E-mail</td>
								<td class="tb_right"><input type="text" name="login"></td> 
							</tr>
							<tr>
								<td class="tb_left">Password</td>
								<td class="tb_right"><input type="password" name="password"></td> 
							</tr>
							<tr>
								<td class="tb_left">&nbsp;</td>
								<td class="tb_right">
									<a  href="#" id="login_link" name="" style="display:none" onclick="document.forms['login'].submit()"></a>
									<span class="freak_link" onclick=login_link.click()>LOGIN</span>
								</td> 
							</tr>
						</table>
					</form>
						
					<div class="title">CREATE YOUR ACCOUNT</div>
					
					<div style="text-align:center"><?=validation_errors();?></div>
					<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="register" action="<?=base_url()?>registration/edit_new_user"/>
						<table>
							<tr>
								<td class="tb_left">&nbsp;</td>
								<td class="tb_right"><span class="req">* </span>Required field</td> 
							</tr>
						
							<?$editors_counter = 1?>
							<?php foreach($editors as $name => $edit):?>
								<?require "include/editors/".$edit[1].".php"?>
								<?$editors_counter++?>
							<?php endforeach?>
									
							<tr>
								<td class="tb_left">&nbsp;</td>
								<td class="tb_right"><div class="check">Subscribe to our newsletter<input type="checkbox" name="" checked></div></td> 
							</tr>
							<tr>
								<td class="tb_left">&nbsp;</td>
								<td class="tb_right">
									<a  href="#" id="reg_link" name="" style="display:none" onclick="document.forms['register'].submit()"></a>
									<span class="freak_link" onclick=reg_link.click()>REGISTER</span>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
			<?require_once 'include/right_col.php'?>
		</div>
		<?require_once 'include/footer.php'?>
	</div>
</body>
</html>