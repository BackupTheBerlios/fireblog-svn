<?php
// FireBlog 1.0 Login code
// Copyright (C) Alex Smith 2005

if (isset($_POST['username'])) {
	
	echo 'Logging in, hold tight!<br />';
	
	if (!isset($_POST['username']) && !isset($_POST['password'])) {
		
		echo 'Please fill in all the fields!';
		echo '<meta http-equiv="refresh" content="3; url=index.php?module=login">';
		
	} else {
		
		Auth::login($_POST['username'],$_POST['password']);
		echo '<meta http-equiv="refresh" content="0; url=index.php">';
		
	}
	
} else {
	
	$theme = get_pref('theme');
	require('themes/' . $theme . '/login.fbt');
		
}
?>