<?php
// FireBlog 1.0 Post Comment module
// Copyright (C) Alex Smith 2005.

$id = $_GET['article'];
$action = $_GET['action'];

if ($id == '') {
	
	echo 'Oi buster, watcha tryin\' to do? Post a comment into thin air? Give me a frekin\' article number!';
	return 1;
	
}

session_destroy();
$_SESSION['loggedin'] = 1;
$_SESSION['user'] = 'Alex';
$_SESSION['permissions'] = 0;
if (get_pref('a_comment')) {
	
	if ($_SESSION['loggedin'] != 1) {
		
		echo 'This site requires that you login to post a comment';
		return 1;
		
	}
	
	if ($_SESSION['permissions'] < 1) {
		
		echo 'This site requires that you have an activated account to post a comment.';
		return 1;
		
	}
	
	if (!isset($_SESSION['user'])) {
		
		die('Hacking attempt. Notifying the CIA, NSA, UN, MI6, MI5, and the site admin. I\'d advise you to run as far as possible.');
		
	}
	
}

if ($action == 'post') {
	
	echo 'm00p';
	$comment = $_POST['comment'];
	$format = get_pref('date');
	$date = time();
	$date = date($format,$date);
				
	echo '<div class="comments">';
	echo '<b>Posted on ' . $date . ' by ' . $user . '</b><br /><br />';
	echo $comment;
	echo '</div>';
	
} else {
	
	$theme = get_pref('theme');
	require('themes/' . $theme . '/postcomment.fbt');
	
}
?>