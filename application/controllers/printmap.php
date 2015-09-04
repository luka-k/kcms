<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Printmap extends Client_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function real($id)
	{
		$article = $this->articles->prepare($this->articles->get_item($id));
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BrightBerry - Карта</title>
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
	$("#myprinter").click();
});
</script>
</head>
<body>
  <p><img src="<?=$article->img[count($article->img)-1]->catalog_big_url?>" width="531" alt=""></p>
  <?= $article->description?>
  <p><a href="" id = "myprinter" class="printer" onclick="window.print();return false;">Печать</a></p>
</body>
</html>
		<?
	}
	
	public function ymap($id)
	{
		$article = $this->articles->prepare($this->articles->get_item($id));
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BrightBerry - Карта</title>
<!--[if lt IE 9]>
<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
<![endif]-->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {	
	$("#myprinter").click();
});
</script>
</head>
<body>
  <p><img src="<?= str_replace('280,200', '500,400', $article->map2)?>" /></p>
  <?= $article->description?>
  <p><a href="" id = "myprinter" class="printer" onclick="window.print();return false;">Печать</a></p>
</body>
</html>
		<?
	}
}