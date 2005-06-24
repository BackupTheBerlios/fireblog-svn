<?php
// FireBlog News archive script
// See the file COPYING
function archive($theme) {
	echo "<div class=\"entry\"><table>";
	echo "<tr>";
	echo "<td><b>Article Title:</b></td><td><b>Article Details:</b></td>";
	echo "</tr>";
	
	$query="SELECT * FROM news ORDER BY id DESC";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	
	$i=0;
	while ($i < $num) {
		$news_id=mysql_result($result,$i,"id");
		$news_title=mysql_result($result,$i,"title");
		$news_details=mysql_result($result,$i,"details");
		echo "<tr>";
		echo "<td><a href=\"index.php?module=news&article=$news_id\">$news_title</a></td><td>$news_details</td><td>";
		echo "</tr>";
		$i++;
	}
	echo "</table></div>";
}
?>