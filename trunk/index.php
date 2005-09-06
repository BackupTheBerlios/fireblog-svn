<?php
// FireBlog 0.2 - Published under GNU GPL
// See the file COPYING

// We can't do anything without the config file and database connection...
include("includes/functions.php");
include("includes/config.inc.php");
connect();
session_start();

// So other pages can find us :)
$root_path = './';

// Now lets find out what the site name is
$query="SELECT * FROM `config` WHERE `config_name` = 'Site Name'";
$result=mysql_query($query);
$site_name=mysql_result($result,0,"config_value");

// And the tagline...
$query="SELECT * FROM `config` WHERE `config_name` = 'Site Tagline'";
$result=mysql_query($query);
$site_tagline=mysql_result($result,0,"config_value");

// And the site description...
$query="SELECT * FROM `config` WHERE `config_name` = 'Site description'";
$result=mysql_query($query);
$site_description=mysql_result($result,0,"config_value");

// And the theme name...
$query="SELECT * FROM `config` WHERE `config_name` = 'Theme Name'";
$result=mysql_query($query);
$theme=mysql_result($result,0,"config_value");

// And the page footer...
$query="SELECT * FROM `config` WHERE `config_name` = 'Page Footer'";
$result=mysql_query($query);
$footer=mysql_result($result,0,"config_value");

// Now lets find out what module is wanted
if (isset($_GET['module'])) {
	$module=$_GET['module'];
} else {
	// Fall back to the default
	$module="news";
	$header="yes";
}

if (is_file("modules/$module.php")) {
	include ("modules/$module.php");
} else {
	fireblog_die("Module requested does not exist", "Module");
}

// Final step - Run the theme, then close the DB connection
include ("themes/$theme/index.fbt");
mysql_close();
?>
