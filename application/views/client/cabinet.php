<!DOCTYPE html>
<html  dir="ltr" lang="en" xml:lang="en">


	<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
	<head>
		<title>Новый Свет</title>
		<?require 'include/head.php';?>
	</head>

	<body  id="page-site-index" class="format-site course path-site dir-ltr lang-en yui-skin-sam yui3-skin-sam lambda-redpithemes-com pagelayout-frontpage course-1 context-2 notloggedin two-column has-region-side-pre empty-region-side-pre has-region-side-post empty-region-side-post has-region-footer-left used-region-footer-left has-region-footer-middle used-region-footer-middle has-region-footer-right used-region-footer-right has-region-hidden-dock used-region-hidden-dock layout-option-nonavbar">
		
		<div class="skiplinks"><a class="skip" href="#maincontent">Skip to main content</a></div>
			<script type="text/javascript">
				//<![CDATA[
				document.body.className += ' jsenabled';
				//]]>
			</script>


			<div id="wrapper">
				<?require 'include/header.php';?>

				<div id="page" class="container-fluid">				
					<div id="page-content" class="row-fluid">
						<div class="span12">
						<div class="<?if(count($children) > 1):?>span8<?else:?>span12<?endif;?>">
							<div id="child_info" class="clearfix">
								<div class="avatar span2">
									<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="avatar_form" class="form" action="<?=base_url()?>account/update_child_photo/<?=$selected_child->id?>" >
										<div class="span12" style="text-align:center">
											<img src="<?=base_url()?>view_image?id=<?=$selected_child->id?>" alt="<?=$selected_child->full_name?>" style="width:90%" />
										</div>
										<div class="span12" style="text-align:center;">
											<a href="#" id="psevdoInput" class="upload" onclick="$('#avatar').click();" style="font-size: 10px;">Обновить фото</a>
										</div>
										<input type="file" id="avatar" name="image" accept="application/msword" onchange="document.forms['avatar_form'].submit()" style="display:none;" />
									</form>
								</div>
								
									<div class="personal_info span7">
										<div class="sub_wrap clearfix">
											<div class="c_info">
												<div class="col_12">
													Ф.И.О.: <br><strong><span><?=$selected_child->full_name?></span></strong><br />
												</div>
												<div class="col_12">
													Школа: <br><strong><span><?=$selected_child->school->name?></span></strong><br />
												</div>
												<div class="col_12">
													Класс: <br><strong><span><?=$selected_child->class?></span></strong><br />
												</div>
											</div>
										
											<div class="balance">
												<div class="col_12 right">Баланс карты: <br><span style="color:red;"><?=$selected_child->card->card_balance?> р.</span></div>
											</div>
										</div>
									</div>
									<div class="refill_balance span3">
										<a href="" class="btn">Пополнить баланс</a>
									</div>
							</div>
							
							
							<div style="width:100%">
							
							
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
								<li class="active"><a href="#statistic" role="tab" data-toggle="tab">Статистика</a></li>
								<li><a href="#menu" role="tab" data-toggle="tab">Меню</a></li>
								<li><a href="#settings" role="tab" data-toggle="tab">Настройки</a></li>
							</ul>

							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane active" id="statistic">
									<?if(true || !empty($selected_child->orders)):?>
										<table class="striped">
											<thead>
												<tr>
													<th>Дата, время</th>
													<th>Сумма</th>
													<th>Информация (состав заказа)</th>
												</tr>
											</thead>
											<tbody>
												<?foreach($selected_child->orders as $order):?>
													<tr>
														<td><?=$order->date?></td>
														<td class="<?if(mb_substr($order->summ, 0, 1) == '-'):?>red<?else:?>green<?endif;?>"><?=$order->summ?> р.</td>
														<td>
															<?if(!empty($order->products)):?>
																<?foreach($order->products as $key => $product):?>
																	<?=$product->name?><?if($key <> count($order->products)-1):?>, <?endif;?>
																<?endforeach;?>
															<?endif;?>
															<?if(!empty($order->operation)):?>
																<?=$order->operation?>
															<?endif;?>
														</td>
													</tr>
												<?endforeach;?>
											</tbody>
										</table>
									<?endif;?>
								</div>
								<div class="tab-pane" id="menu">
									<div class="col_12">
										<table class="tight">
											<thead>
												<tr>
													<th>Наименование</th>
													<th>Вес</th>
													<th>Цена</th>
													<th>Разрешено</th>
												</tr>
											</thead>
											<tbody>
												<?foreach($child_menu->categories as $category):?>
													<tr>
														<td class="menu_type"><strong><?=$category->name?></strong></td>
														<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
													</tr>
													<?if(!empty($category->products)):?>
														<?foreach($category->products as $product):?>
															<tr>
																<td><?=$product->name?></td>
																<td><?=$product->weight?> г.</td>
																<td><?=$product->price?> р</td>
																<td>
																	<input type="checkbox" 
																		   id="<?=$product->id?>_pr" value="<?=$product->id?>" 
														                   <?if(!in_array($product->id, $selected_child->disabled_products)):?>checked<?endif;?> 
														                   onchange="set_product_status('<?=$product->id?>', <?=$selected_child->id?>)"/>
												                </td>
															</tr>
														<?endforeach;?>
													<?endif;?>
												<?endforeach;?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane" id="settings">
									<div class="tab-title span10"></div>
									<div class="span10">
										<label for="" class="">Лимит по питанию в день:</label>
										<input type="text" name="" class="" value="<?=$selected_child->card->card_day_limit?> р." onchange="set_limit(this.value, '<?=$selected_child->card_number?>')" /><br /><br />
										<label for="" class="">СМС-информирование по питанию (1.5р за смс):</label> 
										<input type="checkbox" id="dinner_ch" <?if($selected_child->dinner_sms_enabled == 1):?>checked<?endif;?> onchange="set_status('dinner', '<?=$selected_child->id?>');" /> 
										<span class="dinner_status <?if($selected_child->dinner_sms_enabled == 1):?>green<?else:?>red<?endif;?> "><?if($selected_child->dinner_sms_enabled == 1):?>включено<?else:?>выключено<?endif;?> </span> 
						
										<span class="dinner_date">
											<?if($selected_child->dinner_sms_enabled == 1):?>
												<?=$selected_child->dinner_sms_enabled_date?>
											<?endif;?>
										</span>
										<br /><br />
						
										<label for="" class="">СМС-информирование по посещению школы (120р в месяц):</label> 
										<input type="checkbox" id="visit_ch" <?if($selected_child->visit_sms_enabled == 1):?>checked<?endif;?> onchange="set_status('visit', '<?=$selected_child->id?>');" /> 
										<span class="visit_status <?if($selected_child->visit_sms_enabled == 1):?>green<?else:?>red<?endif;?>"><?if($selected_child->visit_sms_enabled == 1):?>включено<?else:?>выключено<?endif;?></span> 
						
										<span class="visit_date">
											<?if($selected_child->visit_sms_enabled == 1):?>
												<?=$selected_child->visit_sms_enabled_date?>
											<?endif;?>
										</span>
									</div>
									<div class="tab-title span10" style="margin-top:25px;">Персональная информация</div>
									<div class="span10 personal-info">
										<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="parent_form" class="form" action="<?=base_url()?>account/update_info">
					
										<input type="hidden" name="id" value="<?=$user->id?>"/>
										<div class="clearfix">
											<label for="" class="span2">Ф.И.О:</label>
											<input type="text" name="name" class="require span9" value="<?=$user->name?>"/>
										</div>
										<div class="clearfix">
											<label for="" class="span2">Email:</label>
											<input type="text" name="email" class="require span9" value="<?=$user->email?>"/>
										</div>
										<div class="clearfix">
											<label for="" class="span2">Телефон:</label>
											<input type="text" name="phone" class="require span9" value="<?=$user->phone?>"/>
										</div>
										<div class="clearfix">
											<label for="" class="span2">Пароль:</label>
											<input type="text" name="password" class="span9" value=""/>
										</div>
										<div class="">
											<a href="#" class="btn" onclick="form_submit('parent_form'); return false">Изменить</a>
										</div>
										</form>
									</div>
								</div>
							</div>
							</div>
						</div>
							<?if(count($children) > 1):?>
								<div class="span4">
									<ul class="children_list">
										<?foreach($children as $key => $child):?>
											<li class="span12 clearfix <?if($child->id == $selected_child->id):?>selected<?else:?>unselected<?endif;?>">
												<div class="avatar span3" >
													<a href="<?=base_url()?>account/<?=$key?>">
														<img src="<?=base_url()?>view_image?id=<?=$child->id?>" alt="<?=$child->full_name?>"/>
													</a>
												</div>
												<div class="name span9">
													<a href="<?=base_url()?>account/<?=$key?>"><?=$child->full_name?></a>
												</div>						
											</li>
										<?endforeach;?>
									</ul>
								</div>
								<div class="btn change-child span4" onclick="view_children();return false;">
									<a href="#">Выбрать другого ребенка</a>
								</div>
							<?endif;?>
						</div>
						<a href="#top" class="back-to-top"><i class="fa fa-chevron-circle-up fa-3x"></i><p></p></a>
					</div>

