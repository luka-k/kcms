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
	
	public function import_xml()
	{
		echo '<head><meta charset="UTF-8"></head><body><pre>';
		
		$xml_content = file_get_contents(FCPATH.'/import/pearson.yml');
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
					$xml .= '<offer id="'.$isbn.'" available="true">
	<url></url>	
		<price>0</price>
	<currencyId>RUB</currencyId>
	<categoryId>'.$category->id.'</categoryId>
	<picture>'.$image.'</picture>
	<delivery>true</delivery>
	<name>'.str_replace('&', '&amp;', $name).'</name>
	<description></description>
	<sales_notes/></offer>';
				}
			}
			fclose($handle);
			$xml .= '</offers></shop></yml_catalog>';
			file_put_contents(FCPATH."/import/pearson.yml", $xml);
		}
		
		echo "<a href='".base_url()."admin'>На главную</a>";
	}
}