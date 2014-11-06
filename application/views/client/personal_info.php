<?require_once 'include/head.php'?>

<div id="parent" class="clearfix">
	<?require_once 'include/header.php'?>
	
	<div id="wrapper">
		<?require_once 'include/left_col.php'?>
		
		<div id="main-content">
			<div class="title">Personal Information</div>
			<div id="content">
				<div style="text-align:center;">
					<?if(validation_errors() == ""):?>
						Please update your personal information if it has changed.
					<?else:?>
						<span style="color:red;"><?=validation_errors()?></span>
					<?endif;?>
				</div>
				
				<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="save_changes" action="<?=base_url()?>registration/update_info/personal"/>
					<input type="hidden" name="id" value="<?=$user->id?>"/>
					<table>
						<tr>
							<td class="tb_left">&nbsp;</td>
							<td class="tb_right"><span class="req">* </span>Required field</td> 
						</tr>
						<tr>
							<td class="tb_left">First name</td>
							<td class="tb_right"><input type="text" name="first_name" <?if($user->first_name):?>value="<?=$user->first_name?>"<?endif;?>/><span class="req">*</span></td>
						</tr>
						<tr>
							<td class="tb_left">Last name</td>
							<td class="tb_right"><input type="text" name="last_name" <?if($user->last_name):?>value="<?=$user->last_name?>"<?endif;?>/><span class="req">*</span></td>
						</tr>
						<tr>
							<td class="tb_left">Email address</td>
							<td class="tb_right"><input type="text" name="email" <?if($user->email):?>value="<?=$user->email?>"<?endif;?>/><span class="req">*</span></td>
						</tr>
						<tr>
							<td class="tb_left">Phone number</td>
							<td class="tb_right"><input type="text" name="phone" <?if($user->phone):?>value="<?=$user->phone?>"<?endif;?>/></td>
						</tr>
						<tr>
							<td class="tb_left">Country</td>
							<td class="tb_right"><input type="text" name="country" <?if($user->country):?>value="<?=$user->country?>"<?endif;?>/><span class="req">*</span></td>
						</tr>
						<tr>
							<td class="tb_left">Region</td>
							<td class="tb_right"><input type="text" name="region" <?if($user->region):?>value="<?=$user->region?>"<?endif;?>/></td> 
						</tr>
						<tr>
							<td class="tb_left">Town/City</td>
							<td class="tb_right"><input type="text" name="city" <?if($user->city):?>value="<?=$user->city?>"<?endif;?>/><span class="req">*</span></td>
						</tr>
						<tr>
							<td class="tb_left">Address line 1</td>
							<td class="tb_right"><input type="text" name="address_1" <?if($user->address_1):?>value="<?=$user->address_1?>"<?endif;?>/><span class="req">*</span></td>
						</tr>
						<tr>
							<td class="tb_left">Address line 2</td>
							<td class="tb_right"><input type="text" name="address_2" <?if($user->address_2):?>value="<?=$user->address_2?>"<?endif;?>/></td>
						</tr>
						<tr>
							<td class="tb_left">Postal/Zip code</td>
							<td class="tb_right"><input type="text" name="postal" <?if($user->postal):?>value="<?=$user->postal?>"<?endif;?>/><span class="req">*</span></td>
						</tr>
						<!--<tr>
							<td class="tb_left">Date of birth</td>
							<td class="tb_right"><input type="text" name="postal" <?if($user->birth):?>value="<?=$user->birth?>"<?endif;?>/><span class="req">*</span></td>
						</tr>-->
						<tr>
							<td class="tb_left">&nbsp;</td>
							<td class="tb_right">
								<input id="personal_link" type="submit" name="" onclick="document.forms['save_changes'].submit()" style="display:none">
								<span class="freak_link" onclick=personal_link.click()>SAVE CHANGES</span>
							</td>
						</tr>
					</table>
				</form>
			
				<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="change_pass" action="<?=base_url()?>registration/update_info/pass"/>
					<input type="hidden" name="id" value="<?=$user->id?>"/>
					<table>
						<tr>
							<td class="tb_left">New Password</td>
							<td class="tb_right"><input type="password" name="password"/></td> 
						</tr>
						<tr>
							<td class="tb_left">Confirm Password</td>
							<td class="tb_right">
								<input type="password" name="conf_password"/>
							</td> 
						</tr>	
						<tr>
							<td class="tb_left">&nbsp;</td>
							<td class="tb_right">
								<input id="pass_link" type="submit" name="" onclick="document.forms['change_pass'].submit()" style="display:none">
								<span class="freak_link" onclick=pass_link.click()>CHANGE PASSWORD</span>
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