<? require 'include/footer.php'?> 


    <script type="text/javascript" src="http://novsvet.ribaweb.ru/theme/javascript.php/lambda/1439469018/javascript.php"></script>
<script type="text/javascript">
//<![CDATA[
M.str = {"moodle":{"lastmodified":"Last modified","name":"Name","error":"Error","info":"Information","viewallcourses":"View all courses","morehelp":"More help","loadinghelp":"Loading...","cancel":"Cancel","yes":"Yes","confirm":"Confirm","no":"No","areyousure":"Are you sure?","closebuttontitle":"Close","unknownerror":"Unknown error"},"repository":{"type":"Type","size":"Size","invalidjson":"Invalid JSON string","nofilesattached":"No files attached","filepicker":"File picker","logout":"Logout","nofilesavailable":"No files available","norepositoriesavailable":"Sorry, none of your current repositories can return files in the required format.","fileexistsdialogheader":"File exists","fileexistsdialog_editor":"A file with that name has already been attached to the text you are editing.","fileexistsdialog_filemanager":"A file with that name has already been attached","renameto":"Rename to \"{$a}\"","referencesexist":"There are {$a} alias\/shortcut files that use this file as their source","select":"Select"},"admin":{"confirmation":"Confirmation"}};
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
var navtreeexpansions4 = [{"id":"expandable_branch_0_courses","key":"courses","type":0}];
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
YUI().use('node', function(Y) {
M.util.load_flowplayer();
setTimeout("fix_column_widths()", 20);
M.yui.galleryversion="2010.04.08-12-35";Y.use("moodle-calendar-eventmanager",function() {M.core_calendar.add_event({"eventId":"calendar_tooltip_1","title":"Today Wednesday, 16 September","content":"No events"});
});
M.yui.galleryversion="2010.04.08-12-35";Y.use("moodle-block_navigation-navigation",function() {M.block_navigation.init_add_tree({"id":"4","instance":"4","candock":false,"courselimit":"20","expansionlimit":0});
});
M.yui.galleryversion="2010.04.08-12-35";Y.use("moodle-block_navigation-navigation",function() {M.block_navigation.init_add_tree({"id":"5","instance":"5","candock":false});
});
M.util.help_popups.setup(Y);
M.yui.galleryversion="2010.04.08-12-35";Y.use("moodle-core-popuphelp",function() {M.core.init_popuphelp();
});
M.util.init_block_hider(Y, {"id":"inst3","title":"Calendar","preference":"block3hidden","tooltipVisible":"Hide Calendar block","tooltipHidden":"Show Calendar block"});
M.util.init_block_hider(Y, {"id":"inst66","title":"About","preference":"block66hidden","tooltipVisible":"Hide About block","tooltipHidden":"Show About block"});
M.util.init_block_hider(Y, {"id":"inst67","title":"Lambda School","preference":"block67hidden","tooltipVisible":"Hide Lambda School block","tooltipHidden":"Show Lambda School block"});
 M.util.js_pending('random55f9cdab6d27f5'); Y.on('domready', function() { M.util.js_complete("init");  M.util.js_complete('random55f9cdab6d27f5'); });

});
//]]>
</script>


