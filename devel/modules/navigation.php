<?php
// FireBlog 1.0 Navigation module
// Copyright (C) Alex Smith 2005

include ("inc/navigation.inc.php");
$navbar = new NavBar();

$query="SELECT * FROM links ORDER BY id";
$result=mysql_query($query);
$num=mysql_numrows($result);

$i=0;

while ($i < $num) {
	
	$type = mysql_result($result,$i,'link_type');
	
	if ($type == 'category') {
		
		$name = mysql_result($result,$i,'link_name');
		if ($navbar->in_section == 1) {
			
			$navbar->section_end();
			
		}
		$navbar->section_begin($name);
		
	} elseif ($type == 'link') {
		
		$name = mysql_result($result,$i,'link_name');
		$desc = mysql_result($result,$i,'link_description');
		$target = mysql_result($result,$i,'link_target');
		$navbar->create_link($name,$target,$desc);
		
	} elseif ($type == 'home') {
		
		$name = mysql_result($result,$i,'link_name');
		$navbar->create_homepage_link($name);
		
	} elseif ($type == 'page') {
		
		$name = mysql_result($result,$i,'link_name');
		$desc = mysql_result($result,$i,'link_description');
		$page = mysql_result($result,$i,'link_target');
		$navbar->create_page_link($name,$page,$desc);
		
	} elseif ($type == 'banner') {
		
		$img = mysql_result($result,$i,'link_name');
		$desc = mysql_result($result,$i,'link_description');
		$link = mysql_result($result,$i,'link_target');
		$navbar->create_banner_link($img,$link,$desc);
		
	} elseif ($type == 'ad') {
		
		$code = mysql_result($result,$i,'link_target');
		$navbar->create_ad_block($code);
		
	} elseif ($type == 'module') {
		
		$name = mysql_result($result,$i,'link_name');
		$desc = mysql_result($result,$i,'link_description');
		$module = mysql_result($result,$i,'link_target');
		$navbar->create_module_link($name,$module,$desc);
		
	}
	
	$i++;
	
}

// Then we add all the plugins.

include('nav/archive.nav.php');
include('nav/user.nav.php');
?>