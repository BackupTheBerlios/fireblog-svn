<?php
function navlogin() {
 	echo '<h4>My Account</h4>';
	if($_SESSION['loggedin'] == 1) {
		echo "<a href=\"index.php?module=ucp\">Control Panel</a><br />";
		if ($_SESSION['permissions'] == 10) {
			echo "<a href=\"index.php?module=admin\">Admin CP</a><br />";
		}
		echo "<a href=\"index.php?module=logout\">Logout</a><br />";
	} else {
		echo "<a href=\"index.php?module=login\">Login</a><br />";
		echo "<a href=\"index.php?module=register\">Register</a><br />";
	}
}
?>