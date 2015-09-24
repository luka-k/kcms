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
											<a href="#" id="psevdoInput" class="upload" onclick="$('#avatar').click();">Обновить фото</a>
										</div>
										<input type="file" id="avatar" name="image" accept="application/msword" onchange="document.forms['avatar_form'].submit()" style="display:none;" />
									</form>
								</div>
								
									<div class="personal_info span7">
										<div class="sub_wrap clearfix">
											<div class="c_info">
												<div class="col_12">
													Ф.И.О.: <span><?=$selected_child->full_name?></span><br />
												</div>
												<div class="col_12">
													Школа: <span><?=$selected_child->school->name?></span><br />
												</div>
												<div class="col_12">
													Класс: <span><?=$selected_child->class?></span><br />
												</div>
											</div>
										
											<div class="balance">
												<div class="col_12 right">Баланс карты: <span style="color:red;"><?=$selected_child->card->card_balance?> р.</span></div>
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
								<div class="tab-pane " id="statistic">
									<?if(!empty($selected_child->orders)):?>
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
									<div class="tab-title col_12">Меню</div>
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
														<td class="menu_type"><?=$category->name?></td>
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
								<div class="tab-pane active" id="settings">
									<div class="tab-title col_12">Настройки</div>
									<div class="col_12">
										<label for="" class="">Максимальная сумма в день:</label>
										<input type="text" name="" class="" value="<?=$selected_child->card->card_day_limit?> р." onchange="set_limit(this.value, '<?=$selected_child->card_number?>')" /><br /><br />
										<label for="" class="">СМС-информирование по питанию (100р в месяц):</label> 
										<input type="checkbox" id="dinner_ch" <?if($selected_child->dinner_sms_enabled == 1):?>checked<?endif;?> onchange="set_status('dinner', '<?=$selected_child->id?>');" /> 
										<span class="dinner_status <?if($selected_child->dinner_sms_enabled == 1):?>green<?else:?>red<?endif;?> "><?if($selected_child->dinner_sms_enabled == 1):?>включено<?else:?>выключено<?endif;?> </span> 
						
										<span class="dinner_date">
											<?if($selected_child->dinner_sms_enabled == 1):?>
												<?=$selected_child->dinner_sms_enabled_date?>
											<?endif;?>
										</span>
										<br /><br />
						
										<label for="" class="">СМС-информирование по посещению школы (100р в месяц):</label> 
										<input type="checkbox" id="visit_ch" <?if($selected_child->visit_sms_enabled == 1):?>checked<?endif;?> onchange="set_status('visit', '<?=$selected_child->id?>');" /> 
										<span class="visit_status <?if($selected_child->visit_sms_enabled == 1):?>green<?else:?>red<?endif;?>"><?if($selected_child->visit_sms_enabled == 1):?>включено<?else:?>выключено<?endif;?></span> 
						
										<span class="visit_date">
											<?if($selected_child->visit_sms_enabled == 1):?>
												<?=$selected_child->visit_sms_enabled_date?>
											<?endif;?>
										</span>
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
					
					<div id="parent-info" class="clearfix col_6" style="display:none;">
			<div class="personal-info clearfix">
				<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="parent_form" class="form" action="<?=base_url()?>account/update_info">
					
					<input type="hidden" name="id" value="<?=$user->id?>"/>
					<div class="clearfix">
						<label for="" class="span1">Ф.И.О:</label>
						<input type="text" name="name" class="require span5" value="<?=$user->name?>"/>
					</div>
					<div class="clearfix">
						<label for="" class="span1">Email:</label>
						<input type="text" name="email" class="require span5" value="<?=$user->email?>"/>
					</div>
					<div class="clearfix">
						<label for="" class="span1">Телефон:</label>
						<input type="text" name="phone" class="require span5" value="<?=$user->phone?>"/>
					</div>
					<div class="clearfix">
						<label for="" class="span1">Пароль:</label>
						<input type="text" name="password" class="span5" value=""/>
					</div>
					<div style="text-align:center;">
						<a href="#" class="btn green" onclick="form_submit('parent_form'); return false">Изменить</a>
					</div>
				</form>
			</div>
		</div>
		
				<footer id="page-footer" class="container-fluid">
					<div class="row-fluid">
				<aside style="" id="block-region-footer-left" class="span4 block-region" data-blockregion="footer-left" data-droptarget="1"></aside>
				<aside style="display: none;" id="block-region-footer-left" class="span4 block-region" data-blockregion="footer-left" data-droptarget="1">
				<a href="#sb-1" class="skip-block">Skip Calendar</a><div id="inst3" class="block_calendar_month  block" role="complementary" data-block="calendar_month" data-instanceid="3" aria-labelledby="instance-3-header"><div class="header"><div class="title"><div class="block_action"></div><h2 id="instance-3-header">Calendar</h2></div></div><div class="content"><table class="minicalendar calendartable" summary="September 2015 Calendar"><caption><div class="calendar-controls"><a class="arrow_link previous" href="indexed48.html?time=1438380000" title="Previous month"><span class="arrow ">&#x25C4;</span><span class="accesshide " >&nbsp;<span class="arrow_text">Previous month</span></span></a><span class="hide"> | </span><span class="current"><a title="This month" href="calendar/view5337.html?view=month&amp;time=1442434475&amp;course=1">September 2015</a></span><span class="hide"> | </span><a class="arrow_link next" href="index9a43.html?time=1443650400" title="Next month"><span class="accesshide " ><span class="arrow_text">Next month</span>&nbsp;</span><span class="arrow ">&#x25BA;</span></a><span class="clearer"><!-- --></span>
