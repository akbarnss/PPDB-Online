<?php
/*-----------------------------------------+
| Gammu phpClass
| Author      : Stieven R. Kalengkian
| Contact     : stieven.kalengkian@gmail.com
| Website     : www.sleki.org - My Blog http://stieven.glowciptamedia.com/
| Version     : 3.0
| Last Update : Dec, 08 2009
|
| Tested on
| OS   			: Linux Slackware 12.0 and Windows XP Pro (unlicense demo only)
| PHP ver.   	: 5.2.11
| MySQL ver		: 5.1
| Apache		: 1.x and 2.0
| Gammu Version : [Gammu version 1.26.90 built 15:57:29 on Oct 12 2009 using GCC 4.3, MinGW 3.11]
|
|
| Description:
| Gammu API with PHP
| (only if you wan't running daemon)
| I recommended you to use Gammu
| Please visit Official Gammu Website for more information about Gammu
| http://wammu.eu/gammu
|
|
| Change log:
|
| v3.0
|	**!!!! Warning... if you use class version 2.x or below 
|   **!!!! it is not compatible with this version (3.x)
|	**!!!! Please check.. this class only work on PHP 5.2+
| - New method for new gammu technology,
| - Fully support for Windows or Linux OS
|
| v2.1
| - Add function enable_sudo([int]) 
|   set 1 if using sudo for gammu command exe
------------------------------------------*/

class gammu {
	/* Initializing gammu bin/EXE */
	/* Initializing gammu bin/EXE */
	//var $gammu = "/usr/local/bin/gammu";
	//var $gammu_inject_bin = "/usr/local/bin/gammu-smsd-inject";
    var $gammu = "gammu/bin/gammu.exe";
    var $gammu_smsd = "gammu/bin/gammu-smsd.exe";
	var $gammu_inject_bin = "gammu/bin/gammu-smsd-inject.exe";
	var $datetime_format = 'Y-m-d H:i:s';
    
	public $db;
	function __construct($gammu_bin_location='',$gammu_config_file='',$gammu_bin_smsd='',$gammu_smsd_config='',$gammu_config_section='',$dbtype, $dbhost, $dbname, $dbuser, $dbpass)
	{
		$this->db = new database($dbtype, $dbhost, $dbname, $dbuser, $dbpass);
		$this->gammu = $gammu_bin_location ? $gammu_bin_location : '/usr/local/bin/gammu';
		$this->gammu_smsd = $gammu_bin_smsd ? $gammu_bin_smsd : '/usr/local/bin/gammu-smsd';
		if (!file_exists($this->gammu)) {
			$this->error("Can not found <b><u>{$this->gammu}</u></b> or Gammu is not installed\r\n");
		} else {
		    if(!empty($gammu_config_file)) $this->gammu = $gammu_config_file != '' ? $this->gammu." -c {$gammu_config_file}" : $this->gammu;
            else $this->gammu = $gammu_config_file != '' ? $this->gammu : $this->gammu;
			$this->gammu = $gammu_config_section != '' ? $this->gammu." -s ". (int) $gammu_config_section ."" : $this->gammu;
		}
		if (!file_exists($this->gammu_smsd)) {
			$this->error("Can not found <b><u>{$this->gammu}</u></b> or Gammu SMSD is not installed\r\n");
		} else {
		    if(!empty($gammu_smsd_config)) $this->gammu_smsd = $gammu_smsd_config != '' ? $this->gammu_smsd." -c {$gammu_smsd_config}" : $this->gammu_smsd;
            else $this->gammu_smsd = $gammu_smsd_config != '' ? $this->gammu_smsd : $this->gammu_smsd;
		}
	}
	
	function gammu_exec($options='--identify',$break=0) {
		$exec=$this->gammu." ".$options;
        if(substr(PHP_OS, 0, 3) == "WIN") exec($exec,$r);
		else exec('sudo '.$exec,$r);
		if ($break == 1) { return $r; }
		else { return $this->unbreak($r); }
	}
    
    function gammu_smsd_exec($options='-i -n SMSGateway',$break=0) {
		$exec=$this->gammu_smsd." ".$options;
        if(substr(PHP_OS, 0, 3) == "WIN") exec($exec,$r);
		else exec('sudo '.$exec,$r);
		if ($break == 1) { return $r; }
		else { return $this->unbreak($r); }
	}
	
	function gammu_inject($options,$break=0) {
		$exec=$this->gammu_inject_bin." ".$options;
        if(substr(PHP_OS, 0, 3) == "WIN") exec($exec,$r);
		else exec('sudo '.$exec,$r);
		if ($break == 1) { return $r; }
		else { return $this->unbreak($r); }
	}
	
