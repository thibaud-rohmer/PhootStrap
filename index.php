<?php
session_start();

require_once("XRL/Autoload.php");
require_once("conf.php");
require_once("functions.php");

define(DIRS_IN_NAVBAR,$nav_in_top_bar);
define(IMAGES_PER_PAGE,$images_per_page);

$client     = new XRL_Client($server,$timezone);
$client["XRL_DecoderFactoryInterface"] = new XRL_NonValidatingDecoderFactory();

if(isset($_GET['a']) && $_GET['a']=="logout"){
	session_unset();
}

// User attempts to log in 
if(isset($_POST['login'])){
	$key = $client->get_key($_POST['login'],$_POST['password']);
	if($key){
		$_SESSION['key'] = $key;
	}
}

// User logged in
if(isset($_SESSION['key'])){
	$account = $client->whoami($_SESSION['key']);
	$key = $_SESSION['key'];
}else{
	$account = false;
	$key = "";
}

// User requested a directory
if(isset($_GET['dir'])){
	$dir = $_GET['dir'];
}else{
	$dir = ".";
}

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 0;
}

$dirs	= $client->list_dirs($key,$dir);
$files	= $client->list_files($key,$dir);

// OUTPUT 

give_head($site_name);

if(DIRS_IN_NAVBAR){
	navbar($site_name,$account,$dirs,$dir);
}else{
	navbar($site_name,$account);
	dirs($dirs,$dir);
}

if(isset($_GET['a']) && $_GET['a']=="login"){
	login();
}else if($_GET['a'] == "who"){
	account($account);
}else{
	files($files,$dir,$page);
	pagination($files,$dir,$page);
}
finish_him();
?>
