<?php
// FireBlog 0.2 Admin Panel
// See the file COPYING
function admin() {
	if ($_SESSION['loggedin'] == 1 && $_SESSION['permissions'] == 10) {
		if (isset($_GET['admin'])) {
			$module=$_GET['admin'];
			$adm_module="admin_" . $module;
		} else {
			$module="main";
			$adm_module="admin_" . $module;
		}
		if (is_file("admin/$module.php")) {
			include ("admin/nav.php");
			include ("admin/$module.php");
			echo "<div class=\"entry\">";
			echo "<h3>Welcome to the Admin Control Panel!</h3><br />";
			admin_nav();
			$adm_module();
			echo "</div>";
		} else {
			echo("No such Admin module!");
		}
	} else {
		admin_denied();
	}
}

function admin_denied() {
	echo "<div class=\"entry\">";
	echo "<h3>Admin Control Panel access denied!</h3>";
	echo "</div>"; 
}

?>
