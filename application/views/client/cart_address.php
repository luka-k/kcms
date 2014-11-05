<?require_once 'include/head.php'?>
	
	<div id="parent" class="clearfix">
		<?require_once 'include/header.php'?>
		
			<div id="wrapper">
				<?require_once 'include/left_col.php'?>
				
				<div id="main-content">
					<div class="title">Check Out</div>
					<div id="content">
						<div style="text-align:center;">Summary > Login/Register(optional) > <span class="chec">Address</span> > Payment</div>
						
						<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="order" action="<?=base_url()?>order/edit_order"/>
							<?if($user->first_name):?><input type="hidden" name="id" value="<?=$user->id?>"/><?endif;?>
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
							</table>

							<div class="proceed">
								<button id="proceed_link" name="" onclick="document.forms['order'].submit()" style="display:none" <?if($cart == NULL):?>disabled<?endif;?>></button>
								<span class="freak_link <?if($cart == NULL):?>disable<?endif;?>" onclick="proceed_link.click()" >PROCEED</span>
							</div>
						</form>
					</div>
				</div>
				<?require_once 'include/right_col.php'?>
			</div>
			<?require_once 'include/footer.php'?>
	</div>
</body>
</html>