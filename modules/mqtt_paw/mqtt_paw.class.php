<?php
/**
* mqtt_paw 
* @package project
* @author Wizard <sergejey@gmail.com>
* @copyright http://majordomo.smartliving.ru/ (c)
* @version 0.1 (wizard, 19:05:26 [May 13, 2019])
*/
//
//
class mqtt_paw extends module {
/**
* mqtt_paw
*
* Module class constructor
*
* @access private
*/
function __construct() {
  $this->name="mqtt_paw";
  $this->title="mqtt_paw";
  $this->module_category="<#LANG_SECTION_DEVICES#>";
  $this->checkInstalled();
}
/**
* saveParams
*
* Saving module parameters
*
* @access public
*/
function saveParams($data=1) {
 $p=array();
 if (IsSet($this->id)) {
  $p["id"]=$this->id;
 }
 if (IsSet($this->view_mode)) {
  $p["view_mode"]=$this->view_mode;
 }
 if (IsSet($this->edit_mode)) {
  $p["edit_mode"]=$this->edit_mode;
 }
 if (IsSet($this->tab)) {
  $p["tab"]=$this->tab;
 }
 return parent::saveParams($p);
}
/**
* getParams
*
* Getting module parameters from query string
*
* @access public
*/
function getParams() {
  global $id;
  global $mode;
  global $view_mode;
  global $edit_mode;
  global $tab;
  if (isset($id)) {
   $this->id=$id;
  }
  if (isset($mode)) {
   $this->mode=$mode;
  }
  if (isset($view_mode)) {
   $this->view_mode=$view_mode;
  }
  if (isset($edit_mode)) {
   $this->edit_mode=$edit_mode;
  }
  if (isset($tab)) {
   $this->tab=$tab;
  }
}
/**
* Run
*
* Description
*
* @access public
*/
function run() {
 global $session;
  $out=array();
  if ($this->action=='admin') {
   $this->admin($out);
  } else {
   $this->usual($out);
  }
  if (IsSet($this->owner->action)) {
   $out['PARENT_ACTION']=$this->owner->action;
  }
  if (IsSet($this->owner->name)) {
   $out['PARENT_NAME']=$this->owner->name;
  }
  $out['VIEW_MODE']=$this->view_mode;
  $out['EDIT_MODE']=$this->edit_mode;
  $out['MODE']=$this->mode;
  $out['ACTION']=$this->action;
  $this->data=$out;
  $p=new parser(DIR_TEMPLATES.$this->name."/".$this->name.".html", $this->data, $this);
  $this->result=$p->result;
}
/**
* BackEnd
*
* Module backend
*
* @access public
*/
function admin(&$out) {
 if (isset($this->data_source) && !$_GET['data_source'] && !$_POST['data_source']) {
  $out['SET_DATASOURCE']=1;
 }

        if ((time() - gg('cycle_mqtt_pawRun')) < 360*2 ) {
			$out['CYCLERUN'] = 1;
		} else {
			$out['CYCLERUN'] = 0;
		}


//$seen=SQLSelectOne("select max(FIND) FIND from zigbee2mqtt_log where MESSAGE='online'  ");
//$seen=SQLSelectOne("select max(FIND) FIND from zigbee2mqtt_log   ");






 $this->getConfig();
 $out['MQTT_DEBUG']=$this->config['MQTT_DEBUG'];


//define("ZMQTT_DEBUG", $this->config['MQTT_DEBUG']);
define("ZMQTT_DEBUG", "1");



 $out['ZMQTT_DEBUG']=ZMQTT_DEBUG;

 $out['MQTT_CLIENT']=$this->config['MQTT_CLIENT'];
 $out['MQTT_HOST']=$this->config['MQTT_HOST'];
 $out['MQTT_PORT']=$this->config['MQTT_PORT'];
 $out['MQTT_ENABLE']=$this->config['MQTT_ENABLE'];
 $out['Z2M_LOGMODE']=$this->config['Z2M_LOGMODE'];
// $out['Z2M_LOGMODE']='deb';

 $out['ZIGBEE2MQTTPATH']=$this->config['ZIGBEE2MQTTPATH'];
 $out['MQTT_QUERY']=$this->config['MQTT_QUERY'];

 if (!$out['MQTT_HOST']) {
  $out['MQTT_HOST']='localhost';
 }


 if (!$out['MQTT_CLIENT']) {
  $out['MQTT_CLIENT']='md_paw';
 }


 if (!$out['MQTT_PORT']) {
  $out['MQTT_PORT']='1883';
 }
 if (!$out['MQTT_QUERY']) {
  $out['MQTT_QUERY']='PAW/#';
 }

 $out['MQTT_USERNAME']=$this->config['MQTT_USERNAME'];
 $out['MQTT_PASSWORD']=$this->config['MQTT_PASSWORD'];
 $out['MQTT_AUTH']=$this->config['MQTT_AUTH'];


     if ($this->tab=='help') {
$res=SQLSelect("SELECT * FROM zigbee2mqtt_devices_list ");
$out['DEVICE_LIST']=$res;

}








// if (($this->view_mode=='update_log')&&($this->tab=='log')) {
 if ($this->tab=='log') {

// if ($this->update_log=='update_log') {
 $this->getConfig();

global $file;
global $limit;
$zigbee2mqttpath=$this->config['ZIGBEE2MQTTPATH'];
if ($this->view_mode=='update_log') {$filename=$zigbee2mqttpath.'/data/log/'.$file.'/log.txt';} 
else 

{

$zigbee2mqttpath=$this->config['ZIGBEE2MQTTPATH'];

            $path = $zigbee2mqttpath.'/data/log';


            if ($handle = opendir($path)) {
                $files = array();

                while (false !== ($entry = readdir($handle))) {
                    if ($entry == '.' || $entry == '..')
                        continue;

                    $files[] = array('TITLE' => $entry);
                }

                sort($files);
            }
$cnt=count($files);

//if (ZMQTT_DEBUG=="1" ) debmes($cnt,'zigbee2mqtt');
if (ZMQTT_DEBUG=="1" ) debmes($files[$cnt-1]['TITLE'],'zigbee2mqtt');

$lastfile=$files[$cnt-1]['TITLE'];
$filename=$zigbee2mqttpath.'/data/log/'.$lastfile.'/log.txt';


} 

$out['FN']=$filename;
//$out['FN']="1234";

//$a=file_get_contents ($filename, null,null,1000);


//$tmp=file($filename); 
//$tmp=file_get_contents ($filename, null,null,1000);
/*

if (filesize ($filename)>0) {

$fz=filesize ($filename);

$file = new SplFileObject($filename, 'r');



$file->seek(PHP_INT_MAX);

$last_line = $file->key();
debmes($last_line, 'zg1');

$max=500;
if  ($max>$last_line ) {$max=$last_line;}

$lines = new LimitIterator($file, $last_line - $max, $last_line);

$tmp=(iterator_to_array($lines));
}



$newtmp=array_reverse($tmp); 
$a="";
foreach ($newtmp as $value) 
{ 
$a.= $value; 
} 

$a =  str_replace( array("\r\n","\r","\n") , '<br>' , $a);
$out['LOG']=$a;
*/

            $path = $zigbee2mqttpath.'/data/log';

            if ($handle = opendir($path)) {
                $files = array();

                while (false !== ($entry = readdir($handle))) {
                    if ($entry == '.' || $entry == '..')
                        continue;

                    $files[] = array('TITLE' => $entry);
                }

                sort($files);
            }

            $out['FILES'] = $files;

//$this->search_mqtt($out);





                    

//$vm1=$filename;
// echo "<script type='text/javascript'>";
// echo "alert('$vm1');";
// echo "</script>";

// $this->redirect("?tab=log");

}




//$vm1=$this->view_mode;
// echo "<script type='text/javascript'>";
// echo "alert('$vm1');";
// echo "</script>";


 if ($this->view_mode=='cycle_start') {
setGlobal('cycle_zigbee2mqttControl','start'); 
$this->redirect("?");
}


 if ($this->view_mode=='send_test_mqtt') {


global $mqttsendpath;
global $mqttsendvalue;
if (ZMQTT_DEBUG=="1" ) debmes('send custom message topic: '.$mqttsendpath.' value:'.$mqttsendvalue, 'zigbee2mqtt');

//  $this->sendcommand($mqttsendpath, $mqttsendvalue);
//  $this->sendcommand('zigbee2mqtt/bridge/config/devices', '');

$this->redirect("?tab=log");


}







//$vm1=$this->view_mode;
// echo "<script type='text/javascript'>";
// echo "alert('$vm1');";
// echo "</script>";



 if ($this->view_mode=='update_settings') {



   global $mqtt_client;
   global $mqtt_debug;
   global $mqtt_host;
   global $mqtt_username;
   global $mqtt_password;
   global $mqtt_auth;
   global $mqtt_port;
   global $mqtt_enable;
   global $z2m_logmode2;
   global $mqtt_query;
   global $zigbee2mqttpath;
//echo $zigbee2mqttpath;

//$vm1=$this->view_mode;
// echo "<script type='text/javascript'>";
// echo "alert('$z2m_logmode');";
// echo "</script>";


   $this->config['MQTT_CLIENT']=trim($mqtt_client);
   $this->config['MQTT_DEBUG']=trim($mqtt_debug);
   $this->config['ZIGBEE2MQTTPATH']=trim($zigbee2mqttpath);
   $this->config['MQTT_HOST']=trim($mqtt_host);
   $this->config['MQTT_USERNAME']=trim($mqtt_username);
   $this->config['MQTT_PASSWORD']=trim($mqtt_password);
   $this->config['MQTT_AUTH']=(int)$mqtt_auth;
   $this->config['MQTT_ENABLE']=(int)$mqtt_enable;
   $this->config['MQTT_PORT']=(int)$mqtt_port;
   $this->config['MQTT_QUERY']=trim($mqtt_query);
   $this->config['Z2M_LOGMODE']=trim($z2m_logmode2);


// $this->sendcommand('zigbee2mqtt/bridge/config/log_level', $z2m_logmode);


$cmd='
include_once(DIR_MODULES . "zigbee2mqtt/zigbee2mqtt.class.php");
$z2m= new zigbee2mqtt();
$z2m->sendcommand("zigbee2mqtt/bridge/config/log_level", "'.$z2m_logmode2.'");
';
// SetTimeOut('z2m_set_dubug',$cmd, '1'); 




   $this->saveConfig();

   setGlobal('cycle_mqtt_pawControl', 'restart');

   $this->redirect("?tab=settings");
 }

 if (!$this->config['MQTT_HOST']) {
  $this->config['MQTT_HOST']='localhost';
  $this->saveConfig();
 }
 if (!$this->config['MQTT_PORT']) {
  $this->config['MQTT_PORT']='1883';
  $this->saveConfig();
 }

 if (!$this->config['ZIGBEE2MQTTPATCH']) {
  $this->config['ZIGBEE2MQTTPATCH']='/opt/zigbee2mqtt/';
  $this->saveConfig();
 }


 if (!$this->config['MQTT_QUERY']) {
  $this->config['MQTT_QUERY']='PAW/#';
  $this->saveConfig();
 }











 }
/**
* FrontEnd
*
* Module frontend
*
* @access public
*/
function usual(&$out) {
 $this->admin($out);
}
 function processCycle() {
$this->mqtt_paw_devices_cloudscan();
  //to-do
 }
/**
* Install
*
* Module installation routine
*
* @access private
*/


 function mqtt_paw_devices_cloudscan() {
  require(DIR_MODULES.$this->name.'/mqtt_paw_devices_scan.inc.php');
 }



 function install($data='') {
  parent::install();
  $this->getConfig();
  $this->config['POLL_PERIOD']=10;
  $this->saveConfig();
 }

// --------------------------------------------------------------------
}
/*
*
* TW9kdWxlIGNyZWF0ZWQgTWF5IDEzLCAyMDE5IHVzaW5nIFNlcmdlIEouIHdpemFyZCAoQWN0aXZlVW5pdCBJbmMgd3d3LmFjdGl2ZXVuaXQuY29tKQ==
*
*/
