<?php
// FireBlog Admin News module - News posting script
// See the file COPYING
function admin_news() {
	$action=$_GET['action'];
	if ($action == "edit" && isset($_GET['edit'])) {
		$news_id=$_GET['edit'];
		echo "<b>Editing Article number $news_id...</b>";
		
		$query="SELECT * FROM news WHERE id = '$news_id' LIMIT 1";
		$result=mysql_query($query);
		
		$news_title=htmlentities(mysql_result($result,0,"title"));
		$news_short=htmlentities(mysql_result($result,0,"short_article"));
		$news_extended=htmlentities(mysql_result($result,0,"extended_article"));
		
		echo "<form action=\"index.php?module=admin&admin=news&action=editupdate&edit=$news_id\" method=\"POST\">";
		echo "<table>";
		echo "<tr>";
		echo "<td>Article Title:</td> <td><input type=\"text\" name=\"news_title\" size=70 value=\"$news_title\" /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Short Article:</td> <td><textarea cols=\"68\" rows=\"20\" name=\"news_short\">$news_short</textarea></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Extended Article:</td> <td><textarea cols=\"68\" rows=\"20\" name=\"news_extended\">$news_extended</textarea></td>";
		echo "</tr>";
		echo "<tr><td><input type=\"submit\" value=\"Apply\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
		echo "</table>";
		echo "</form>";
	} elseif ($action == "editupdate" && isset($_GET['edit'])) {
		$news_id=$_GET['edit'];
		echo "<b>Updating Article number $news_id...</b><br />";
		$news_title=$_POST['news_title'];
		$news_short=$_POST['news_short'];
		$news_extended=$_POST['news_extended'];
		$news_short = preg_replace("[\n]", "<br />", $news_short);
		$news_short = str_replace("i ", "I ", $news_short);
		$news_extended = preg_replace("[\n]", "<br />", $news_extended);
		$news_extended = str_replace(" i ", " I ", $news_extended);
		$query="UPDATE news SET title='$news_title', short_article='$news_short', extended_article='$news_extended' WHERE id = '$news_id' LIMIT 1";
		$result=mysql_query($query);
		echo "Article updated successfully";
	} elseif ($action == "delete" && isset($_GET['delete'])) {
		$news_id=$_GET['delete'];
		echo "<b>Deleting Article number $news_id...</b><br />";
		$query="DELETE FROM news WHERE id='$news_id' LIMIT 1";
		$result=mysql_query($query);
		echo "Article deleted successfully";
	} elseif ($action == "new") {
		echo "<form action=\"index.php?module=admin&admin=news&action=newcreate\" method=\"POST\">";
		echo "<table>";
		echo "<tr>";
		echo "<td>Article Title:</td> <td><input type=\"text\" name=\"news_title\" size=70 /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Short Article:</td> <td><textarea cols=\"68\" rows=\"20\" name=\"news_short\"></textarea></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Extended Article (Optional):</td> <td><textarea cols=\"68\" rows=\"20\" name=\"news_extended\"></textarea></td>";
		echo "</tr>";
		echo "<tr><td><input type=\"submit\" value=\"Create\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
		echo "</table>";
		echo "</form>";
	} elseif ($action == "newcreate") {
		echo "<b>Creating article...</b><br />";
		$news_title=$_POST['news_title'];
		$news_short=$_POST['news_short'];
		$news_extended=$_POST['news_extended'];
		$username = $_SESSION['username'];
		$date = date("D M j G:i:s T Y");
		$news_details = "Posted on $date by $username";
		if ($news_title == "") {
			echo "You must enter a title!";
		} elseif ($news_details == "") {
			echo "You must enter post details!";
		} elseif ($news_short == "") {
			echo "You must at least enter a short article!";
		} else {
			$news_short = preg_replace("[\n]", "<br />", $news_short);
			$news_short = str_replace("i ", "I ", $news_short);
			$news_extended = preg_replace("[\n]", "<br />", $news_extended);
			$news_extended = str_replace(" i ", " I ", $news_extended);
			$query="INSERT INTO news VALUES('','$news_title','$news_details','$news_short','$news_extended')";
			$result=mysql_query($query);
			echo "Article created successfully";
		}
	} else {
		echo "<a href=\"index.php?module=admin&admin=news&action=new\">Post article</a>";
		echo "<table>";
		echo "<tr>";
		echo "<td><b>Article ID:</b></td><td><b>Article Title:</b></td><td><b>Article Details:</b></td><td><b>Actions:</b></td>";
		echo "</tr>";
		
		$query="SELECT * FROM news";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		
		$i=0;
		while ($i < $num) {
			$news_id=mysql_result($result,$i,"id");
			$news_title=mysql_result($result,$i,"title");
			$news_details=mysql_result($result,$i,"details");
			echo "<tr>";
			echo "<td>$news_id</td><td>$news_title</td><td>$news_details</td><td><a href=\"index.php?module=admin&admin=news&action=edit&edit=$news_id\">Edit</a> <a href=\"index.php?module=admin&admin=news&action=delete&delete=$news_id\">Delete</a></td>";
			echo "</tr>";
			$i++;
		}
		
		echo "</table>";
	}
}
?>