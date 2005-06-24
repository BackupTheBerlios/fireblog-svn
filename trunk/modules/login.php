<?php
// FireBlog Login Module - Allows you to login
// Published under the GNU GPL

function login() {
	if ($_SERVER['REQUEST_METHOD'] !== "POST") {
		echo '<div class="entry">Please login using the username and password you gave during registration<br /><br />';
		echo("
		<form action=\"index.php?module=login\" method=\"POST\">
		<table>
		<tr>
		<td>Username:</td> <td><input type=\"text\" name=\"username\" /></td></tr>
		<tr>
		<td>Password:</td> <td><input type=\"password\" name=\"password\" /></td></tr>
		<tr>
		<td><input type=\"submit\" value=\"Login\" name=\"submit\" /></td><td></td></tr>
		</table>
		</form>
		</div>
		");
	} else {
		$username = $_POST['username'];
		$password = sha1($_POST['password']);
		$username = strip_tags(htmlentities(addslashes($username)));
		
		if($username == "" || $password == "") {
			echo("Please fill in all the boxes!");
		} else {
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$result = mysql_query($query);
			$num = mysql_numrows($result);
			
			if ($num == 1) {
				$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
				$result = mysql_query($query);
				$row = mysql_fetch_array($result);
				
				if($row['password'] == $password) {
					echo "Logging you in, please wait...";
					session_register(username);
					session_register(password);
					session_register(loggedin);
					session_register(permissions);
					
					$_SESSION['permissions'] = $row['permissions'];
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					$_SESSION['loggedin'] = 1;
					echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
				} else {
					echo "Incorrect username or password!";
				}
			} else {
				echo "Incorrect username or password!";
			}
		}
	}
}
?>