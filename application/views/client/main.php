<!DOCTYPE html PUBLIC “-//W3C//DTD XHTML 1.0 Strict//EN” “http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd”>
<html xmlns=”http://www.w3.org/1999/xhtml”>
<? require 'include/head.php' ?>

	<body>
		<div id="parrent">
			
			<? require 'include/header.php'?>
			<? require 'include/top-menu.php'?>
			<? require 'include/slider.php'?>

			<div id="main">
				<div id="left_col">
					<ul class="tabs1 tabs">
						<li><a href="#view1" class="rounded">LT-Pro</a></li>
						<li><a href="#view3" class="rounded">Cambridge</a></li>
						<li><a href="#view4" class="rounded">IELTS</a></li>
						<li><a href="#view5" class="rounded">Pearson</a></li>
					</ul>
					
					<div class="tabcontents rounded">
						<div id="view1" class="tabswitcher tab_content">
							<h3 class="widget-title">Новости LT-PRO</h3>
							<ul class="advanced-recent-posts">
								<?foreach($news_lt as $item_lt):?>
									<li class="news-item">
										<a href="<?=$item_lt->full_url?>" title="<?=$item_lt->name?>" >
											<img width="50" height="50" class="recent-posts-thumb" src="<?=$item_lt->img->url?>" class="attachment-50x50 wp-post-image" alt="fff" /> <?=$item_lt->name?>
										</a>
										<div class="magic news-text"> 
											<?=$item_lt->description?>
										</div>
									</li>
								<?endforeach;?>
							</ul>
						</div>
						<div id="view3" class="tabswitcher tab_content">
							<h3 class="widget-title">Новости Cambridge</h3>
							<ul class="advanced-recent-posts">
								<?foreach($news_camb as $item_camb):?>
									<li class="news-item">
										<a href="<?=$item_camb->full_url?>" title="<?=$item_camb->name?>" >
											<img width="50" height="50" class="recent-posts-thumb" src="<?=$item_camb->img->url?>" class="attachment-50x50 wp-post-image" alt="fff" /> <?=$item_camb->name?>
										</a>
										<div class="magic news-text"> 
											<?=$item_camb->description?>
										</div>
									</li>
								<?endforeach;?>
							</ul>
						</div>
						<div id="view4" class="tabswitcher tab_content">
							<h3 class="widget-title">Новости IELTS</h3>
							<ul class="advanced-recent-posts">
								<?foreach($news_ielts as $item_ielts):?>
									<li class="news-item">
										<a href="<?=$item_ielts->full_url?>" title="<?=$item_ielts->name?>" >
											<img width="50" height="50" class="recent-posts-thumb" src="<?=$item_ielts->img->url?>" class="attachment-50x50 wp-post-image" alt="fff" /> <?=$item_ielts->name?>
										</a>
										<div class="magic news-text"> 
											<?=$item_ielts->description?>
										</div>
									</li>
								<?endforeach;?>
							</ul>
						</div>
						<div id="view5" class="tabswitcher tab_content">
							<h3 class="widget-title">Новости Pearson</h3>
							<ul class="advanced-recent-posts">
								<?foreach($news_pearson as $item_pearson):?>
									<li class="news-item">
										<a href="<?=$item_pearson->full_url?>" title="<?=$item_pearson->name?>" >
											<img width="50" height="50" class="recent-posts-thumb" src="<?=$item_pearson->img->url?>" class="attachment-50x50 wp-post-image" alt="fff" /> <?=$item_pearson->name?>
										</a>
										<div class="magic news-text"> 
											<?=$item_pearson->description?>
										</div>
									</li>
								<?endforeach;?>
							</ul>
						</div>
					</div>
				</div>
				
				<div id="right_col">
					<ul class="tabs2 tabs">
						<li id="tab_1" class="ltpro"><a href="#tab2" onclick="return false;" class="rounded"><i class="icon-ltpro"></i></a></li>
						<li id="tab_2" class="vk"><a href="#tab1" onclick="return false;" class="rounded"><i class="icon-vk"></i></a></li>
						<li id="tab_3" class="gplus"><a href="#tab3" onclick="return false;" class="rounded"><i class="icon-google-plus-sign"></i></a></li>
						<li id="tab_4"><a href="#tab4" onclick="return false;" class="rounded"><i class="icon-facebook-sign"></i></a></li>
						<li id="tab_5"><a href="#tab5" onclick="return false;" class="rounded"><i class="icon-twitter-sign"></i></a></li>
					</ul>
					
					<div class="tabcontents rounded">
						<div id="tab2" class="tabswitcher2 tab_content " >
							<? require 'include/subscribe.php'?>
						</div>

						<div id="tab1" class="tabswitcher2 tab_content ">
							<div id="vk" style="height:0px; overflow: hidden" >
								<script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script>
								<!-- VK Widget -->
								<div id="vk_groups">
									<script type="text/javascript">
										VK.Widgets.Group("vk_groups", {mode: 0, width: "300", height: "180"}, 57836557);
									</script>
								</div>
							</div>
						</div>
						<div id="tab3" class="tabswitcher2 tab_content ">
							<div id="google" style="height:0px; overflow: hidden" >
								<!-- Поместите этот тег туда, где должна отображаться виджет. -->
								<div class="g-page" data-href="https://plus.google.com/109068643756743354375" data-rel="publisher"></div>

								<!-- Поместите этот тег за последним тегом виджета виджет. -->
								<script type="text/javascript">
									window.___gcfg = {lang: 'ru'};
									(function() {
										var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
										po.src = 'https://apis.google.com/js/plusone.js';
										var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
									})();
								</script>
							</div>
						</div>
						<div id="tab4" class="tabswitcher2 tab_content " style="display:none">
							<div id="fb-root"></div>
							<script>
								(function(d, s, id) {
									var js, fjs = d.getElementsByTagName(s)[0];
									if (d.getElementById(id)) return;
									js = d.createElement(s); js.id = id;
									js.src = "//connect.facebook.net/ru_RU/all.js#xfbml=1&appId=647768688600746";
									fjs.parentNode.insertBefore(js, fjs);
								}(document, 'script', 'facebook-jssdk'));
							</script>
							<div class="fb-like-box" data-href="https://www.facebook.com/pages/LT-Pro/432787190158921" data-width="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
						</div>
						<div id="tab5" class="tabswitcher2 tab_content " style="display:none">
							<a href="https://twitter.com/IELTSspb" class="twitter-follow-button" data-show-count="false" data-lang="ru" data-size="large">Читать @IELTSspb</a>
							<script>
								!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
							</script>
						</div>
					</div>
				</div>
			</div>