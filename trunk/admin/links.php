<?php
// FireBlog Admin Links module - Links appearing on the sidebar
// See the file COPYING
function admin_links() {
	$action=$_GET['action'];
	if ($action == "edit" && isset($_GET['edit'])) {
		$link_id=$_GET['edit'];
		echo "<b>Editing Link number $link_id...</b>";
		
		$query="SELECT * FROM links WHERE id = '$link_id' LIMIT 1";
		$result=mysql_query($query);
		
		$link_name=htmlentities(mysql_result($result,0,"link_name"));
		$link_description=htmlentities(mysql_result($result,0,"link_description"));
		$link_target=htmlentities(mysql_result($result,0,"link_location"));
		
		echo "<form action=\"index.php?module=admin&admin=links&action=editupdate&edit=$link_id\" method=\"POST\">";
		echo "<table>";
		echo "<tr>";
		echo "<td>Link Name:</td> <td><input type=\"text\" name=\"link_name\" size=70 value=\"$link_name\" /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Link Description:</td> <td><input type=\"text\" name=\"link_description\" size=70 value=\"$link_description\" /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Link Target:</td> <td><input type=\"text\" name=\"link_target\" size=70 value=\"$link_target\" /></td>";
		echo "</tr>";
		echo "<tr><td><input type=\"submit\" value=\"Apply\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
		echo "</table>";
		echo "</form>";
	} elseif ($action == "editupdate" && isset($_GET['edit'])) {
		$link_id=$_GET['edit'];
		echo "<b>Updating Link number $link_id...</b><br />";
		$link_name=$_POST['link_name'];
		$link_description=$_POST['link_description'];
		$link_target=$_POST['link_target'];
		$query="UPDATE links SET link_name='$link_name', link_description='$link_description', link_location='$link_target' WHERE id = '$link_id' LIMIT 1";
		$result=mysql_query($query);
		echo "Link updated successfully";
	} elseif ($action == "delete" && isset($_GET['delete'])) {
		$link_id=$_GET['delete'];
		echo "<b>Deleting Link number $link_id...</b><br />";
		$query="DELETE FROM links WHERE id='$link_id' LIMIT 1";
		$result=mysql_query($query);
		echo "Link deleted successfully";
	} elseif ($action == "new") {
		echo "<form action=\"index.php?module=admin&admin=links&action=newcreate\" method=\"POST\">";
		echo "<table>";
		echo "<tr>";
		echo "<td>Link Name:</td> <td><input type=\"text\" name=\"link_name\" size=70 /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Link Description:</td> <td><input type=\"text\" name=\"link_description\" size=70 /></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>Link Target:</td> <td><input type=\"text\" name=\"link_target\" size=70 /></td>";
		echo "</tr>";
		echo "<tr><td><input type=\"submit\" value=\"Create\" name=\"submit\" /></td><td><input type=\"reset\" value=\"Reset\" name=\"reset\" /></td></tr>";
		echo "</table>";
		echo "</form>";
	} elseif ($action == "newcreate") {
		echo "<b>Creating link...</b><br />";
		$link_name=$_POST['link_name'];
		$link_description=$_POST['link_description'];
		$link_target=$_POST['link_target'];
		$query="INSERT INTO links VALUES('','$link_name','$link_description','$link_target')";
		$result=mysql_query($query);
		echo "Link created successfully";
	} else {
		echo "<a href=\"index.php?module=admin&admin=links&action=new\">New Link</a>";
		echo "<table>";
		echo "<tr>";
		echo "<td><b>Link ID:</b></td><td><b>Link Title:</b></td><td><b>Link Description:</b></td><td><b>Link URL:</b></td><td><b>Actions:</b></td>";
		echo "</tr>";
		
		$query="SELECT * FROM links";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		
		$i=0;
		while ($i < $num) {
			$link_id=mysql_result($result,$i,"id");
			$link_name=mysql_result($result,$i,"link_name");
			$link_description=mysql_result($result,$i,"link_description");
			$link_target=mysql_result($result,$i,"link_location");
			echo "<tr>";
			echo "<td>$link_id</td><td>$link_name</td><td>$link_description</td><td>$link_target</td><td><a href=\"index.php?module=admin&admin=links&action=edit&edit=$link_id\">Edit</a> <a href=\"index.php?module=admin&admin=links&action=delete&delete=$link_id\">Delete</a></td>";
			echo "</tr>";
			$i++;
		}
		
		echo "</table>";
	}
}
?>