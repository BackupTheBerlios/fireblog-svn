<?php
// FireBlog 0.2 Post comment script - Post a comment
// See the file COPYING

function postcomment($theme) {
	if ($_SESSION['loggedin'] == 1) {
		if (isset($_GET['article_id'])) {
			$action=$_GET['action'];
			if ($action == "create") {
				$article_id=$_GET['article_id'];
				$comment=$_POST['comment'];
				$username=$_SESSION['username'];
				
				if ($comment == "") {
					echo "<div class=\"entry\">You can't post an empty comment!</div>";
				} else {
					// Filters
					$comment = eregi_replace("fuck", "****", $comment);
					$comment = eregi_replace("piss", "****", $comment);
					$comment = eregi_replace("shit", "****", $comment);
					$comment = eregi_replace("cunt", "****", $comment);
					$comment = eregi_replace("dick", "****", $comment);
					$comment = eregi_replace("bastard", "*******", $comment);
					$comment = preg_replace("[\n]", "<br />", $comment);
					$comment = str_replace(" i ", " I ", $comment);
					$comment = strip_tags($comment);
	
					$query="INSERT INTO comments VALUES('','$article_id','$username','$comment')";
					$result=mysql_query($query);
					echo "<div class=\"entry\">Comment created successfully!</div>";
				}
			} else {
				$article_id=$_GET['article_id'];
				echo "<div class=\"entry\">Posting a comment to article $article_id...";
				echo "<form action=\"index.php?module=postcomment&article_id=$article_id&action=create\" method=\"POST\">";
				echo "<table>";
				echo "<tr>";
				echo "<td>Comment:</td> <td><textarea cols=\"68\" rows=\"15\" name=\"comment\"></textarea></td>";
				echo "</tr>";
				echo "<tr><td><input type=\"submit\" value=\"Submit\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
				echo "</table>";
				echo "</form></div>";
			}
		} else {
			echo "<div class=\"entry\">You must give me an article id!!</div>";
		}
	} else {
		echo "<div class=\"entry\">You must login to post a comment!!</div>";
	}
}
?>