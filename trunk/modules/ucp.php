<?php
// FireBlog User Control Panel - Let users change their settings (restricted version of admin_users)
// See the file COPYING
function ucp($theme) {
	echo "<div class=\"entry\">";
	$user=$_SESSION['username'];
	$action=$_GET['action'];
	if ($action == 'update') {
		$user=$_SESSION['username'];
		$first=$_POST['first'];
		$password=$_POST['pass'];
		$last=$_POST['last'];
		$email=$_POST['email'];
		
		if ($password == "password") {
			$query="UPDATE users SET first='$first', last='$last', email='$email' WHERE username='$user' LIMIT 1";
		} else {
			$password=sha1($_POST['password']);
			$query="UPDATE users SET first='$first', last='$last', password='$password', email='$email' WHERE username='$user' LIMIT 1";
		}
		
		$result=mysql_query($query);
		echo "User updated successfully!";
	} else {
		$query = "SELECT * FROM users WHERE username='$user' LIMIT 1";
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		
		if ($num == 0) {
			echo "No such user!";
		} else {
			$first=mysql_result($result,0,"first");
			$last=mysql_result($result,0,"last");
			$email=mysql_result($result,0,"email");
			
			echo "<b>Warning!</b> If your browser asks to save the password, <b>DO NOT</b> choose to save it, as this will severely affect the operation of the user control panel!";
			echo "<form action=\"index.php?module=ucp&action=update\" method=\"POST\">";
			echo "<table>";
			echo "<tr>";
			echo "<td>Password:</td> <td><input type=\"password\" name=\"pass\" size=70 value=\"password\" /></td></tr>";
			echo "<td>First Name:</td> <td><input type=\"text\" name=\"first\" size=70 value=\"$first\" /></td></tr>";
			echo "<td>Last Name:</td> <td><input type=\"text\" name=\"last\" size=70 value=\"$last\" /></td></tr>";
			echo "<td>Email address:</td> <td><input type=\"text\" name=\"email\" size=70 value=\"$email\" /></td></tr>";
			echo "<tr><td><input type=\"submit\" value=\"Apply\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
			echo "</table></form>";
		}
	}
	echo "</div>";
}
?>