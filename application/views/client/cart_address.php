<?require_once 'include/head.php'?>
	
	<div id="parent" class="clearfix">
		<?require_once 'include/header.php'?>
		
			<div id="wrapper">
				<?require_once 'include/left_col.php'?>
				
				<div id="main-content">
					<div class="title">Check Out</div>
					<div id="content">
						<div style="text-align:center;">Summary > Login/Register(optional) > <span class="chec">Address</span> > Payment</div>
						
						<table>
							<tr>
								<td class="tb_left">&nbsp;</td>
								<td class="tb_right"><span class="req">* </span>Required field</td> 
							</tr>
							<tr>
								<td class="tb_left">First name</td>
								<td class="tb_right"><input type="text" name="first_name"/><span class="req">*</span></td>
							</tr>
							<tr>
								<td class="tb_left">Last name</td>
								<td class="tb_right"><input type="text" name="last_name"/><span class="req">*</span></td>
							</tr>
							<tr>
								<td class="tb_left">Email address</td>
								<td class="tb_right"><input type="text" name="email"/><span class="req">*</span></td>
							</tr>
							<tr>
								<td class="tb_left">Phone number</td>
								<td class="tb_right"><input type="text" name="phone"/></td>
							</tr>
							<tr>
								<td class="tb_left">Country</td>
								<td class="tb_right"><input type="text" name="country"/><span class="req">*</span></td>
							</tr>
							<tr>
								<td class="tb_left">Region</td>
								<td class="tb_right"><input type="text" name="region"/></td> 
							</tr>
							<tr>
								<td class="tb_left">Town/City</td>
								<td class="tb_right"><input type="text" name="city"/><span class="req">*</span></td>
							</tr>
							<tr>
								<td class="tb_left">Address line 1</td>
								<td class="tb_right"><input type="text" name="address_1"/><span class="req">*</span></td>
							</tr>
							<tr>
								<td class="tb_left">Address line 2</td>
								<td class="tb_right"><input type="text" name="address_2"></td>
							</tr>
							<tr>
								<td class="tb_left">Postal/Zip code</td>
								<td class="tb_right"><input type="text" name="postal"/><span class="req">*</span></td>
							</tr>
						</table>
						<div class="proceed">
							<a  href="<?=base_url()?>pages/cart/4" id="proceed_link" name="" style="display:none"></a>
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