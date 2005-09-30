<?php
// FireBlog 1.0 page module - Display static pages
// Copyright (C) Alex Smith 2005

if (!isset($_GET['page'])) {
	
	echo 'Please give me a page ID!';
	
} else {
	
	// Get the page from the DB
	
	$id = $_GET['page'];
	
	$query = "SELECT * FROM pages WHERE id = '$id' LIMIT 1";
	$result = mysql_query($query);
	$num = mysql_numrows($result);
	
	if ($num < 1) {
		
		echo 'Sorry, but that page does not exist';
		
	} else {
		
		require('inc/smiley.inc.php');
		
		$title = stripslashes(htmlentities(mysql_result($result,0,'title')));
		$page = parseSmilies(stripslashes(htmlentities(mysql_result($result,0,'page'))));
		
		$theme = get_pref('theme');
		require('themes/' . $theme . '/page.fbt');
		
	}
	
}
?>