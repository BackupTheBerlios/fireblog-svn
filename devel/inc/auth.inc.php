<?php
// FireBlog 1.0 Authentication system
// Copyright (C) Alex Smith

class Auth {
	
	function initialize() {
		
		// Initialize the session
		
		session_start();
		
		// Do a sanity check
			
		if ($_SESSION['loggedin'] == 1) {
			
			if (!isset($_SESSION['user'])) {
				
				die('Hacking attempt. Notifying the CIA, NSA, UN, MI6, MI5, and the site admin. I\'d advise you to run as far as possible.');
				
			}
			
		}
		
	}
	
	function login($username,$password) {
		
		// Initialize our new session
		
		$password = sha1($password);
		
		$query = "SELECT * FROM users WHERE `username` = '$username' AND `password` = '$password' LIMIT 1";
		$result = mysql_query($query);
		$num = mysql_numrows($result);
		
		$perms = mysql_result($result,0,'permissions');
		
		if ($num < 1) {
			
			echo 'Invalid username or password!';
			return 1;
			
		}
			
		if ($perms < 1) {
			
			echo 'Your account has either been deactivated, or you have not confirmed your registration yet.';
			return 1;
			
		} else {
			
			$_SESSION['loggedin'] = 1;
			$_SESSION['user'] = $username;
			$_SESSION['permissions'] = $perms;
			
		}
		
	}
	
	function logout() {
		
		// Destroy the session
		
		session_destroy();
		
	}
	
	function is_loggedin() {
		
		if ($_SESSION['loggedin'] == 1) {
			
			return true;
			
		} else {
			
			return false;
			
		}
		
	}
	
}
?>