<?php
chdir(dirname(__FILE__) . '/../');
include_once("./config.php");
include_once("./lib/loader.php");
include_once("./lib/threads.php");
include_once("./lib/websockets/sonoffws.class.php");
//include_once("./lib/websockets/client/lib/class.websocket_client.php");

set_time_limit(0);
// connecting to database
$db = new mysql(DB_HOST, '', DB_USER, DB_PASSWORD, DB_NAME);
include_once("./load_settings.php");
include_once(DIR_MODULES . "control_modules/control_modules.class.php");
$ctl = new control_modules();
include_once(DIR_MODULES . 'mqtt_paw/mqtt_paw.class.php');

$paw_module = new mqtt_paw();
$paw_module->getConfig();



//if ($this->config['MQTT_ENABLE']<>"1")    exit; // no devices added -- no need to run this cycle
echo date("H:i:s") . " running " . basename(__FILE__) . PHP_EOL;
$latest_check=0;
//$checkEvery=$paw_module->config['POLL_PERIOD'];
$checkEvery=1;
//websockets
//$wssurl=$dev_sonoff_module->getWssUrl();
//$sonoffws = new SonoffWS($wssurl, $config);
//$ws=new WebsocketClient("http:\\localhost:8081/majordomo");
debmes('cycle_starting', 'mqtt_paw');
//$ws=new WebsocketClient("http://192.168.1.39", 8081, 'majordomo');
//$ws=new WebsocketClient("http://localhost", 8081, 'majordomo');
//$url="http://127.0.0.1:8081/majordomo";
$url="wss://127.0.0.1:8081/majordomo";
//$url="http://192.168.1.39:8081/majordomo";
//$url="wss://192.168.1.39:8081/majordomo";
//$url="wss://eu-pconnect2.coolkit.cc";

//$url="wss://127.0.0.1:8081/majordomo";

$ws=new SonoffWS($url, $config);
$ws->socketUrl=$url;
$ws->connect();


debmes($ws, 'mqtt_paw');

while (1)
{
   setGlobal((str_replace('.php', '', basename(__FILE__))) . 'Run', time(), 1);
   echo date('Y-m-d H:i:s').' Polling devices...';
/*
//====================================HTTP POLLING===================================
   setGlobal((str_replace('.php', '', basename(__FILE__))) . 'Run', time(), 1);
   //http polling devices
   if ((time()-$latest_check)>$checkEvery) {
    $latest_check=time();
    echo date('Y-m-d H:i:s').' Polling devices...';
//    $paw_module->processCycle();
//	   }
//====================================END HTTP POLLING===============================  

*/

//====================================WSS POLLING====================================
//  setGlobal((str_replace('.php', '', basename(__FILE__))) . 'Run', time(), 1);

    	if($ws->isConnected()) {
		//выполняем если подключено
                debmes('socket conected', 'mqtt_paw');
		$read   = array($ws->getSocket());
		$write  = NULL;
		$except = NULL;
		if (false === ($num_changed_streams = stream_select($read, $write, $except, $checkEvery))) {
			// Обработка ошибок
		} 


elseif ($num_changed_streams > 0) {
			// Как минимум на одном из потоков произошло что-то интересное
debmes('receive', 'mqtt_paw');
			$recv=$ws->receive();
//			if($dev_sonoff_module->config['DEBUG']) {
				debmes('[wss] +++ '.$recv, 'cycle_mqtt_paw_debug');
//			}
//			$dev_sonoff_module->wssRecv($recv, $sonoffws);
		}

		
	} 

else {
debmes('reconect', 'mqtt_paw');
		//переподключаемся
		$ws = new SonoffWS($url, $config);
		$ws->socketUrl=$url;
		$ws->connect();
//		if($ws->isConnected()) {
//			$paw_module->wssInit($ws);
//		}
	}



//====================================END WSS POLLING================================

//}


   if (file_exists('./reboot') || IsSet($_GET['onetime']))
   {
      $db->Disconnect();
      exit;
   }
   sleep(1);
}
DebMes("Unexpected close of cycle: " . basename(__FILE__));
