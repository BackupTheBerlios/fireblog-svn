<?php
// FireBlog Admin Main module - Main page of the admin panel
// See the file COPYING
function admin_main() {
	echo "Welcome to the FireBlog Admin Panel! Here you can modify your site settings.<br />";
	echo "<div class=\"comments\">";
	include("admin/vercheck.php");
	echo "</div>";
}
?>