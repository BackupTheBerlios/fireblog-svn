<?php
// FireBlog 1.0 User navigation module
// Copyright (C) Alex Smith 2005

if ($navbar->in_section == 1) {
	
	$navbar->section_end();
	
}

$navbar->section_begin('Members');

if (Auth::is_loggedin()) {
	
	$navbar->create_module_link('My Account','usercp','Change your account settings');
	if ($_SESSION['permissions'] == 10) {
		
		$navbar->create_link('Admin','adm','Adminstrate the site');
		
	}
	$navbar->create_module_link('Logout','logout','Logout of the site');
	
} else {
	
	$navbar->create_module_link('Login','login','Log in to the site');
	
	if (get_pref('allow_reg')) {
		
		$navbar->create_module_link('Register','register','Register as a user');
		
	}
	
}

?>