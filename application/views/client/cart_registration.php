<?require_once 'include/head.php'?>
	
	<div id="parent" class="clearfix">
		<?require_once 'include/header.php'?>
		
			<div id="wrapper">
				<?require_once 'include/left_col.php'?>
				
				<div id="main-content">
					<div class="title">Check Out</div>
					<div id="content">
						<div style="text-align:center;">Summary > <span class="chec">Login/Register(optional)</span> > Address > Payment</div>
						
						<div class="title">Login</div>
						<div style="text-align:center"><?=$error?></div>
						<div id="content">
							<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="login" action="<?=base_url()?>registration/do_enter"/>
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
							<a  href="<?=base_url()?>registration/register_user" id="reg_link" name="" style="display:none"></a>
							<span class="freak_link" onclick=reg_link.click()>REGISTRATION</span>
						</div>
					<div class="proceed">
						<a  href="<?=base_url()?>pages/cart/3" id="proceed_link" name="" style="display:none"></a>
						<span class="freak_link" onclick=proceed_link.click()>PROCEED</span>
					</div>
				</div>
			</div>
			<?require_once 'include/right_col.php'?>
		</div>
		<?require_once 'include/footer.php'?>
	</div>
</body>
</html>