<?php
// FireBlog 1.0 Core function library
// Copyright (C) Alex Smith 2005

// function: fb_init
// description: initialize a database connection, get the config, and sort some template stuff
// returns: configuration array
// notes: none
function fb_init() {
	include('inc/config.inc.php');
	mysql_connect($db_host,$db_user,$db_pass) or fb_die('Could not connect to the database server','MySQL');
	mysql_select_db($db_name) or fb_die('Could not select database','MySQL');
	session_start();
	
	// Now lets find out what the site name is
	$query="SELECT * FROM `config` WHERE `config_shortname` = 'name'";
	$result=mysql_query($query);
	$site_name=mysql_result($result,0,"config_value");
	
	// And the tagline...
	$query="SELECT * FROM `config` WHERE `config_shortname` = 'tagline'";
	$result=mysql_query($query);
	$site_tagline=mysql_result($result,0,"config_value");
	
	// And the site description...
	$query="SELECT * FROM `config` WHERE `config_shortname` = 'desc'";
	$result=mysql_query($query);
	$site_desc=mysql_result($result,0,"config_value");
	
	// And the theme name...
	$query="SELECT * FROM `config` WHERE `config_shortname` = 'theme'";
	$result=mysql_query($query);
	$theme=mysql_result($result,0,"config_value");
	
	// And the default module...
	$query="SELECT * FROM `config` WHERE `config_shortname` = 'defmod'";
	$result=mysql_query($query);
	$defmod=mysql_result($result,0,"config_value");
	include('themes/' . $theme . '/page_header.fbt');
	include('themes/' . $theme . '/navbar.fbt');
	$config = array("site_name" => "$site_name", "site_tagline" => "$site_tagline", "site_desc" => "$site_desc", "theme" => "$theme", "defmod" => "$defmod");
	return $config;
}

// function: fb_die
// description: raise an error
// returns: none
// notes: none
function fb_die($error,$type) {
	echo '<b>' . $type . ' error</b><br />';
	echo $error;
	die;
}

// function: fb_close
// description: close off the page
// returns: none
// notes: none
function fb_close($theme) {
	include('themes/' . $theme . '/page_footer.fbt');
	mysql_close;
}
?>
