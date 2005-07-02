<?php
// FireBlog Admin Pages module - Static pages Admin module
// See the file COPYING
function admin_pages() {
	$action=$_GET['action'];
	if ($action == "edit" && isset($_GET['edit'])) {
		$page_id=$_GET['edit'];
		echo "<b>Editing Page number $page_id...</b>";
		
		$query="SELECT * FROM pages WHERE id = '$page_id' LIMIT 1";
		$result=mysql_query($query);
		
		$page_title=htmlentities(mysql_result($result,0,"title"));
		$page_idstring=htmlentities(mysql_result($result,0,"id_string"));
		$page_idstring=ereg_replace("&lt;br /&gt;", "", $page_idstring);
		$page_text=htmlentities(mysql_result($result,0,"page"));
		
		echo "<form action=\"index.php?module=admin&admin=pages&action=editupdate&edit=$page_id\" method=\"POST\">";
		echo "<table>";
		echo "<tr>";
		echo "<td>Page Title:</td> <td><input type=\"text\" name=\"page_title\" size=70 value=\"$page_title\" /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Page ID String :</td> <td><input type=\"text\" name=\"page_idstring\" size=70 value=\"$page_idstring\" /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Page Text:</td> <td><textarea cols=\"68\" rows=\"20\" name=\"page_text\">$page_text</textarea></td>";
		echo "</tr>";
		echo "<tr><td><input type=\"submit\" value=\"Apply\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
		echo "</table>";
		echo "</form>";
	} elseif ($action == "editupdate" && isset($_GET['edit'])) {
		$page_id=$_GET['edit'];
		echo "<b>Updating Page number $page_id...</b><br />";
		$page_title=$_POST['page_title'];
		$page_idstring=$_POST['page_idstring'];
		$page_text=$_POST['page_text'];
		$page_text = preg_replace("[\n]", "<br />", $page_text);
		$page_text = str_replace(" i ", " I ", $page_text);
		$query="UPDATE pages SET title='$page_title', id_string='$page_idstring', page='$page_text' WHERE id = '$page_id' LIMIT 1";
		$result=mysql_query($query);
		echo "Page updated successfully";
	} elseif ($action == "delete" && isset($_GET['delete'])) {
		$page_id=$_GET['delete'];
		echo "<b>Deleting Page number $page_id...</b><br />";
		$query="DELETE FROM pages WHERE id='$page_id' LIMIT 1";
		$result=mysql_query($query);
		echo "Page deleted successfully";
	} elseif ($action == "new") {
		echo "<form action=\"index.php?module=admin&admin=pages&action=newcreate\" method=\"POST\">";
		echo "<table>";
		echo "<tr>";
		echo "<td>Page Title:</td> <td><input type=\"text\" name=\"page_title\" size=70 /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Page ID String :</td> <td><input type=\"text\" name=\"page_idstring\" size=70 /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Page Text:</td> <td><textarea cols=\"68\" rows=\"20\" name=\"page_text\"></textarea></td>";
		echo "</tr>";
		echo "<tr><td><input type=\"submit\" value=\"Create\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
		echo "</table>";
		echo "</form>";
	} elseif ($action == "newcreate") {
		echo "<b>Creating page...</b><br />";
		$page_title=$_POST['page_title'];
		$page_idstring=$_POST['page_idstring'];
		$page_text=$_POST['page_text'];
		$page_text = preg_replace("[\n]", "<br />", $page_text);
		$page_text = str_replace(" i ", " I ", $page_text);
		$query="INSERT INTO pages VALUES('','$page_title','$page_idstring','$page_text')";
		$result=mysql_query($query);
		echo "Page created successfully";
	} else {
		echo "<a href=\"index.php?module=admin&admin=pages&action=new\">New Page</a>";
		echo "<table>";
		echo "<tr>";
		echo "<td><b>Page ID:</b></td><td><b>Page Title:</b></td><td><b>Page ID String:</b></td><td><b>Actions:</b></td>";
		echo "</tr>";
		
		$query="SELECT * FROM pages";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		
		$i=0;
		while ($i < $num) {
			$page_id=mysql_result($result,$i,"id");
			$page_title=mysql_result($result,$i,"title");
			$page_idstring=mysql_result($result,$i,"id_string");
			echo "<tr>";
			echo "<td>$page_id</td><td>$page_title</td><td>$page_idstring</td><td><a href=\"index.php?module=admin&admin=pages&action=edit&edit=$page_id\">Edit</a> <a href=\"index.php?module=admin&admin=pages&action=delete&delete=$page_id\">Delete</a></td>";
			echo "</tr>";
			$i++;
		}
		
		echo "</table>";
	}
}
?>
