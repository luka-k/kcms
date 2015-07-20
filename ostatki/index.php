<?php
	$manufacturers = array();
		
	function load1C()
	{
		$xmlstr = file_get_contents('/home/admin/web/shop.brightbuild.ru/public_html/1c_exchange/import0_1.xml');
		$xml = new SimpleXMLElement($xmlstr);
		$out = array();
		
		foreach($xml->Каталог->Товары->Товар as $el)
		{
			$data = array();
			$data['manufacturer'] = (string) $el->Изготовитель->Наименование;
			$id = (string) $el->Ид;
			
			foreach ($el->ЗначенияРеквизитов->ЗначениеРеквизита as $param)
			{
				switch ((string) $param->Наименование)
				{
					case 'Полное наименование':
						$data['name'] = (string) $param->Значение;
						break;
					case 'Распродажа':
						$data['sale'] = (string) $param->Значение;
						break;
				}
			}
			$out[$id] = $data;
		}
		return $out;
	}
		
		
	function load1COffers()
	{
		global $manufacturers;
		
		$catalog = load1C();
		
		$xmlstr = file_get_contents('/home/admin/web/shop.brightbuild.ru/public_html/1c_exchange/offers0_1.xml');
		$xml = new SimpleXMLElement($xmlstr);
		$products = array();
		$sorts = array();
		$manufacturer_names = array();
		$_manufacturers = array();
		
		foreach($xml->ПакетПредложений->Предложения->Предложение as $el)
		{
			$id = (string) $el->Ид;
			$sku = (string) $el->Артикул;
			$name = $catalog[$id]['name'];
			$manufacturer = $catalog[$id]['manufacturer'];
			$sale = $catalog[$id]['sale'] == 'true' ? 1 : 0;
			$ei = '';
			
			$qty = (string) $el->Количество;
			$price = 0;
			foreach ($el->Цены->Цена as $p)
			{
				if ((string) $p->ИдТипаЦены == 'd791f4bd-76e9-11e4-a943-e8de2701d5f9')
				{
					$_price = (string) $p->ЦенаЗаЕдиницу;
					$ei = (string) $p->Единица;
					if ($_price)
						$price = $_price.'&nbsp;'.(string) $p->Валюта;
				}
			}
			if ($qty)
			{
				$_manufacturers[] = $manufacturer;
				$manufacturer_names[] = $manufacturer;
				if ($_POST['manufacturer'] && $_POST['manufacturer'] != $manufacturer)
					continue;
				if (isset($_GET['sale']) && !$sale) continue;
				$products[] = array(
					'price' => $price,
					'name' => $name,
					'sku' => $sku,
					'sale' => $sale,
					'ei' => $ei,
					'manufacturer' => $manufacturer,
					'qty' => $qty
				);
				$sorts[] = $name;
			}
		}
		array_multisort($manufacturer_names, $_manufacturers);
		foreach ($_manufacturers as $m)
			$manufacturers[$m] = $m;
		array_multisort($sorts, $products);
		
		return $products;
	}
	$products = load1COffers();
	
?>

<!DOCTYPE html>
<html><head>
<title>Остатки</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="description" content="" />
<meta name="copyright" content="" />
<link rel="stylesheet" type="text/css" href="css/kickstart.css" media="all" />                  <!-- KICKSTART -->
<link rel="stylesheet" type="text/css" href="style.css" media="all" />                          <!-- CUSTOM STYLES -->
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/kickstart.js"></script>  


</head><body>


<div class="grid">
	
	
<div class="col_12">
	<form action="" method="post" id="form"> 
	<p><strong>Остатки СПб <?= date('d.m.Y', filectime('/home/admin/web/shop.brightbuild.ru/public_html/1c_exchange/offers0_1.xml'));?> 
	</strong>
	
	&nbsp;&nbsp;&nbsp;
	Производитель: <select name="manufacturer" onchange="$('#form').submit();">
	<option value="">Все</option>
	<?foreach ($manufacturers as $i => $m): ?>
	 <option <?= $_POST['manufacturer'] == $m ? 'selected' : '' ?> value="<?= $m?>"><?= $m?></option>
	<?endforeach?>
	</select>
	<!--<input type="submit" name="ok" value="ok" /> -->
	&nbsp;&nbsp;&nbsp;
	<?if (!isset($_GET['sale'])): ?><a href="/ostatki?sale">распродажа</a><?else: ?><a href="/ostatki">все товары</a><?endif?>
	</p></form>
	<table class="striped">
	<thead>
	<tr>
	<th>Артикул</th>
	<th>Наименование</th>
	<th style="white-space: nowrap">Кол-во</th>
	<th>е.и.</th>
	</tr>
	</thead>
	<tbody>
	<? foreach ($products as $p): ?>
	<tr style="<?=$p['sale'] ? 'color: #dd8500': ''?>">
	<td><?= $p['sku']?></td>
	<td><?= $p['name']?></td>
	<td style="text-align: center;"><?= $p['qty']?></td>
	<td><?= str_replace('PCE', 'шт.', $p['ei'])?></td>
	<? endforeach ?>
	</tr>
	</tbody>
	</table>
</div>
</div><!-- END GRID -->

</body></html>