	function unbreak($r) {
		for($i=0;$i<count($r);$i++) {
			$response.=$r[$i]."\r\n";
		}
		return $response;
	}
    
    function Uninstall(&$response){
        if(substr(PHP_OS, 0, 3) == "WIN") $r = $this->gammu_smsd_exec("-u -n SMSGateway",1);
		else $r = $this->gammu_smsd_exec('-u -n SMSGateway',1);
		$response = $r;
    }
    
    function Install(&$response){
        if(substr(PHP_OS, 0, 3) == "WIN") $r = $this->gammu_smsd_exec("-i -n SMSGateway",1);
		else $r = $this->gammu_smsd_exec('-i -n SMSGateway',1);
        $response = $r;
    }
    
    function Run(&$response){
        if(substr(PHP_OS, 0, 3) == "WIN") $r = $this->gammu_smsd_exec("-s -n SMSGateway",1);
		else $r = $this->gammu_smsd_exec('-s -n SMSGateway',1);
        $response = $r;
    }
	
    
    function Stop(&$response){
        if(substr(PHP_OS, 0, 3) == "WIN") $r = $this->gammu_smsd_exec("-k -n SMSGateway",1);
		else $r = $this->gammu_smsd_exec('-k -n SMSGateway',1);
        $response = $r;
    }
	
	function Identify(&$response)
	{
        if(substr(PHP_OS, 0, 3) == "WIN") $r = $this->gammu_exec("identify",1);
		else $r = $this->gammu_exec('--identify',1);
		if (preg_match("#Error opening device|No configuration file found|Gammu is not installed#", $this->unbreak($r),$s)) {
			$response = $r;
			return 0;
		}  else {
			for($i=0;$i<count($r);$i++) {
				if (preg_match("#^(Manufacturer|Model|Firmware|IMEI|Product code|SIM IMSI).+:(.+)#",$r[$i],$s)) {
				//if (preg_match("#^(.+):(.+)#",$r[$i],$s)) {
					if (trim($s[1]) and trim($s[2])) { $response[str_replace(" ","_",trim($s[1]))]=trim($s[2]); }
				}
			}
			$response[$i] = $r;
            if(substr(PHP_OS, 0, 3) == "WIN") $r = $this->gammu_exec("monitor 1",1);
    		else $r = $this->gammu_exec('--monitor 1',1);
			for($i=0;$i<count($r);$i++) {
				if (preg_match("#^(.+):(.+)#",$r[$i],$s)) {
					if (trim($s[1]) and trim($s[2])) { $response[str_replace(" ","_",trim($s[1]))]=trim($s[2]); }
				}
			}
			return 1;
		}
	}
	
	function Get($table='inbox', $num="", $keyfield='ReceivingDateTime')
	{
        if($num=="") {
			$startGet	= 0;
			$getNumber	= 1;
		} else {
            $getNumber	= $num;
			$startGet	= $num;
			$startGet	= $startGet - 1;
		}
		        						
		$paging			= 20;
		$endGet			= $startGet * $paging;
        
		$sql = "select * FROM $table order by $keyfield DESC LIMIT $endGet, $paging";
        $this->db->query($sql);
        
		$i = 0;
		while($row = $this->db->get_row()){
			$data[$i] = $row;
			$i++;
		}
		return $data;
	}
	
    function GetLaporan($table='inbox', $num, $keyfield='ReceivingDateTime', $keyfield2, $startdate, $enddate)
	{
        if($num=="") {
			$startGet	= 0;
			$getNumber	= 1;
		} else {
            $getNumber	= $num;
			$startGet	= $num;
			$startGet	= $startGet - 1;
		}
		        						
		$paging			= 20;
		$endGet			= $startGet * $paging;
			   
        $sql = "SELECT * FROM $table WHERE TextDecoded LIKE '$keyfield2%' AND DATE_FORMAT(ReceivingDateTime, '%Y-%m-%d') BETWEEN DATE_ADD('$startdate', INTERVAL -1 DAY) AND DATE_ADD('$enddate', INTERVAL 1 DAY) ORDER BY $keyfield DESC LIMIT $endGet, $paging";
        $this->db->query($sql);
		$i = 0;
		while($row = $this->db->get_row()){
			$data[$i] = $row;
			$i++;
		}
		return $data;
	}
    
