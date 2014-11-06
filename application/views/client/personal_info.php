<?require_once 'include/head.php'?>

<div id="parent" class="clearfix">
	<?require_once 'include/header.php'?>
	
	<div id="wrapper">
		<?require_once 'include/left_col.php'?>
		
		<div id="main-content">
		  <div class="title">
		    Personal Information
		  </div>
          <div id="content">
          <div style="text-align:center;">
		  Please update your personal information if it has changed.
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
            <!--<table>
			  <tr>
			    <td class="tb_left">
				  &nbsp;
				</td>
			    <td class="tb_right">
                  <span class="req">* </span>Required field
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  First name
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="Boris"><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Last name
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="Smirnoff"><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Email address
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="vasaj@mail.ru"><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Date of birth
				</td>
			    <td class="tb_right">

                  <select id="birth-select" name="" size="1" class="birth-select">
				    <option selected value="">...</option>
                    <option value="first">01</option>
                    <option value="second">02</option>
                    <option value="third">03</option>
                  </select>


                  <select id="birth-select-2" name="" size="1" class="birth-select">
				    <option selected value="">...</option>
                    <option value="first">01</option>
                    <option value="second">02</option>
                    <option value="third">03</option>
                  </select>


                  <select id="birth-select-3" name="" size="1" class="birth-select">
				    <option selected value="">...</option>
                    <option value="first">1980</option>
                    <option value="second">1981</option>
                    <option value="third">1982</option>
                  </select>

				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  View Address
				</td>
			    <td class="tb_right">
                  <select name="select" id="idSelect-1" size="1" class="select-2">
				    <option value="">My Address</option>
                    <option value="first">Not My Address</option>
                  </select>
				  <span class="add-add"><a href="">Add New Address</a></span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  First name
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="Boris"><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Last name
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="Smirnoff"><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Country
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="Rashka"><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Region/State
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="Dwine">
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Town/City
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="Leningrad"><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Address line 1
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="Elf st. 18.12"><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Postal/Zip code
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="195326"><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Phone number
				</td>
			    <td class="tb_right">
                  <input type="text" name="" placeholder="8(892)6661345"><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  &nbsp;
				</td>
			    <td class="tb_right">
				  <div class="check">
                  Use as Default Delivery Address<input type="checkbox" name="" checked>
				  <div>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Current Password
				</td>
			    <td class="tb_right">
                  <input type="text" name=""><span class="req">*</span>
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  New Password
				</td>
			    <td class="tb_right">
                  <input type="text" name="">
				</td> 
              </tr>
			  <tr>
			    <td class="tb_left">
				  Confirm Password
				</td>
			    <td class="tb_right">
                  <input type="text" name="">
				</td> 
              </tr>		
			  <tr>
			    <td class="tb_left">
				  &nbsp;
				</td>
			    <td class="tb_right">
				  <div class="check">
                  Subscribe to our newsletter<input type="checkbox" name="" checked>
				  <div>
				</td> 
              </tr>			  
			  <tr>
			    <td class="tb_left">
				  &nbsp;
				</td>
			    <td class="tb_right">
                  <input id="reg_link" type="submit" name="" style="display:none">
				  <span class="freak_link" onclick=reg_link.click()>SAVE CHANGES</span>
				</td> 
              </tr>-->
			
		  </div>
		</div>
		
		<?require_once 'include/right_col.php'?>

	  </div>
		<?require_once 'include/footer.php'?>
    </div>	
  </body>
</html>