<!--[if lte IE 9]>
<script src="http://lambda.redpithemes.com/theme/lambda/javascript/ie/matchMedia.js"></script>
<![endif]-->


<script>
jQuery(document).ready(function ($) {
$('.navbar .dropdown').hover(function() {
	$(this).addClass('extra-nav-class').find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();
}, function() {
	var na = $(this)
	na.find('.dropdown-menu').first().stop(true, true).delay(100).slideUp('fast', function(){ na.removeClass('extra-nav-class') })
});

});

jQuery(document).ready(function() {
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.back-to-top').fadeIn(duration);
        } else {
            jQuery('.back-to-top').fadeOut(duration);
        }
    });
    
    jQuery('.back-to-top').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});

	jQuery(function(){
		jQuery('#camera_wrap').camera({
			fx: 'random',
			height: 'auto',
			loader: 'pie',
			thumbnails: false,
			pagination: false,
			autoAdvance: true,
			hover: false,
			navigationHover: true,
			opacityOnGrid: false
		});
	});

	jQuery(document).ready(function(){
  		jQuery('.slider1').bxSlider({
			pager: false,
			nextSelector: '#slider-next',
			prevSelector: '#slider-prev',
			nextText: '>',
			prevText: '<',
			slideWidth: 240,
    		minSlides: 1,
    		maxSlides: 6,
			moveSlides: 1,
    		slideMargin: 10			
  		});
	});

</script>

</body>
</html>