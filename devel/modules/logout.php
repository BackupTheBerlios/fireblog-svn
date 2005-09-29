<?php
// FireBlog 1.0 Logout module
// Copyright (C) Alex Smith 2005

Auth::logout();
echo '<meta http-equiv="refresh" content="0; url=index.php">';
?>