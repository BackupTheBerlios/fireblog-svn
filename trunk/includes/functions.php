<?php
// FireBlog 1.0 - Functions used throughout the system.
// Copyright Alex Smith 2005 - All Rights Reserved

// This function connects to the DB and returns an array containing the site's configuration
function fb_init() {
	include($root_path . 'includes/config.inc.php');
	@mysql_connect($db_host,$db_user,$db_password) or fb_die("Cannot connect to MySQL server!", "MySQL");
	@mysql_select_db($db_name) or fb_die("Cannot connect to database!", "MySQL");
}

function fb_die($error, $type) {
	include($root_path . 'includes/config.inc.php');
	echo '<b>' . $type . ' error:</b><br />';
	echo $error;
	echo '<p>Contact the site admin at ' . $site_admin . '</p>';
	die();
}
?>
