<?php
session_start();

require_once("XRL/Autoload.php");
require_once("conf.php");


$client     = new XRL_Client($server,$timezone);
$client["XRL_DecoderFactoryInterface"] = new XRL_NonValidatingDecoderFactory();

if(isset($_SESSION['key'])){
	$key=$_SESSION['key'];
}else{
	$key="";
}

if(isset($_GET['dl'])){
	header('Content-Disposition: attachment; filename="'.basename($_GET['i']).'"');
	header('Content-type: image/jpeg');
}

header('Content-type: image/jpeg');

$i=$client->get_img($key,$_GET['i'],$_GET['t']);
echo $i;
?>