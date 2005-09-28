<?php
// FireBlog 1.0 Login code
// Copyright (C) Alex Smith 2005

if (isset($_POST['username'])) {
	
	echo 'Logging in, hold tight!';
	Auth::login($_POST['username'],$_POST['password']);
	
} else {
	
	$theme = get_pref('theme');
	require('themes/' . $theme . '/login.fbt');
		
}
?>