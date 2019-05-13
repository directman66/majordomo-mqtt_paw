<?php
$this->getConfig();
//$host='https://'.$this->config['HTTPS_API_URL'].':8080/api/user/device';
$host='http://192.168.1.39:8081/majordomo';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $host);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
/*
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
 'GET /majordomo HTTP/1.1'

)); 
*/
$response = curl_exec($ch);
curl_close($ch);
debmes('[http] +++ '.$response, 'cycle_mqtt_paw_debug');




	



?>
