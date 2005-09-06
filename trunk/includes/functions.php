<?php
// FireBlog Functions - These are used globally throught the system
// Copyright Alex Smith 2005 - All Rights Reserved
// This function connects you to the MySQL database
function connect() {
	include('includes/config.inc.php');
	@mysql_connect($db_host,$db_user,$db_password) or fireblog_die("Cannot connect to MySQL server!", "MySQL");
	@mysql_select_db($db_name) or fireblog_die("Cannot connect to database!", "MySQL");
}

function fireblog_die($error, $type) {
	include('config.php');
	?>
<img src="images/fireblog_logo.png"><br />
<b><?php echo $type; ?> error:</b><br />
<p><?php echo $error; ?><br /><br />
<p>Contact the site admin at <?php echo $site_admin; ?>
<?php
	die();
}
?>
