<?php
// FireBlog Admin Comments module - Comments moderation script
// See the file COPYING
function admin_comments() {
	$action=$_GET['action'];
	if ($action == "edit" && isset($_GET['edit'])) {
		$id=$_GET['edit'];
		echo "<b>Editing comment number $id...</b>";
		
		$query="SELECT * FROM comments WHERE id = '$id' LIMIT 1";
		$result=mysql_query($query);
		
		$article_id=htmlentities(mysql_result($result,$i,"article"));
		$comment_user=htmlentities(mysql_result($result,$i,"username"));
		$comment=htmlentities(mysql_result($result,$i,"comment"));
		
		echo "<form action=\"index.php?module=admin&admin=comments&action=editupdate&edit=$id\" method=\"POST\">";
		echo "<table>";
		echo "<tr>";
		echo "<td>Article ID:</td> <td><input type=\"text\" name=\"article_id\" size=70 value=\"$article_id\" /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Comment User:</td> <td><input type=\"text\" name=\"comment_user\" size=70 value=\"$comment_user\" /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Comment:</td> <td><textarea cols=\"68\" rows=\"20\" name=\"comment\">$comment</textarea></td>";
		echo "</tr>";
		echo "<tr><td><input type=\"submit\" value=\"Apply\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
		echo "</table>";
		echo "</form>";
	} elseif ($action == "editupdate" && isset($_GET['edit'])) {
		$id=$_GET['edit'];
		echo "<b>Updating Comment number $id...</b><br />";
		$article_id=$_POST['article_id'];
		$comment_user=$_POST['comment_user'];
		$comment=$_POST['comment'];
		$comment = eregi_replace("fuck", "****", $comment);
		$comment = eregi_replace("piss", "****", $comment);
		$comment = eregi_replace("shit", "****", $comment);
		$comment = eregi_replace("cunt", "****", $comment);
		$comment = eregi_replace("dick", "****", $comment);
		$comment = eregi_replace("bastard", "*******", $comment);
		$comment = preg_replace("[\n]", "<br />", $comment);
		$comment = str_replace(" i ", " I ", $comment);
		$query="UPDATE comments SET article='$article_id', username='$comment_user', comment='$comment' WHERE id = '$id' LIMIT 1";
		$result=mysql_query($query);
		echo "Comment updated successfully";
	} elseif ($action == "delete" && isset($_GET['delete'])) {
		$id=$_GET['delete'];
		echo "<b>Deleting Article number $id...</b><br />";
		$query="DELETE FROM comments WHERE id='$id' LIMIT 1";
		$result=mysql_query($query);
		echo "Comment deleted successfully";
	} else {
		echo "<table>";
		echo "<tr>";
		echo "<td><b>Comment ID:</b></td><td><b>Article ID:</b></td><td><b>Comment Poster:</b></td><td><b>Actions:</b></td>";
		echo "</tr>";
		
		$query="SELECT * FROM comments ORDER BY id DESC";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		
		$i=0;
		while ($i < $num) {
			$id=mysql_result($result,$i,"id");
			$article_id=mysql_result($result,$i,"article");
			$comment_user=mysql_result($result,$i,"username");
			echo "<tr>";
			echo "<td>$id</td><td>$article_id</td><td>$comment_user</td><td><a href=\"index.php?module=admin&admin=comments&action=edit&edit=$id\">Edit</a> <a href=\"index.php?module=admin&admin=comments&action=delete&delete=$id\">Delete</a></td>";
			echo "</tr>";
			$i++;
		}
		
		echo "</table>";
	}
}
?>