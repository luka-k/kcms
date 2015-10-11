<!DOCTYPE html>
<html  dir="ltr" lang="en" xml:lang="en">


	<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
	<head>
		<title>Новый Свет</title>
		<?require 'include/head.php';?>
	</head>

	<body  id="page-site-index" class="format-site course path-site dir-ltr lang-en yui-skin-sam yui3-skin-sam lambda-redpithemes-com pagelayout-frontpage course-1 context-2 notloggedin two-column has-region-side-pre empty-region-side-pre has-region-side-post empty-region-side-post has-region-footer-left used-region-footer-left has-region-footer-middle used-region-footer-middle has-region-footer-right used-region-footer-right has-region-hidden-dock used-region-hidden-dock layout-option-nonavbar">

		<div id="wrapper">
			<?require 'include/header.php';?>

			<div id="page" class="container-fluid">	
				<div class="content">
					<h3 class="sectionname pay">Пополнить счет</h3>
					<div class="summary">
						<div class="clearfix payment_form">
						<form action="https://money.yandex.ru/eshop.xml" method="post"> 
							<input type="hidden" name="shopId" value="" />
							<input type="hidden" name="scid" value="" />
							<input type="hidden" name="customerNumber" value="" />
							
							<div class="clearfix" >
								<label for="" class="span2" style="text-align:right; margin-right:5px;">Телефон ребенка<span class="red">*</span></label>
								<input type="text" name="customerNumber" class="require span4" disabled value="<?= $phone?>"/>
							</div>
							
							<div class="clearfix">
								<label for="" class="span2" style="text-align:right; margin-right:5px;">Сумма<span class="red">*</span></label>
								<input type="text" name="sum" class="require span4" value=""/>
							</div>
							
							<div class="clearfix red" style="text-align:center">
								* - поля обязательные для заполнения
							</div>

							<div class="clearfix" style="text-align:center">
								<input type="submit" value="Оплатить"/> 
							</div>
						</form>
						</div>
					</div>
					<a href="#top" class="back-to-top"><i class="fa fa-chevron-circle-up fa-3x"></i><p></p></a>
				</div>
			</div>
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