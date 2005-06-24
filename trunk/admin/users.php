<?php
// FireBlog Admin Users module - User management for FireBlog
// See the file COPYING
function admin_users() {
	if ($_SERVER['REQUEST_METHOD'] !== "POST") {
		echo "This is the User management page. Here you can modify a users settings and permissions.";
		echo "<br /><br />";
		echo "<form action=\"index.php?module=admin&admin=users\" method=\"POST\">";
		echo "<table>";
		echo "<tr>";
		echo "<td>Find a user:</td> <td><input type=\"text\" name=\"user\" size=50 title=\"Type in a user name\" /></td></tr>";
		echo "<tr><td><input type=\"submit\" value=\"Find\" name=\"submit\" /></td><td></td></tr>";
		echo "</table></form>";
	} else {
		$user=$_POST['user'];
		$action=$_GET['action'];
		if ($user == "" && $action !== "update") {
			echo "Please enter a username!!";
		} else {
			if ($action == 'update') {
				$id=$_POST['id'];
				$user=$_POST['user'];
				$first=$_POST['first'];
				$password=$_POST['pass'];
				$last=$_POST['last'];
				$permissions=$_POST['permissions'];
				$email=$_POST['email'];
				
				if ($password == "password") {
					$query="UPDATE users SET username='$user', first='$first', last='$last', permissions='$permissions', email='$email' WHERE id = '$id' LIMIT 1";
				} else {
					$password=sha1($_POST['password']);
					$query="UPDATE users SET username='$user', first='$first', last='$last', password='$password', permissions='$permissions', email='$email' WHERE id = '$id' LIMIT 1";
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
					$id=htmlentities(mysql_result($result,0,"id"));
					$first=htmlentities(mysql_result($result,0,"first"));
					$last=htmlentities(mysql_result($result,0,"last"));
					$permissions=htmlentities(mysql_result($result,0,"permissions"));
					$email=htmlentities(mysql_result($result,0,"email"));
					
					echo "<b>Warning!</b> If your browser asks to save the password, <b>DO NOT</b> choose to save it, as this will severely affect the operation of this Admin module!";
					echo "<form action=\"index.php?module=admin&admin=users&action=update\" method=\"POST\">";
					echo "<table>";
					echo "<tr>";
					echo "<td>Username:</td> <td><input type=\"text\" name=\"user\" size=70 value=\"$user\" /><input type=\"hidden\" name=\"id\" value=\"$id\" /></td></tr>";
					echo "<td>Password:</td> <td><input type=\"password\" name=\"pass\" size=70 value=\"password\" /></td></tr>";
					echo "<td>First Name:</td> <td><input type=\"text\" name=\"first\" size=70 value=\"$first\" /></td></tr>";
					echo "<td>Last Name:</td> <td><input type=\"text\" name=\"last\" size=70 value=\"$last\" /></td></tr>";
					echo "<td>Permissions:</td> <td><input type=\"text\" name=\"permissions\" size=70 value=\"$permissions\" /></td></tr>";
					echo "<td>Email address:</td> <td><input type=\"text\" name=\"email\" size=70 value=\"$email\" /></td></tr>";
					echo "<tr><td><input type=\"submit\" value=\"Apply\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
					echo "</table></form>";
				}
			}
		}
	}
}
?>