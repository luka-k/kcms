<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Import_module
*
* @package		kcms
* @subpackage	controllers
* @category	    import_module
*/
class Import_module extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('import');
	}
	
	public function import_xml($publisher)
	{
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$xml_content = file_get_contents(FCPATH.'/import/'.$publisher.'.yml');

		ini_set('display_errors', 1);
		$xml = simplexml_load_string($xml_content);
		
		//$this->import->import_categories($xml->shop->categories);
		
		$this->import->import_offers($xml->shop->offers);
		
		echo "<a href='".base_url()."admin'>На главную</a>";
	}
	
	public function import_struct()
	{
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$this->import->importCategoriesFromHtml(file_get_contents(FCPATH.'/import/main.html'));
		
		echo "<a href='".base_url()."admin'>На главную</a>";
		
	}
	
	public function generate_pearson_yml()
	{
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$typesRules = array(
			"CD" => "CD",
			"CDs" => "CD",
			"Teacher's Book" => "Teacher's Book",
			"Student's Book" => "Student's Book"
		);
		
		$booksInfo = array();
		
		$bookxml = simplexml_load_string(file_get_contents(FCPATH."/import/pearsonOnix.xml"));
		
		if($bookxml->Product) foreach($bookxml->Product as $product)
		{
			//var_dump($product);

			if($product->ProductIdentifier) foreach($product->ProductIdentifier as $productId)
			{
				if((string)$productId->ProductIDType == '03' || (string)$productId->ProductIDType == '15')
				{
					$isbn = (string)$productId->IDValue;
					break;
				}
			}
			$name = htmlentities((string) $product->Title->TitleText);
			
			//Получаем строку авторов
			$autors = '';
			$key = 0;
			if($product->Contributor) foreach($product->Contributor as $contributor)
			{
				if($key <> 0) $autors .= ', ';
				$autors .= (string) $contributor->PersonName;
				$key++;
			}
			
			// Размеры, вес
			$height = '';
			$width = '';
			$depth = '';
			$weight = '';
			if($product->Measure) foreach($product->Measure as $measure)
			{
				switch ((string)$measure->MeasureTypeCode) {
					case 01:
						$height = (string)$measure->Measurement;
						break;
					case 02:
						$width = (string)$measure->Measurement;
						break;
					case 03:
						$depth = (string)$measure->Measurement;
						break;
					case 08:
						$weight = (string)$measure->Measurement;
						break;
				}
			}
			
			//Получаем типы книг
			$types = array();
			foreach($typesRules as $rule => $type)
			{
				if(strpos($name, $rule) !== false) $types[] = $type;
			}
			
			$publisher = (string)$product->Publisher->PublisherName;
			
			$booksInfo[$isbn] = array(
				'publisher' => $publisher,
				'name' => str_replace('&', '&amp;', $name),
				'autors' => $autors,
				'height' => $height,
				'width' => $width,
				'depth' => $depth,
				'weight' => $weight,
				'types' => $types,
				'year' => (string)$product->CopyrightYear
			);
		}
		
		unset($bookxml);
				
		if (($handle = fopen(FCPATH."/import/pearson.csv", "r")) !== FALSE) {
			$xml = '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="2015-12-18 02:01">
<shop><offers>';
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$name = ($data[0]);
				$isbn = $data[1];
				$category = $data[2];
					
				$image = 'http://www.pearson.ch/bild.aspx?id='.$isbn.'.jpg';
				if (is_numeric($data[1]) && $data[1] > 0) {
					$category = $this->categories->get_item_by(array('name' => $category));
					
					if ($category)
					{
						if(!isset($booksInfo[$isbn])) continue;
						$types = $booksInfo[$isbn]['types'];
						echo $isbn." - ".$booksInfo[$isbn]['name']."<br/>";
						
						$xml .= '<offer id="'.$isbn.'" available="true">
	<url></url>	
		<price>0</price>
	<currencyId>RUB</currencyId>
	<categoryId>'.$category->id.'</categoryId>
	<picture>'.$image.'</picture>
	<delivery>true</delivery>
	<author>'.$autors.'</author>
	<name>'.$booksInfo[$isbn]["name"].'</name>
	<height>'.$booksInfo[$isbn]["height"].'</height>
	<width>'.$booksInfo[$isbn]["width"].'</width>
	<depth>'.$booksInfo[$isbn]["depth"].'</depth>
	<weight>'.$booksInfo[$isbn]["weight"].'</weight>
	<year>'.$booksInfo[$isbn]["year"].'</year>
	<description></description>
	<characteristics>
		<characteristic><type>Издательство</type><value>'.$booksInfo[$isbn]["publisher"].'</value></characteristic>';
	if(!empty($types))foreach($types as $type)
	{
		$xml .= '<characteristic><type>Тип</type><value>'.$type.'</value></characteristic>';
	}	
					$xml .= '</characteristics><sales_notes/></offer>';
					}
				}
				
			}
			fclose($handle);
			$xml .= '</offers></shop></yml_catalog>';
			file_put_contents(FCPATH."/import/pearson.yml", $xml);
		}
		
		echo "<a href='".base_url()."admin'>На главную</a>";
	}
	
	public function generate_macmillan_yml()
	{
		$typesRules = array(
			"CD" => "CD",
			"CDs" => "CD",
			"Teacher's Book" => "Teacher's Book",
			"Student's Book" => "Student's Book"
		);
		
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		if (($handle = fopen(FCPATH."/import/macmillan.csv", "r")) !== FALSE) {
			$xml = '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="2015-12-18 02:01">
<shop><offers>';
			while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
				$name = ($data[1]);
				$isbn = $data[2];
				$category = $data[3];
				
				$image = 'http://bookhouse2.ribaweb.ru/import/macmillan/'.$isbn.'.jpg';
				if (is_numeric($data[2]) && $data[2] > 0) {
					$category = $this->categories->get_item_by(array('name' => $category));
					if ($category) {
						if(!is_file(FCPATH."/import/macmillan/".$isbn.'_ONIX.xml')) continue;
						$bookxml = simplexml_load_string(file_get_contents(FCPATH."/import/macmillan/".$isbn.'_ONIX.xml'));
						//var_dump($bookxml);
						
						// Название книги
						$name = htmlentities((string)$bookxml->Title->TitleText);
						echo $isbn." - ".$name."<br />";
						
						//Получаем строку авторов
						$autors = '';
						$key = 0;
						if($bookxml->Contributor) foreach($bookxml->Contributor as $contributor)
						{
							if($key <> 0) $autors .= ', ';
							$autors .= (string) $contributor->PersonName;
							$key++;
						}
						
						// Размеры, вес
						$height = '';
						$width = '';
						$depth = '';
						$weight = '';
						if($bookxml->Measure) foreach($bookxml->Measure as $measure)
						{
							switch ((string)$measure->MeasureTypeCode) {
								case 01:
									$height = (string)$measure->Measurement;
									break;
								case 02:
									$width = (string)$measure->Measurement;
									break;
								case 03:
									$depth = (string)$measure->Measurement;
									break;
								case 08:
									$weight = (string)$measure->Measurement;
									break;
							}
						}
												
						//Получаем типы книг
						$types = array();
						foreach($typesRules as $rule => $type)
						{
							if(strpos($name, $rule) !== false) $types[] = $type;
						}
			
						$xml .= '<offer id="'.$isbn.'" available="true">
		<url></url>	
			<price>0</price>
		<currencyId>RUB</currencyId>
		<categoryId>'.$category->id.'</categoryId>
		<picture>'.$image.'</picture>
		<delivery>true</delivery>
		<author>'.$autors.'</author>
		<name>'.$name.'</name>
		<height>'.$height.'</height>
		<width>'.$width.'</width>
		<depth>'.$depth.'</depth>
		<weight>'.$weight.'</weight>
		<year>'.(string)$bookxml->YearFirstPublished.'</year>
		<description></description>
		<characteristics>
			<characteristic><type>Издательство</type><value>'.(string)$bookxml->RecordSourceName.'</value></characteristic>';
			
						if(!empty($types))foreach($types as $type)
						{
							$xml .= '<characteristic><type>Тип</type><value>'.$type.'</value></characteristic>';
						}
						$xml .= '</characteristics><sales_notes/></offer>';
					}
				}
				
			}
			fclose($handle);
			
			$xml .= '</offers></shop></yml_catalog>';
			file_put_contents(FCPATH."/import/macmillan.yml", $xml);
		}
		
		
		echo "<a href='".base_url()."admin'>На главную</a>";
	}
}