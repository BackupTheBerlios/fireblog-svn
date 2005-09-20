<?php
// FireBlog 1.0 Core function library
// Copyright (C) Alex Smith 2005

// function: get_pref
// description: get a configuration value from the database
// returns: configuration value
// notes: none
function get_pref($pref) {
	
	$query="SELECT * FROM `config` WHERE `config_shortname` = '$pref'";
	$result=mysql_query($query);
	$value=mysql_result($result,0,"config_value");
	return $value;
	
}

// function: fb_init
// description: initialize a database connection, get the config, and sort some template stuff
// returns: configuration array
// notes: none
function fb_init() {
	
	require('inc/config.inc.php');
	mysql_connect($db_host,$db_user,$db_pass) or fb_die('Could not connect to the database server','MySQL');
	mysql_select_db($db_name) or fb_die('Could not select database','MySQL');
	session_start();
	
	$theme = get_pref('theme');
	require('themes/' . $theme . '/page_header.fbt');
	require('themes/' . $theme . '/navbar.fbt');
	
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
function fb_close() {
	
	$theme = get_pref('theme');
	$root_path = get_pref('root');
	require('themes/' . $theme . '/page_footer.fbt');
	mysql_close;
	
}
?>
