<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Import extends Admin_Controller 
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function caption()
	{
		$categories = $this->categories->get_list();
		foreach ($categories as $c)
		{
			$this->categories->update($c->id, array('caption' => strip_tags($c->description), 'description' => ''));
		}
	}
	
	public function screen()
	{
		echo '<pre>';
		$this->load->library(array('CSVReader'));
		$this->csvreader->enclosure = '"';
		$this->csvreader->separator = ';';
		$csv = $this->csvreader->parse_file('screens.csv');
		$screens = array();
		foreach($csv as $el)
		{
			$screens[$el['name']] = $el['description'];
		}
		foreach($screens as $name => $desc)
		{
			$c = $this->categories->get_item_by(array('name' => $name));
			$this->categories->update($c->id, array('description' => $desc));
		}
	}
	
	public function load1COffers()
	{
		$xmlstr = file_get_contents('download/1c/offers.xml');
		$xml = new SimpleXMLElement($xmlstr);
		$out = array();
		foreach($xml->ПакетПредложений->Предложения->Предложение as $el)
		{
			$id = (string) $el->Ид;
			foreach ( $el->Цены->Цена as $price)
			{
				if ((string) $price->ИдТипаЦены == 'a0348d9d-f354-11e2-a3b2-005056993ef4')
				{
					$out[$id] = (string) $price->ЦенаЗаЕдиницу;
				}
			}
		}
		return $out;
	}
	
	public function load1C()
	{
		$prices = $this->load1COffers();
		$xmlstr = file_get_contents('download/1c/import.xml');
		$xml = new SimpleXMLElement($xmlstr);
		$i = 0;
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		$c = 0; 
		$total = 0;
		foreach($xml->Каталог->Товары->Товар as $el)
		{
			$total++;
			$id = (string) $el->Ид;
			$sku = (string) $el->Артикул;
			$name = (string) $el->Наименование;
			$data = array();
			
			foreach ($el->ЗначенияРеквизитов->ЗначениеРеквизита as $param)
			{
				switch ((string) $param->Наименование)
				{
					case 'Вес':
						$data['weight'] = (string) $param->Значение;
						break;
				}
			}
			$product = $this->products->get_item_by(array('sku' => $sku));
			if ( $product)
			{
				if (!isset($prices[$id]))
				{
					echo 'ERROR: Не найдена цена у '.$sku."\n";
				} else {
					$this->products->update($product->id, array('price' => ($prices[$id])));
					echo 'OK: Обновлена цена у '.$sku.": ".$prices[$id]."\n";
				}
			} else {
				echo 'ERROR: На сайте не найден товар из 1C: '.$sku."\n";
			}
			 
		}
	}
	
	public function index()
	{
		if (!$_FILES['csv']['error'])
		{
			$c = file_get_contents($_FILES['csv']['tmp_name']);
			$c = iconv('windows-1251', 'utf-8', $c);
			file_put_contents('download/csv/test.csv', $c);
		}
		$this->load->library('catalogImport');
		$this->catalogimport->Import('download/csv/test.csv');
		die('ok');
	}
	
	public function importimages()
	{
		$this->load->library('catalogImport');
		$this->catalogimport->ImportImages();
		die('ok');
	}
	
}