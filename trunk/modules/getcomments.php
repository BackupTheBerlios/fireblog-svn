<?php
// FireBlog 0.2 Get comments - Get the number of comments for an article
// See the file COPYING

function getcomments($id) {
	$query="SELECT * FROM comments WHERE article = $id";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	echo "<a href=\"index.php?module=news&article=$id\">$num comments</a>";
}
?>