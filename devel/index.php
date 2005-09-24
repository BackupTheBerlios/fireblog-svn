<?php
// FireBlog 1.0 Index page
// Copyright (C) Alex Smith 2005

// Initialize FireBlog
require('inc/core.inc.php');
fb_init();

if (isset($_GET['module'])) {
	
	// Load the specified module
	
	$module = $_GET['module'];
	
	if (is_file("modules/$module.php")) {
		
		require("modules/$module.php");
		
	} else {
		
		echo 'I\'m sorry, but the module requested, ' . $module . ', doesn\'t exist';
		
	}
	
} else {
	
	// Load our default module
	
	echo '<h3>' . get_pref('tagline') . '</h3><br />';
	echo get_pref('desc') . '<br /><br />';
	$module = get_pref('defmod');
	
	if (is_file("modules/$module.php")) {
		
		require("modules/$module.php");
		
	} else {
		
		echo 'Uh oh... The default module, ' . $module . ', doesn\'t exist. You should contact the site admin.';
		
	}
}

// End the page

fb_close();
?>
