<?php
// FireBlog 1.0 news module
// Copyright (C) Alex Smith 2005

// Include required things
require('inc/smiley.inc.php');

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
		$date = mysql_result($result,0,'date');
		$poster = mysql_result($result,0,'poster');
		$article = parseSmilies(stripslashes(mysql_result($result,0,'short_article')));
		$extended_article = parseSmilies(stripslashes(mysql_result($result,0,'extended_article')));
		
		$format = get_pref('date');
		$date = date($format,$date);
		
		echo '<h1>' . $title . '</h1>';
		echo '<span class="posttime">Posted on ' . $date . ' by ' . $poster . '</span><br />';
		echo $article . '<br />';
		if ($extended_article <> "") {
		
			echo '<br />' . $extended_article;
		
		}
		echo '<hr>';
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
				
				echo '<div class="comments">';
				echo '<b>Posted on ' . $c_date . ' by ' . $c_user . '</b><br /><br />';
				echo $c_comment;
				echo '</div>';
				
				$i++;
			}
			
		}
		
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
			$date = mysql_result($result,$i,'date');
			$poster = mysql_result($result,$i,'poster');
			$article = parseSmilies(stripslashes(mysql_result($result,$i,'short_article')));
			$extended_article = mysql_result($result,$i,'extended_article');
			$c_query = "SELECT * FROM comments WHERE article = '$id'";
			$c_result = mysql_query($c_query);
			$comments = mysql_numrows($c_result);
			
			$format = get_pref('date');
			$date = date($format,$date);
			
			echo '<h1><a href="index.php?module=news&article=' . $id . '" class="h1">' . $title . '</a></h1>';
			echo '<span class="posttime">Posted on ' . $date . ' by ' . $poster . '</span><br />';
			echo $article . '<br />';
			if ($extended_article <> "") {
				
				echo '<br /><a href="index.php?module=news&article=' . $id . '">Read More ></a>';
	
			}
			echo '<hr>';
			echo '<span class="rightalign"><a href="index.php?module=news&article=' . $id . '">' . $comments . ' comment(s)</a></span><br /><br />';
			$i++;
			
		}
		
	}
	
}
?>