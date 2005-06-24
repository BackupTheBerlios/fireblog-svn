<?php
// FireBlog Admin Navigation module - Navigation bar of the admin panel
// See the file COPYING
function admin_nav() {
	echo "<a href=\"index.php?module=admin\">Home</a> | ";
	echo "<a href=\"index.php?module=admin&admin=general\">General</a> | ";
	echo "<a href=\"index.php?module=admin&admin=users\">Users</a> | ";
	echo "<a href=\"index.php?module=admin&admin=links\">Links</a> | ";
	echo "<a href=\"index.php?module=admin&admin=pages\">Pages</a> | ";
	echo "<a href=\"index.php?module=admin&admin=news\">News</a> | ";
	echo "<a href=\"index.php?module=admin&admin=comments\">Comments</a>";
	echo "<hr><br />";
}
?>