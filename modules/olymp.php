<?php
	define('DB_NAME', 'db_ourhouse_5');
	define('DB_USER', 'dbu_ourhouse_4');
	define('DB_PASSWORD', 'i6MPuy4H8Qh');
	define('DB_HOST', 'mysql.ourhouse.z8.ru');
	mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	mysql_select_db(DB_NAME);
	
	$q = mysql_query('SELECT * FROM `olymp_payment`');
	$data = array();
	while ($r = mysql_fetch_assoc($q))
	{
		$el = explode('|', $r['name']);
		$out['email'] = trim($el[1]);
		$out['name'] = trim($el[0]);
		$data[] = $out;
	}
	echo json_encode($data);
?>