</div></caption><tr class="weekdays"><th scope="col"><abbr title="Sunday">Sun</abbr></th>
<th scope="col"><abbr title="Monday">Mon</abbr></th>
<th scope="col"><abbr title="Tuesday">Tue</abbr></th>
<th scope="col"><abbr title="Wednesday">Wed</abbr></th>
<th scope="col"><abbr title="Thursday">Thu</abbr></th>
<th scope="col"><abbr title="Friday">Fri</abbr></th>
<th scope="col"><abbr title="Saturday">Sat</abbr></th>
</tr><tr><td class="dayblank">&nbsp;</td>
<td class="dayblank">&nbsp;</td>
<td class="day">1</td>
<td class="day">2</td>
<td class="day">3</td>
<td class="day">4</td>
<td class="weekend day">5</td>
</tr><tr><td class="weekend day">6</td>
<td class="day">7</td>
<td class="day">8</td>
<td class="day">9</td>
<td class="day">10</td>
<td class="day">11</td>
<td class="weekend day">12</td>
</tr><tr><td class="weekend day">13</td>
<td class="day">14</td>
<td class="day">15</td>
<td class="day today eventnone"><span class="accesshide " >Today Wednesday, 16 September </span><a id="calendar_tooltip_1" href="#">16</a></td>
<td class="day">17</td>
<td class="day">18</td>
<td class="weekend day">19</td>
</tr><tr><td class="weekend day">20</td>
<td class="day">21</td>
<td class="day">22</td>
<td class="day">23</td>
<td class="day">24</td>
<td class="day">25</td>
<td class="weekend day">26</td>
</tr><tr><td class="weekend day">27</td>
<td class="day">28</td>
<td class="day">29</td>
<td class="day">30</td>
<td class="dayblank">&nbsp;</td><td class="dayblank">&nbsp;</td><td class="dayblank">&nbsp;</td></tr></table></div></div>

<span id="sb-1" class="skip-block-to"></span></aside>

<aside id="block-region-footer-middle" class="span4 block-region" data-blockregion="footer-middle" data-droptarget="1"></aside>
<aside id="block-region-footer-right" class="span4 block-region" data-blockregion="footer-right" data-droptarget="1">
	<a href="#sb-3" class="skip-block">город Петрозаводск</a>
	<div id="inst67" class="block_html  block" role="complementary" data-block="html" data-instanceid="67" aria-labelledby="instance-67-header">
		<div class="header">
			<div class="title">
				<div class="block_action"></div>
				<h2 id="instance-67-header">ООО "Новый Свет"</h2>
			</div>
		</div>
		<div class="content">
			<div class="no-overflow"><address>город Петрозаводск, пр. Александра Невского, 65</address>
				<i class="fa fa-mobile fa-lg"></i>&nbsp; Телефон: +7 (931) 701-3501 <br>
				<i class="fa fa-envelope-o"></i>&nbsp; E-mail: <a href="mailto:info@sup-ptz.ru">info@sup-ptz.ru</a>
				<h6>Мы в соцсетях:</h6>
				<div class="social_icons pull-left">
					<a class="social fa fa-vk" target="_blank" href="http://vk.com/novyisvet_ptz"> </a>
				</div>
			</div>
		</div>
	</div>
	<span id="sb-3" class="skip-block-to"></span>
</aside> 	
</div>

<div class="footerlinks">
   	<div class="row-fluid">
    	<p class="helplink"></p>
    	<div class="footnote"><p>(c) 2014-2015 | ООО "Новый Свет"</p></div>		
	</div>
</div>

</footer>

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