<?php
// FireBlog 1.0 Categories module
// Copyright (C) Alex Smith 2005

if (!isset($_GET['cat'])) {
	
	echo 'Please give me a category ID!';
	
} else {
	
	$id = $_GET['cat'];
	$query = "SELECT * FROM categories WHERE id = '$id' LIMIT 1";
	$result = mysql_query($query);
	$num = mysql_numrows($result);
	
	if ($num < 1) {
		
		echo 'No such category!';
		
	} else {
		
		$name = mysql_result($result,0,'name');
		
		echo '<h3>' . $name . '</h3><br />';
		
		$n_query = "SELECT * FROM news WHERE category_id = '$id' ORDER BY id DESC";
		$n_result = mysql_query($n_query);
		$n_num = mysql_numrows($n_result);
		
		if ($n_num < 1) {
			
			echo 'There are currently no posts in this category.';
			
		} else {
			
			$i = 0;
			
			while ($i < $n_num) {
				
				$n_id = mysql_result($n_result,$i,'id');
				$n_title = mysql_result($n_result,$i,'title');
				$n_date = mysql_result($n_result,$i,'date');
				
				$format = get_pref('date');
				$n_date = date($format, $n_date);
				
				echo '<table width="100%">';
				echo '<tr><td width="50%"><a href="index.php?module=news&amp;article=' . $n_id . '">' . $n_title . '</a></td><td width="50%">Posted on ' . $n_date . '</td></tr>';
				echo '</table>';
				
				$i++;
				
			}
			
		}
		
	}
	
}
?>