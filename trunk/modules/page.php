<?php
// FireBlog 0.2 Page module - Published under the GNU GPL
// See the file COPYING

function page($theme) {
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		$query="SELECT * FROM pages WHERE id_string = '$page'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		
		if ($num == 0) {
			echo '<div class="entry">No such page!</div>';
		} else {
			$id=mysql_result($result,0,"id");
			$title=mysql_result($result,0,"title");
			$page=mysql_result($result,0,"page");
			echo '<div class="entry"><h3>';
			echo $title;
			echo '</h3><p>';
			echo $page;
			echo '</div>';
		}
	} else {
		echo '<div class="entry">You must specify a page!</div>';
	}
}
?>