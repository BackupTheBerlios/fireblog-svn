<?php
// FireBlog 0.2 User Registration module
// See the file COPYING

function register() {
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$username=$_POST['username'];
		$password=sha1($_POST['password']);
		$first=$_POST['first'];
		$last=$_POST['last'];
		$email=$_POST['email'];
		
		$username = strip_tags(htmlentities(addslashes($username)));
		$password = strip_tags(htmlentities(addslashes($password)));
		$email = strip_tags(htmlentities(addslashes($email)));
		$first = strip_tags(htmlentities(addslashes($first)));
		$last = strip_tags(htmlentities(addslashes($last)));
		
		if(($username == "") || ($password == "") || ($email == "")) {
			echo("You must fill out all required fields!");
		} else {
			$query = "SELECT * FROM users WHERE username='$username' || email='$email'";
			$result = mysql_query($query);
			$num = mysql_numrows($result);
			if($num != 0) {
				echo("Sorry, that username is already in use by another member. Please try again");
			} else {
				$query="INSERT INTO users VALUES('','$username','$password','0','$first','$last','$email')";
				mysql_query($query);
				echo "User created successfully";
			}
		}
	} else {
		?>
<div class="entry">
<b>Please fill in the form below to register</b>
<form action="index.php?module=register" method="POST">
<table>
<tr>
<td>Username: </td><td><input type="text" size="70" name="username" /></td>
</tr>
<tr>
<td>Password: </td><td><input type="password" size="70" name="password" /></td>
</tr>
<tr>
<td>First Name (optional): </td><td><input type="text" size="70" name="first" /></td>
</tr>
<tr>
<td>Last Name (optional): </td><td><input type="text" size="70" name="last" /></td>
</tr>
<tr>
<td>Email address: </td><td><input type="text" size="70" name="email" /></td>
</tr>
<tr>
<td><input type="submit" value="Register" name="submit" /></td><td><input type="reset" /></td>
</tr>
</table>
</form>
</div>
<?php
	}
}
?>