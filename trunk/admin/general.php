<?php
// FireBlog Admin General module - General configuration for FireBlog
// See the file COPYING
function admin_general() {
	if ($_SERVER['REQUEST_METHOD'] !== "POST") {
		echo "This is the General Settings page. Here you can change things like the site name, site description, etc.";
		echo "<br /><br />";
		echo "<form action=\"index.php?module=admin&admin=general\" method=\"POST\">";
		echo "<table>";
		// Get values
		$query="SELECT * FROM `config` WHERE `config_type` = 'General'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		$i=0;
		
		while ($i < $num) {
			$config_name=htmlentities(mysql_result($result,$i,"config_name"));
			$config_description=htmlentities(mysql_result($result,$i,"config_description"));
			$config_value=htmlentities(mysql_result($result,$i,"config_value"));
			$config_shortname=htmlentities(mysql_result($result,$i,"config_shortname"));
			
			// Print input
			echo "<tr>";
			echo "<td>$config_name:</td> <td><input type=\"text\" name=\"$config_shortname\" value=\"$config_value\" size=80 title=\"$config_description\" /></td></tr>";
			$i++;
		}
		
		echo "<tr><td><input type=\"submit\" value=\"Apply\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
		echo "</table></form>";
	} else {
		$query="SELECT * FROM `config` WHERE `config_type` = 'General'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		$i=0;
		
		while ($i < $num) {
			$config_shortname=mysql_result($result,$i,"config_shortname");
			if (isset($_POST[$config_shortname])) {
				$myvalue=$_POST[$config_shortname];
				$newquery="UPDATE `config` SET `config_value` = '$myvalue' WHERE `config_shortname` = '$config_shortname' LIMIT 1";
				$newresult=mysql_query($newquery);
			}
			$i++;
		}
		echo "Changes were applied successfully!";
	}
}
?>