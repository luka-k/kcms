<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CatalogImport
{
	public function ImportImages()
	{
		die('done');
		$CI =& get_instance();
		$products = $CI->products->get_list();
		foreach ($products as $p)
		{
			$fname = 'download/images/products/'.iconv('utf-8', 'windows-1251', $p->sku).'.jpg';
			if (file_exists($fname))
			{
				$fname = str_replace('download/images/', '', $fname);
				$CI->images->insert(array('object_type' => 'products', 'object_id' => $p->id, 'is_cover' => 1, 'url' => $fname));
				echo $fname.'<br>';
			} else
			{
				$fname = str_replace('download/images/', '', $fname);
				$fname = str_replace('.jpg', '.JPG', $fname);
				if (file_exists($fname))
				{
					$CI->images->insert(array('object_type' => 'products', 'object_id' => $p->id, 'is_cover' => 1, 'url' => $fname));
					echo $fname.'<br>';
				} else
					echo '-';
			}

		}
		return;
		
		$rows = explode("\n", file_get_contents('screenimages.txt'));
		foreach ($rows as $row)
		{
			$cols = explode("\t", $row);
			$screen = $CI->categories->get_item_by(array('name' => $cols[5]));
			if ($screen)
			{
				$CI->images->insert(array('object_type' => 'categories', 'object_id' => $screen->id, 'is_cover' => 1, 'url' => $cols[2]));
			}
		}
		return;
		$screens = $CI->categories->get_list();
		foreach ($screens as $s)
		{
			$name = $s->name;
			//if (file_exists
			echo $name.';';
			continue;
			$CI->images->insert(array(
				'object' => 'screens',
				'object_id' => $s->id,
				'url' => '/screens/'.$s->name.'.png'
			));
		}
		return;
		$products = $CI->products->get_list();
		foreach ($products as $p)
		{
			$im = $CI->images->get_item_by(array('object' => 'products', 'object_id' => $p->id));
			if (!$im)
			{
				$CI->images->insert(array(
					'object' => 'products',
					'object_id' => $p->id,
					'url' => '/products/'.trim($p->sku).'.JPG'
				));
				echo '+';
			} else {
				echo '-';
			}
		}
	}
	
	public function Import($dataFile)
	{
		$CI =& get_instance();
		$CI->load->library(array('CSVReader'));
		$CI->load->helper('translit');
		$CI->csvreader->enclosure = "";
		$csv = $CI->csvreader->parse_file($dataFile);
		foreach($csv as $el)
		{
		
			$engines = explode('/', $el['модель двигателя/трансмиссии']);
			foreach ($engines as $e)
			{
				$e = trim($e);
				if (!$e) continue;
				$_engine = $CI->categories->get_item_by(array('name' => $e));
				if (!$_engine)
				{
					$CI->categories->insert(array(
						'name' => $e,
						'url' => slug($e),
						'is_active' => 1
					));
				}
				$_engine = $CI->categories->get_item_by(array('name' => $e));
				
				$systems = explode('/', $el['принадлежность к системе двигателя/трансмиссии']);
				foreach ($systems as $e)
				{
					$e = trim($e);
					if (!$e) continue;
					$_system = $CI->categories->get_item_by(array('name' => $e, 'parent_id' => $_engine->id));
					if (!$_system)
					{
						$CI->categories->insert(array(
							'name' => $e,
							'url' => slug($e),
							'parent_id' => $_engine->id,
							'is_active' => 1
						));
					}
					$_system = $CI->categories->get_item_by(array('name' => $e, 'parent_id' => $_engine->id));
					
					$screens = explode('/', $el['скрин шот']);
					$numbers = explode('/', $el['номер на рисунке']);
					foreach ($screens as $i=>$e)
					{
						$e = trim($e);
						if (!$e) continue;
						$eng = explode(' ', $e);
						if (!strstr($_engine->name, trim($eng[0]))) continue;
						$_screen = $CI->categories->get_item_by(array('name' => $e, 'parent_id' => $_system->id));
						if (!$_screen)
						{
							$CI->categories->insert(array(
								'name' => $e,
								'url' => slug($e),
								'parent_id' => $_system->id,
								'is_active' => 1
							));
						}
						$_screen = $CI->categories->get_item_by(array('name' => $e, 'parent_id' => $_system->id));
		
		
						$product = $CI->products->get_item_by(array('sku' => trim($el['Артикул']), 'parent_id' => $_screen->id));
						$shortdesc = '';
						$desc = '';
						if (strstr($el['модель двигателя/трансмиссии'], 'Cummins ISF 2,8'))
						{
							$shortdesc = $el['Наименование'].' ГАЗель Бизнес, ГАЗель Некст (Next), ГАЗель Дизель, Cummins ISF 2.8, применяется в автомобилях ГАЗ -3302, ГАЗ- 33023, ГАЗ- 330232, ГАЗ - 330202, ГАЗ -2705, ГАЗ -27057, ГАЗ- 3221, ГАЗ- 32213, СОБОЛЬ «БИЗНЕС» моделей ГАЗ -2752, ГАЗ -22171, ГАЗ -22171 СОБОЛЬ-БАРГУЗИН «БИЗНЕС» ГАЗ -2217, Foton Aumark, ПАЗ-3204, Газель «Next» (Нэкст).';
						} else if (strstr($el['модель двигателя/трансмиссии'], 'Cummins ISF 3,8'))
						{
							$shortdesc = $el['Наименование'].' ПАЗ-3204, ГАЗ Валдай, ГАЗ-33104, Валдай Камминз (Валдай Cummins)';
						} else
						{
							$shortdesc = $el['Наименование'].' Камаз Камминз, КАМАЗ Cummins';
						}
							$desc = nl2br($el['Наименование'].' купить эти и другие запчасти Камминз (Cummins) можно в Санкт-Петербурге. Доставка в любые регионы России осуществляется в день обращения (оплаты). Всегда в наличии оригинальные запчасти Cummins (Камминз, Каменц, Камменц, Каминз).  Вы можете, обратившись к нам  на сайт и самостоятельно подобрав необходимые запчасти используя:
			- каталог Cummins ISF 2,8
			- каталог Cummins ISF 3,8;
			- каталог Cummins 4ISBe;
			- каталог Cummins 6ISBe;
			Кроме того можно обратиться к нашим квалифицированным специалистам и они с удовольствием быстро окажут помощь в подборе необходимых товаров.  Для клиентов из Санкт-Петербурга осуществляется доставка в пределах города бесплатно при заказе на сумму более 5000 рублей. Также осуществляется доставка во все регионы России. 
			Все запчасти оригинальные, соответствуют высоким стандартам качества Cummins (Камминз, Каминз, Каменц, Камминц). На все запасные части, купленные у ООО «АвтоПауэр» на сайте www.autocummins.ru предоставляется гарантия завода изговтовителя (BFCEC – Beijing Foton Cummins Engine Company или DCEC – Dongfeng Cummins Engine Company)  – 6 месяцев. ');
						if ($product)
							$CI->products->update($product->id, array(
								'name' => $el['Наименование'],
								'sku' => $el['Артикул'],
								'weight' => $el['вес/кг'],
								'number' => trim($numbers[$i]),
								'manufacturer' => $el['Производитель'],
								'url' => slug($el['Наименование']),
								'price' => str_replace(',', '.', $el['цена']),
								'description_short' => $shortdesc,
								'description' => $desc,
								'is_active' => 1,
								'parent_id' => $_screen->id
							));
						else
							$CI->products->insert(array(
								'name' => $el['Наименование'],
								'sku' => $el['Артикул'],
								'weight' => $el['вес/кг'],
								'number' => trim($numbers[$i]),
								'manufacturer' => $el['Производитель'],
								'url' => slug($el['Наименование']),
								'price' => str_replace(',', '.', $el['цена']),
								'description_short' => $shortdesc,
								'description' => $desc,
								'is_active' => 1,
								'parent_id' => $_screen->id
							));
					}
				}
			}
		}
	}
	
	public function ImportProducts($dataFile)
	{
		$CI =& get_instance();
		$CI->load->helper('translit');
		$rows = explode("\n", file_get_contents($dataFile));
		$counter = 0;
		$cid = 0;
		echo '<pre>';
		foreach ($rows as $i => $row) 
		{
			if ($counter == 0)
			{
				$el = explode("=>", $row);
				$counter = $el[1];
				$cid = $el[0];
			} else {
				//if ($i++ > 10 || $i < 4) continue;
				echo $counter.':'.$cid.'->'.$row."\n";
				$counter = $counter-1;
				
				$content = file_get_contents(trim("http://vdk-spb.ru".$row));
				$out = false;
				preg_match_all('{<section id="content">(.*?)</section>}s', $content, $out, PREG_PATTERN_ORDER);
				
				if (count($out) < 2 || !is_array($out[1])) 
				{
					echo "error in content\n";
					continue;
				}
				
				$content = $out[1][0];
				preg_match_all('{<div class="field-item even">(.*?)</div>}s', $content, $out, PREG_PATTERN_ORDER);
				
				if (count($out) < 2 || !is_array($out[1])) 
				{
					echo "error in product\n";
					continue;
				}
				
				$name = $out[1][0];
				$image = $out[1][1];
				
				echo $name."\n";
				echo htmlspecialchars($image)."\n\n";
				
				$description = "";
				$characteristics = "";
				for ($j = count($out[1])-1; $j > 1 ; $j--)
				{
					if (strstr($out[1][$j], '<table'))
						$characteristics .= $out[1][$j];
					else
						$description .= $out[1][$j];
				}	
				$pid = $CI->products->insert(array(
					'name' => $name,
					'description' => $description,
					'characteristics' => $characteristics,
					'url' => slug($name),
					'category_id' => $cid,
					'sku' => '00'.($i+2),
					'is_active' => 1,
					'available' => 1
				));
				
				$CI->images->insert(array(
					'object' => 'product',
					'object_id' => $pid,
					'title' => $name,
					'url' => $image
				));
				
			}
		}
	}
}