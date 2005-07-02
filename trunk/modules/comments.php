<?php
// FireBlog 0.2 comments script - Get the comments for an article
// See the file COPYING

function comments($id, $title) {
	$query="SELECT * FROM comments WHERE article = $id";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	
	$i=0;
	while ($i < $num) {
		$comment_id=mysql_result($result,$i,"id");
		$username=mysql_result($result,$i,"username");
		$comment=mysql_result($result,$i,"comment");
		$comment=parseSmiley($comment);
		$comment=stripslashes($comment);
		
		echo "<div class=\"comments\">";
		echo "<span class=\"posttime\"><b>#$comment_id, Re: $title</b>, by $username</span><br /><br />";
		echo "$comment";
		echo "</div>";
		$i++;
	}
	if ($_SESSION['loggedin'] == 1) {
		echo "<br /><a href=\"index.php?module=postcomment&article_id=$id\">Post a comment...</a>";
	} else {
		echo "<br />Login to post a comment";
	}
}
?>
