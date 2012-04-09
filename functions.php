<?php

function give_head(){
echo("
<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset='utf-8'>
	<title>PhotoShow + Bootstrap</title>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
	<meta name='description' content=''>
	<meta name='author' content='Thibaud Rohmer'>

	<link href='./css/bootstrap.css' rel='stylesheet'>
	<link href='./css/bootstrap-responsive.css' rel='stylesheet'>
	<style type='text/css'>
	body {
		padding-top: 60px;
		padding-bottom: 40px;      
	}
	</style>
</head>
<body>
");
}

function navbar($account){
	echo ("
   <div class='navbar navbar-fixed-top'>
	  <div class='navbar-inner'>
		<div class='container-fluid'>
		  <a class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'>
			<span class='icon-bar'></span>
			<span class='icon-bar'></span>
			<span class='icon-bar'></span>
		  </a>
		  <a class='brand' href='.'>PhotoShow + Bootstrap</a>
		  <div class='nav-collapse'>
			");
	if($account){
		echo ("<p class='navbar-text'>Logged in as <a href='?a=who'>".htmlentities($account['login'])."</a><span class='pull-right'> <a href='?a=logout'>Logout</a></p>");
	}else{
		echo ("<p class='navbar-text pull-right'><a href='?a=login'>Login</a></p>");
	}
		
	echo("</div><!--/.nav-collapse -->
		</div>
	  </div>
	</div>
   <div class='container-fluid'>
   <div class='row-fluid'>
");
}

function login(){
	echo ('<form class="well form-inline" method="post" action="." >
	  <input name="login" type="text" class="input-small" placeholder="Login">
	  <input name="password" type="password" class="input-small" placeholder="Password">
	  <button type="submit" class="btn">Sign in</button>
	</form>');
}

function account($account){
	echo "<div class='span9'><table class='table table-bordered table-striped'>";
	foreach($account as $a=>$val){
		if(!is_array($val)){
			echo "<tr><td>$a</td><td>$val</td></tr>";
		}
	}
	echo "</table></div>";
}

function dirs($dirs,$path){
	if($path == "."){
		$dirname = "Home";
	}else{
		if(strpos($path,"/"))
			$dirname=substr(strrchr($path,"/"),1);
		else
			$dirname = basename($path);
	}
	
	echo("<div class='span3'>
          <div class='well sidebar-nav'>
            <ul class='nav nav-list'>");
	echo "<li class='nav-header'>Menu</li>";
	echo "<li><a href='.'><i class='icon-home'></i>Home</a></li>";
	echo "<li><a href='https://plus.google.com/114933352963292387937/about'><i class='icon-user'></i>Contact</a></li>";
	echo "<li><a href='http://www.photoshow-gallery.com/'><i class='icon-info-sign'></i>About</a></li>";

	echo "<li class='divider'></li>";
	echo "<li class='nav-header'>Listing : ".htmlentities($dirname)."</li>";
	
	foreach($dirs as $d){
		if(strpos($d,"/"))
			$d=substr(strrchr($d,"/"),1);
		else
			$d = basename($d);
		$dir = urlencode($path."/".$d);
		echo("<li><a href='?dir=$dir'><i class='icon-camera'></i>".htmlentities($d)."</a></li>\n");
	}
	echo "</ul></div></div>";
}

function files($files,$path){
	if(basename($path) == "."){
		$dirname = "Home";
	}else{
		$dirname=basename($path);
	}
	
	echo ("<div class='span9'>
		<div class='hero-unit'>
		<h1>".htmlentities($dirname)."</h1>
		</div>");
	$i=4;
	
	echo ("<ul class='thumbnails'>");
	foreach($files as $f){
	$f=substr(strrchr($f,"/"),1);
		
	$thb = "t=thumb&i=".urlencode($path."/".$f);
	$view = "i=".urlencode($path."/".$f);
	$dl = "dl=1&i=".urlencode($path."/".$f);
		
		
	echo "<li class='span3'>
			<div class='thumbnail' style='min-height:220px;'>
				<img src='./img.php?$thb' width='200' height='100'>
				<div class='caption'>
					<h5>".$f."</h5>
					<p><a href='./img.php?$view' class='btn btn-primary'>View</a> <a href='./img.php?$dl' class='btn'>Download</a></p>
				</div>
			</div>
			</li>";
		
	}
	echo "</ul>";
}

function finish_him(){
	echo "</body>\n</html>";
}
?>