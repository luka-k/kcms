<?require_once 'include/head.php'?>

<div id="parent" class="clearfix">
	<?require_once 'include/header.php'?>
	
	<div id="wrapper">
		<?require_once 'include/left_col.php'?>
		
		<div id="main-content">
			<div class="title">CONTACT US</div>
			<div id="content">
				If  you  have  any  questions  about  an  order  or  about our products, please, send us a mesasge via this form:  
				<form action="" method="">
					<table>
						<tr>
							<td class="tb_left">Subject</td>
							<td class="tb_right">
								<div style="position:relative;">
									<div id="select">
										<select name="" id="choose" size="1" class="select-2">
											<option selected value="">Choose...</option>
											<option value="first">Первый </option>
											<option value="second">Второй</option>
											<option value="third">Третий</option>
										</select>
									</div>
								</div>
							</td>
						</tr>
						<tr>
							<td class="tb_left">Email address</td>
							<td class="tb_right"><input type="text" name="email"/></td> 
						</tr>
						<tr>
							<td class="tb_left">Order ID</td>
							<td class="tb_right"><input type="text" name="order_id"/></td> 
						</tr>
						<tr>
							<td class="tb_left">Message</td>
							<td class="tb_right"><textarea rows="10" cols="35" name="message"></textarea></td> 
						</tr>
						<tr>
							<td class="tb_left">&nbsp;</td>
							<td class="tb_right">
								<input id="submit_link" type="submit" name="" style="display:none">
								<span class="freak_link" onclick=submit_link.click()>Send Message</span>
							</td> 
						<tr/>
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