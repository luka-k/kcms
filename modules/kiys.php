<?php
	ini_set('display_errors', 1);
//	require_once '../aaplication/config/database.php';
	mysql_connect('localhost', 'admin_ltpro', 'ESEVw34Z0E');
	mysql_select_db('admin_ltpro');
	if ($_GET['get'] == 'paid')
	{
		$q = mysql_query('SELECT * FROM `kiys` WHERE timestamp>0');
		$out=array();
		while($r=mysql_fetch_assoc($q))
		{
			$r['date'] = date('d.m.Y H:i', ($r['timestamp'] + 4 * 60*60));
			$out[] = $r;
		}
		echo json_encode($out);//array(array('key' => '66655656563', 'date' => '01/17/2014', 'email' => 'aaa@bbb.ru')));
		die();
	}
	class LTKeys
	{
		public function getFreeKeys()
		{
			$q = mysql_query('SELECT * from `kiys` WHERE timestamp = 0 ORDER BY `key`');
			$out = array();
			while ($r = mysql_fetch_assoc($q))
			{
				$out[] = $r['key'];
			}
			return $out;
		}
		
		public function DrawTextArea()
		{
			$keys = implode("\n", $this->getFreeKeys());
			echo '<p>Неиспользованные ключи (каждый с новой строки):</p>';
			echo '<form action="" method="post"><textarea style="width: 300px; height: 500px;" name="keys">'.$keys.'</textarea><br /><input type="submit" value="Сохранить"></form>';
		}
		
	}
	
	if ($_POST['keys'])
	{
		$keys = explode("\n", $_POST['keys']);
		mysql_query('DELETE FROM `kiys` WHERE timestamp = 0');
		foreach ($keys as $key)
		{
			$key = trim($key);
			$key = str_replace('"', '', $key);
			if (!$key) continue;
			$q = mysql_query('SELECT FROM `kiys` WHERE `key` = "'.$key.'"');
			$r = mysql_fetch_assoc($q);
			if (!$r)
				mysql_query('INSERT INTO `kiys` (`key`) VALUES ("'.$key.'")');
		}
		header('Location: /modules/kiys.php');
		die();
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru">
<head>
  <meta charset="utf-8">
</head>
<body>
	<table>
	<tr>
	<td>
	<?php
	$k = new LTKeys();
	$k->DrawTextArea();
	?>
	</td>
	<td style="border-left: 0px solid black; border-right: 1px solid black;"> &nbsp;
	</td>
	<td style="vertical-align: top; !important;">
		<p>Использованные ключи:</p>
		<table>
		<thead>
			<th style="border-left: 0px solid black; border-right: 1px solid black;">Ключ</th>
			<th style="border-left: 0px solid black; border-right: 1px solid black;">Дата</th>
			<th>Email</th>
		</thead>
		<tr>
			<td style="border-left: 0px solid black; border-right: 1px solid black;padding: 10px;">666666666</td>
			<td style="border-left: 0px solid black; border-right: 1px solid black;padding: 10px;">16.01.2014</td>
			<td>test@test.te</td>
		</tr>
		<tr>
			<td style="border-left: 0px solid black; border-right: 1px solid black;padding: 10px;">7777777</td>
			<td style="border-left: 0px solid black; border-right: 1px solid black;padding: 10px;">16.01.2014</td>
			<td>test2@test.te</td>
		</tr>
		</table>
	</td>
	</tr>
	</table>
</body>
</html>