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
	$date = time();
	
	// Insert to database
	
	if (Auth::is_loggedin()) {
		
		$user = $_SESSION['user'];
		
	} else {
		
		$user = 'FBAnonUser';
		
	}
	
	$query = "INSERT INTO comments VALUES('','$id','$user','$date','$comment')";
	
	if (mysql_query($query)) {
		
		echo '<b>Comment posted successfully!</b><br />';
		echo 'Return to the <a href="index.php?module=news&article=' . $id . '">article</a>...';
		
	} else {
		
		echo '<b>Error: Unable to post comment.</b>';
		
	}
	
} else {
	
	$theme = get_pref('theme');
	require('themes/' . $theme . '/postcomment.fbt');
	
}
?>