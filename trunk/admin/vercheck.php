<?php
// FireBlog version checker. Copyright Alex Smith 2005.
// See the file COPYING

echo "The latest FireBlog version is: ";
include("http://fireblog.berlios.de/version.php");
include("version.php");
echo "<br />You are using FireBlog version: $fb_version";
echo "<br /><br />You can get the latest version <a href=\"http://fireblog.berlios.de\">here</a>";
?>
