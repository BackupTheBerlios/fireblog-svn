<?php
// FireBlog 1.0 news module
// Copyright (C) Alex Smith 2005

// Include required things
require('inc/smiley.inc.php');

// Get prefs
$theme = get_pref('theme');

// Do we want a specific article, or shall we just show the posts?
if (isset($_GET['article'])) {
	
	// Find the wanted article
	$id = $_GET['article'];
	$query = "SELECT * FROM news WHERE id = '$id'";
	$result = mysql_query($query);
	
	// Check if it existed
	$num = mysql_numrows($result);
	if ($num < 1) {
		
		echo 'That post doesn\'t exist, silly!';
		
	} else {
		
		// Now display it to the user
		$title = mysql_result($result,0,'title');
		$cat_id = mysql_result($result,0,'category_id');
		$date = mysql_result($result,0,'date');
		$poster = mysql_result($result,0,'poster');
		$article = parseSmilies(stripslashes(htmlentities(mysql_result($result,0,'short_article'))));
		$extended_article = parseSmilies(stripslashes(htmlentities(mysql_result($result,0,'extended_article'))));
		
		$cat_query = "SELECT * FROM categories WHERE id = '$cat_id'";
		$cat_result = mysql_query($cat_query);
		$cat_num = mysql_numrows($cat_result);
		if ($cat_num < 1) {
			
			$category = 'No category';
			
		} else {
			
			$category = mysql_result($cat_result,0,'name');
			
		}
		
		$format = get_pref('date');
		$date = date($format,$date);
		
		require('themes/' . $theme . '/article.fbt');
		
		$c_query = "SELECT * FROM comments WHERE article = '$id'";
		$c_result = mysql_query($c_query);
		$c_num = mysql_numrows($c_result);
		
		if ($c_num < 1) {
			
			echo 'No comments have been posted';
			
		} else {
			
			$i = 0;
			while ($i < $c_num) {
				
				$c_user = mysql_result($c_result,$i,'username');
				$c_date = mysql_result($c_result,$i,'date');
				$c_comment = parseSmilies(strip_tags(stripslashes(mysql_result($c_result,$i,'comment'))));
				
				$c_date = date($format,$c_date);
				
				if ($c_user == 'FBAnonUser') {
					
					$c_user = get_pref('anon_name');
					
				}
				
				require('themes/' . $theme . '/comment.fbt');
				
				$i++;
			}
			
		}
		
		echo '<br /><a href="index.php?module=postcomment&amp;article=' . $id . '">Post a comment...</a>';
		
	}
	
} else {
	
	// Get our news posts
	$query = "SELECT * FROM news ORDER BY id DESC LIMIT 5";
	$result = mysql_query($query);
	
	// Check if there were any posts there
	$num = mysql_numrows($result);
	if ($num < 1) {
		
		echo 'No posts in database';
		
	} else {
		
		// Main loop
		$i = 0;
		while ($i < $num) {
			
			$id = mysql_result($result,$i,'id');
			$title = mysql_result($result,$i,'title');
			$cat_id = mysql_result($result,$i,'category_id');
			$date = mysql_result($result,$i,'date');
			$poster = mysql_result($result,$i,'poster');
			$article = parseSmilies(stripslashes(htmlentities(mysql_result($result,$i,'short_article'))));
			$extended_article = mysql_result($result,$i,'extended_article');
			
			$c_query = "SELECT * FROM comments WHERE article = '$id'";
			$c_result = mysql_query($c_query);
			$comments = mysql_numrows($c_result);
			
			$cat_query = "SELECT * FROM categories WHERE id = '$cat_id'";
			$cat_result = mysql_query($cat_query);
			$cat_num = mysql_numrows($cat_result);
			if ($cat_num < 1) {
				
				$category = 'No category';
				
			} else {
				
				$category = mysql_result($cat_result,0,'name');
				
			}
			
			$format = get_pref('date');
			$date = date($format,$date);
			
			require('themes/' . $theme . '/article.fbt');
			$i++;
			
		}
		
	}
	
}
?>