    function GetLog($table='logister', $num, $keyfield='DateMsg', $startdate, $enddate)
	{
        if($num=="") {
			$startGet	= 0;
			$getNumber	= 1;
		} else {
            $getNumber	= $num;
			$startGet	= $num;
			$startGet	= $startGet - 1;
		}
		        						
		$paging			= 20;
		$endGet			= $startGet * $paging;
			   
        $sql = "SELECT * FROM $table WHERE DATE_FORMAT(DateMsg, '%Y-%m-%d') BETWEEN DATE_ADD('$startdate', INTERVAL -1 DAY) AND DATE_ADD('$enddate', INTERVAL 1 DAY) ORDER BY $keyfield DESC LIMIT $endGet, $paging";
        echo $sql;
        $this->db->query($sql);
		$i = 0;
		while($row = $this->db->get_row()){
			$data[$i] = $row;
			$i++;
		}
		return $data;
	}
    
    function GetPage($table, $pageurl, $keyfield='ReceivingDateTime', $keyfield2, $startdate, $enddate){
        
        $paging			= 20;
		                
        if($keyfield2!="") $extra = " WHERE TextDecoded LIKE '$keyfield2%' AND DATE_FORMAT(ReceivingDateTime, '%Y-%m-%d') BETWEEN DATE_ADD('$startdate', INTERVAL -1 DAY) AND DATE_ADD('$enddate', INTERVAL 1 DAY)";
        else $extra = ""; 
        						
		$selectQuery	= "SELECT * FROM $table $extra ORDER BY $keyfield DESC";
		$select			= mysql_query($selectQuery);
		$selectNum		= mysql_num_rows($select);
		$countPage		= ceil($selectNum / $paging);
        
        for($i=1; $i <= $countPage; $i++) {
            if($i != $_REQUEST[num]) {
				$pageLooping .= "<b><a href=\"$pageurl&num=$i\"> $i </a> | </b>";
			} else {
				$pageLooping .= "<b>$i | </b>";
			}
		}
        
        return $pageLooping;
        
    }
    
	function Send($number,$text,$creator='Admin',$multiple='false',&$respon) {
		$sqlSend = "INSERT INTO outbox (InsertIntoDB, DestinationNumber, TextDecoded, CreatorID, Coding, MultiPart) VALUES ('".date("Y-m-d H:i:s")."','$number', '$text', '$creator', 'Default_No_Compression', '$multiple')";
		$query	   = mysql_query($sqlSend);
		if($query) {
			$respon = "ok";
			return 1;
		}else{
			$respon = mysql_error();
			return 0;
		} 
	}
	
	function phoneBook($mem = 'ME')
	{
	   
        if(substr(PHP_OS, 0, 3) == "WIN") $r = $this->gammu_exec('getallmemory '.$mem,1);
  		else $r = $this->gammu_exec('--getallmemory '.$mem,1);
		$data = array();
		$x=0; $sx = 0;
		for($i=0;$i<count($r);$i++) {
			if (preg_match("#^Memory (.+), Location (.+)#",$r[$i],$d)) {
				$x=$sx;
				if (!trim($d[1])) continue;
				$data[$x]['Location']=trim($d[2]);
				$data[$x]['MEM']=trim($d[1]);
				$sx++;
			}
			if (preg_match("#(^Email.+): (.+)#si",$r[$i],$s)) {
				$data[$x]['email'][]=trim(trim($s[2]),'"');
			}
			else if (preg_match("#(.+): (.+)#si",$r[$i],$s)) {
				$data[$x][strtolower(str_replace(" ","_",trim($s[1])))]=trim(trim($s[2]),'"');
			}
		}
		return $data;
	}
	
	function error($e,$exit=0) {
		echo $e."\n";
		if ($exit == 1) { exit; }
	}
}

/*-----------------------------------------
|
| :::::::::::: EXAMPLE ::::::::::::::::::
|
-----------------------------------------*/
/** /
$gammu_bin 				= dirname(__FILE__).'/gammu/bin/gammu.exe';
$gammu_config 			= dirname(__FILE__).'/gammurc.txt';
$gammu_config_section	= '1'; // for default section please set "blank" value --> $gammu_config_section = '';

$sms = new gammu($gammu_bin,$gammu_config,$gammu_config_section);

/* Identify Device information * /
$sms->Identify($response);
echo '<pre>';
print_r($response); 
echo '</pre>'; 

/* Get SMS from Device* /
$response = $sms->Get();
echo '<pre>';print_r($response); echo '</pre>'; 

/* Sending SMS * /
$sms->Send('+6281380830000','Test!',$response);
echo '<pre>';
print_r($response); echo '</pre>'; 

/* Get Phone -> ME = Phone Memory; SM = Sim Card;  options list => DC|MC|RC|ON|VM|SM|ME|MT|FD|SL * /
$response = $sms->phoneBook('ME');
echo '<pre>';print_r($response); echo '</pre>'; 
/**/

?>
