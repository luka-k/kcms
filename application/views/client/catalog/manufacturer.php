<!DOCTYPE html>
<html lang="ru">
	<?require_once 'include/head.php'?>	
	
	<body>
		<!-------------------header--------------------->
		<? require 'include/header.php'?>
		<!-----------------end_header-------------------->
		
		<div id="wrapper clearfix">
			<div class="section maxw clearfix">
				<div class="mainwrap">
					<main>
						<article>
							<?require 'include/breadcrumbs.php'?>
								
							<div id="" class="main-content clearfix">
								
								<div class="for-select">
									<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="manufacturer-form" class="filter-form" action="<?=base_url()?>shop/manufacturer/" >
									<select name="" class="dropdown" onchange="manufacturer_submit('<?=$menu_link?>',this.options[this.selectedIndex].value);">
										<option value="1" disabled="" selected="selected">выбор производителя</option>
										<?foreach($manufacturers as $m):?>
											<option value="<?=$m->url?>"><?=$m->name?></option>
										<?endforeach;?>
									</select>
									</form>
								</div>
								
								<div id="slider-scroll" class="slider">
									<div class="logo-column">
										<div class="some10">
											<?foreach($manufacturers as $m):?>
												<div class="pic-block">
													<a href="<?=base_url()?><?=$menu_link?>/<?=$m->url?>">
														<img src="<?=$m->img->manufacturer_url?>" height="78" width="164" alt="<?=$m->name?>" class="logotype <?if($m->url == $manufacturer->url):?>active<?endif;?>" />
													</a>
												</div>
											<?endforeach;?>
										</div>
									</div>
								</div>
								
								<div id="scroll-content" class="catalog" style="overflow-y:scroll;">
									
									<h1 class="title">
										<?if(isset($active_category)):?><?=$this->string_edit->my_ucfirst($active_category->name)?> - <?endif;?><?=$manufacturer->name?> - <?=$doc_type?>
									</h1>
									
									<div class="catalog-head">
										<table>
											<tr>
												<td class="head-block1">
													<a href="http://<?=$manufacturer->link?>"><img src="<?=$manufacturer->img->manufacturer_url?>" alt="<?=$manufacturer->name?>"></a>
												</td>
												<td class="head-block2">
												<? if ($manufacturer->distributors):?>
														<p>Продавцы:</p>
														<p>Купить:</p>
												<?endif?>
												</td>
												<td class="cat-img">
													<div class="img-row">
														<ul class="img_box">
															<?foreach($manufacturer->distributors as $distributor):?>
																<li class="cat_img-0">
																	<a href="<?=base_url()?>vendor/<?=$distributor->url?>">
																		<img src="<?=$distributor->img->manufacturer_url?>" alt="<?=$distributor->name?>">
																	</a>
																</li>
															<?endforeach;?>
														</ul>
													</div>
												</td>
											</tr>
										</table>
									</div>
									
									<div class="catalog-menu clearfix">
										<p>Фабрика <span class="bold-text"><?=$manufacturer->name?></span> ( <a href="http://<?=$manufacturer->link?>"><?=$manufacturer->link?></a>, <?=$manufacturer->country?>) производит следующие группы товаров:</p>
										
										<div class="category">
											<?foreach($manufacturer->subcategories as $category):?>
												<div style="float:left;" class="point"><?=$category->name?></div>
											<?endforeach;?>
										</div>
									</div>
									
									<nav class="navigation-mini floating">
									
										<a href="<?=base_url()?><?=$menu_link?>/<?=$manufacturer->url?>/all" class="<?if($active_doc == 'all'):?>active<?endif;?>">Все документы</a>
										<a href="<?=base_url()?><?=$menu_link?>/<?=$manufacturer->url?>/catalogs" class="<?if($active_doc == 'catalogs'):?>active<?endif;?>">Каталоги</a>
										<a href="<?=base_url()?><?=$menu_link?>/<?=$manufacturer->url?>/prices" class="<?if($active_doc == 'prices'):?>active<?endif;?>">Прайсы</a>
										<a href="<?=base_url()?><?=$menu_link?>/<?=$manufacturer->url?>/collections" class="<?if($active_doc == 'collections'):?>active<?endif;?>">Брошюры по коллекциям</a>
										<a href="<?=base_url()?><?=$menu_link?>/<?=$manufacturer->url?>/tech" class="del <?if($active_doc == 'tech'):?>active<?endif;?>">Техническая информация</a>
								
										<div>
									<div class="main-a-0">
										&nbsp;
									</div>								
									<div class="main-a width-auto">
										<select name="" id="selectm" class="catalog_select" onchange="manufacturer_submit(this.value, '<?=$manufacturer->url?>');">
											<option <?if($active_category_item == ''):?>selected<?endif;?> value="manufacturer/">Все группы товаров</option>
											<?foreach($manufacturer->categories as $category):?>
												<option <?if($active_category_item == $category->url):?>selected<?endif;?> value="catalog/<?=$category->url?>"><?=$category->name?></option>
												<?if(!empty($category->childs)):?>
													<?foreach($category->childs as $ch):?>
														<option <?if($active_category_item == $ch->url):?>selected<?endif;?> value="catalog/<?if(isset($ch->parent_category_url)):?><?=$ch->parent_category_url?>/<?endif;?><?=$ch->url?>">&nbsp;&bull;&nbsp;<?=$ch->name?></option>
													<?endforeach;?>
												<?endif;?>
											<?endforeach;?>
										</select>
									</div>
									<div class="main-a-2 main-a-3">
										<?if($is_news):?>
											<script>
												var display_all_news = true;
												function toggleNews()
												{
													display_all_news = !display_all_news;
													if (display_all_news)
													{
														$('.news_item').show();
														$('.navigation-mini .main-a-2').css('color', '#39F');
													} else {
														$('.news_item').hide();
														$('.m_news-<?= $manufacturer->id ?>').show();
														$('.navigation-mini .main-a-2').css('color', '#f00');
													}
												}
											</script>
											<a onclick="toggleNews(); return false;" href="<?=base_url()?>articles/novosti?m_id=<?=$manufacturer->id?>" class="main-a-2 del-2 news_link">Новости <?=$manufacturer->name?></a>
										<?else:?>
											&nbsp;
										<?endif;?>
									</div> 
								</div>
                            </nav>
                            <div class="all-items">
								<?$cat_image_counter = 1?>
								<?foreach($manufacturer->documents as $doc):?>
									<div class="items clearfix">
										<div class="item-pic">
											<a href="<?=$doc->full_url?>" target="_blank">
												<?if($doc->images):?>
													<img src="<?=$doc->images[0]->catalog_small_url?>" height="237" width="170" alt="<?=$doc->name?>">
												<?endif;?>
											</a>
										</div>
										<div class="item-box clearfix">
											<div class="box-title">
												<a href="<?=$doc->full_url?>" <?= ($doc->type_icon == 'folder' ? 'onclick="$(\'#folder_'.$doc->id.'\').show();return false;"':'')?> class="blue" target="_blank"><?=$doc->name?></a>
												<a href="<?=$doc->full_url?>" <?= ($doc->type_icon == 'folder' ? 'onclick="$(\'#folder_'.$doc->id.'\').show();return false;"':'')?> class="<?= $doc->type_icon?>" target="_blank"></a>
											</div>
											<? if ($doc->type_icon == 'folder'): 
												$files = unserialize($doc->files);
												$out = array();
												foreach($files as $f)
												{
													if (isset($f['deleted']))
														continue;
													$out[] = $f['filename'];
												}
												asort($out);
												$outstr = '';
												foreach ($out as $f)
												{
													if (strstr($f, 'http://'))
													{
														$fname = explode('/', $f);
														$outstr .= '<p>&nbsp;&nbsp;&bull;&nbsp;<a style="text-decoration: underline;" href = "'.$f.'" target="_blank"><i>'.$fname[count($fname) - 1].'</i></a></p>';
													} else
														$outstr .= '<p>&nbsp;&nbsp;&bull;&nbsp;<a style="text-decoration: underline;" href = "/pdf/'.$doc->id.'/'.$f.'" target="_blank"><i>'.$f.'</i></a></p>';
												}
												echo '<div style="display: none; margin-top: 8px; font-size: 11px; clear: both;" id="folder_'.$doc->id.'">'.$outstr.'</div>';
											endif?>
											<div class="item-menu">
												<?foreach($doc->categories as $category):?>
													<div style="float:left;"><a href="#" class="point"><?=$category->name?></a></div>
												<?endforeach;?>
												<div style="clear: both;"></div>
												<div class="seo_description">
												<?=$doc->description?>
												</div>
											</div>
										
											<div id="catalog_img" class="catalog-row">
												<ul class="img_box">
													<?foreach($doc->images as $img):?>
														<li class="cat_img-<?=$cat_image_counter?>">
															<a href="<?=$img->full_url?>" class="fancybox" rel="gallery<?= $doc->id?>">
																<img src="<?=$img->catalog_small_url?>" alt="<?=$doc->name?>"/>
															</a>
														</li>
													<?endforeach;?>
												</ul>
											</div>
										</div>
									</div>
									<?$cat_image_counter++?>
								<?endforeach;?>
                            </div>
							
							<div class="seo_description">
								<?=$seo_description ? $seo_description : $manufacturer->description?>
							</div>

                        </div>
							</div>
						</article>
					</main>
				</div>
				
				<!-----leftcol------>
				<aside id="s_left">
					<h1><?=$above_menu_title?></h1>
					<?require "include/left_menu.php"?>
				</aside><!--end_leftcol-->
                   
				<!-----rightcol----->
                <aside id="s_right">
					<?require "include/news_collumn.php"?>
				</aside><!--end_rightcol-->
			</div>
		</div>
		<?require "include/manufacturer_script.php"?>
		<?require "include/footer.php"?>
	</body>
</html>