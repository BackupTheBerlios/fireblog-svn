<?php
// FireBlog 1.0 Adminstration module
// Copyright (C) Alex Smith 2005

// This is a wrapper script which loads the requested module.

$theme = get_pref('theme');
require('themes/' . $theme . '/adm/header.fbt');
?>