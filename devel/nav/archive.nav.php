<?php
// FireBlog 1.0 News navigation module
// Copyright (C) Alex Smith 2005

if ($navbar->in_section == 1) {
	
	$navbar->section_end();
	
}

$navbar->section_begin('Recent Posts');

$query = "SELECT * FROM news ORDER BY id DESC LIMIT 5";
$result = mysql_query($query);
$num = mysql_numrows($result);

if ($num < 1) {
	
	echo 'No posts';
	
} else {
	
	$i = 0;
	while ($i < $num) {
		
		$id = mysql_result($result,$i,'id');
		$title = mysql_result($result,$i,'title');
		
		if (strlen($title) <= 13) {
			
			$navbar->create_link($title,'index.php?module=news&article=' . $id,$title);
			
		} else {
			
			$title_short = substr($title,0,13) . '...';
			$navbar->create_link($title_short,'index.php?module=news&article=' . $id,$title);
			
		}
		
		$i++;
		
	}
	
}
$navbar->section_end();
?>