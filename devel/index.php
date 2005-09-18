<?php
// FireBlog 1.0 Index page
// Copyright (C) Alex Smith 2005

include('inc/core.inc.php');
$config = fb_init();
if (isset($_GET['module'])) {
	// Load the specified module
	$module = $_GET['module'];
	if (is_file("modules/$module.php")) {
		include ("modules/$module.php");
	} else {
		echo 'I\'m sorry, but the module requested, ' . $module . ', doesn\'t exist';
	}
} else {
	// Load our default module
	echo '<h3>' . $config['site_tagline'] . '</h3><br />';
	echo $config['site_desc'] . '<br/><br />';
	$module = $config['defmod'];
	if (is_file("modules/$module.php")) {
		include ("modules/$module.php");
	} else {
		echo 'Uh oh... The default module, ' . $module . ', doesn\'t exist. You should contact the site admin.';
	}
}
fb_close($config['theme']);
?>
