<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
* Возможно лучше не помошником а библиотекой сделать и $urlToPost, $userid, $apiid и тд. держать в конфиге
*/
function send_sms($numbermob, $message)
{
	$urlToPost = "http://api.smsdostup.ru/_sms_dispatch_xml.php";

	$tempString = "";
	$dom = new domDocument("1.0", "utf-8");
	$root = $dom->createElement("request");
	$dom->appendChild($root);
	$userid = "25096";
	$apiid = "3b36bc0ce994eee32ed041cc5c740106";
	$root->appendChild($dom->createElement("userid", $userid));
	$sessionid = md5(uniqid(microtime()) . $_SERVER['REMOTE_ADDR']);
	
	if(isset($_SERVER['HTTP_USER_AGENT'])) $sessionid .= $_SERVER['HTTP_USER_AGENT']; //У меня выводит  Undefined index: HTTP_USER_AGENT по этому через if, если вообще надо?
	
	$md5hash = md5($sessionid . $userid . $apiid);
	$root->appendChild($dom->createElement("sessionid", $sessionid));
	$root->appendChild($dom->createElement("md5hash", $md5hash));
	$root->appendChild($dom->createElement("sender", "NovyiSvet"));
	//$root->appendChild($dom->createElement("message", "test"));
	$recepients = $dom->createElement("recepients");

	if (strlen($numbermob) == 11 ){
		$number = $dom->createElement("entry", $message);
		$number->setAttribute("phone", $numbermob);
		$recepients->appendChild($number); 
	}

	$root->appendChild($recepients);

	$soap = curl_init($urlToPost);
	curl_setopt($soap, CURLOPT_POST, 1);
	curl_setopt($soap, CURLOPT_RETURNTRANSFER, 1);

	$request = $dom->saveXML();

	curl_setopt($soap, CURLOPT_HTTPHEADER,
		array('Content-Type: text/xml; charset=utf-8',
			'Content-Length: '.strlen($request)));

	curl_setopt($soap, CURLOPT_POSTFIELDS, $request);
	$response = curl_exec($soap);
	curl_close($soap);

	echo $response;
	//echo $request;
	$dom->save("users.xml");

}