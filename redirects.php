<?php
	$redirects = array(
		'/category/ielts/rezul-taty-testirovaniya/' => 'http://lt-pro.ru/category/ielts/rezultaty-ielts-on-line',
		'/category/study/cambridge-placement-test/' => '/category/study/oplata-cambridge-placement-test'
	);
	
	if (isset($redirects[$_SERVER['REQUEST_URI']]))
	{
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.$redirects[$_SERVER['REQUEST_URI']]);
		exit();
	}
?>