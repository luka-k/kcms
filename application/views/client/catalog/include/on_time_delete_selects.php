<div class="manufacturer-select">
										<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="manufacturer-form" class="filter-form" action="<?=base_url()?>shop/manufacturer/" >
										<select name="" class="dropdown" onchange="manufacturer_submit('catalog/<?=$a_link?>',this.options[this.selectedIndex].value);">
											<option value="" disabled="" selected="selected" >����� �������������</option>
											<?foreach($manufacturers as $m):?>
												<option value="<?=$m->url?>"><?=$m->name?></option>
											<?endforeach;?>
										</select>
										</form>
									</div>
									

<div class="manufacturer-select">
										<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="manufacturer-form" class="filter-form" action="<?=base_url()?>shop/manufacturer/" >
										<select name="" class="dropdown" onchange="manufacturer_submit('vendor', this.options[this.selectedIndex].value);">
											<option value="" disabled="" selected="selected" >����� ��������</option>
											<?foreach($vendors as $v):?>
												<option value="<?=$v->url?>"><?=$v->name?></option>
											<?endforeach;?>
										</select>
										</form>
									</div>									
									
									
									
<div class="manufacturer-select">
										<form method="post" accept-charset="utf-8"  enctype="multipart/form-data" id="manufacturer-form" class="filter-form" action="<?=base_url()?>shop/manufacturer/" >
										<select name="" class="dropdown" onchange="manufacturer_submit('podrjadchiki/<?=$a_link?>',this.options[this.selectedIndex].value);">
											<option value="" disabled="" selected="selected" >����� ����������</option>
											<?foreach($contractors as $�):?>
												<option value="<?=$�->url?>"><?=$�->name?></option>
											<?endforeach;?>
										</select>
										</form>
									</div>