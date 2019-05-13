<?php
chdir(dirname(__FILE__) . '/../');
include_once("./config.php");
include_once("./lib/loader.php");
include_once("./lib/threads.php");
//include_once("./lib/websockets/sonoffws.class.php");
include_once("./lib/websockets/client/lib/class.websocket_client.php");

set_time_limit(0);
// connecting to database
$db = new mysql(DB_HOST, '', DB_USER, DB_PASSWORD, DB_NAME);
include_once("./load_settings.php");
include_once(DIR_MODULES . "control_modules/control_modules.class.php");
$ctl = new control_modules();
include_once(DIR_MODULES . 'paw/paw.class.php');
$dev_sonoff_module = new dev_sonoff();
$dev_sonoff_module->getConfig();
$tmp = SQLSelectOne("SELECT ID FROM dev_sonoff_devices LIMIT 1");
if (!$tmp['ID'])
   exit; // no devices added -- no need to run this cycle
echo date("H:i:s") . " running " . basename(__FILE__) . PHP_EOL;
$latest_check=0;
$checkEvery=$dev_sonoff_module->config['POLL_PERIOD'];
//websockets
$wssurl=$dev_sonoff_module->getWssUrl();
$sonoffws = new SonoffWS($wssurl, $config);

while (1)
{
//====================================HTTP POLLING===================================
   setGlobal((str_replace('.php', '', basename(__FILE__))) . 'Run', time(), 1);
   //http polling devices
   if ((time()-$latest_check)>$checkEvery) {
    $latest_check=time();
    echo date('Y-m-d H:i:s').' Polling devices...';
    $dev_sonoff_module->processCycle();
   }
//====================================END HTTP POLLING===============================  

//====================================WSS POLLING====================================
 /*  setGlobal((str_replace('.php', '', basename(__FILE__))) . 'Run', time(), 1);
    echo date('Y-m-d H:i:s').' Polling devices...';
    	if($sonoffws->isConnected()) {
		//выполняем если подключено
		$read   = array($sonoffws->getSocket());
		$write  = NULL;
		$except = NULL;
		if (false === ($num_changed_streams = stream_select($read, $write, $except, $checkEvery))) {
			// Обработка ошибок
		} elseif ($num_changed_streams > 0) {
			// Как минимум на одном из потоков произошло что-то интересное
			$recv=$sonoffws->receive();
			if($dev_sonoff_module->config['DEBUG']) {
				debmes('[wss] +++ '.$recv, 'cycle_dev_sonoff_debug');
			}
			$dev_sonoff_module->wssRecv($recv, $sonoffws);
		}
		
	} else {
		//переподключаемся
		$sonoffws = new SonoffWS($wssurl, $config);
		$sonoffws->socketUrl=$wssurl;
		$sonoffws->connect();
		if($sonoffws->isConnected()) {
			$dev_sonoff_module->wssInit($sonoffws);
		}
	}
*/
//====================================END WSS POLLING================================


   if (file_exists('./reboot') || IsSet($_GET['onetime']))
   {
      $db->Disconnect();
      exit;
   }
   sleep(1);
}
DebMes("Unexpected close of cycle: " . basename(__FILE__));
