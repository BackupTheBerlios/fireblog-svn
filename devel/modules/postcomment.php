<?php
// FireBlog 1.0 Post Comment module
// Copyright (C) Alex Smith 2005.

$id = $_GET['article'];
$action = $_GET['action'];

if ($id == '') {
	
	echo 'Oi buster, watcha tryin\' to do? Post a comment into thin air? Give me a frekin\' article number!';
	return 1;
	
}

if (get_pref('a_comment')) {
	
	if (!Auth::is_loggedin()) {
		
		echo 'This site requires that you login to post a comment';
		return 1;
		
	}
	
}

if ($action == 'post') {
	
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