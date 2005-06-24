<?php
// FireBlog 0.2 Recent posts module - puts a list of recent posts in the navigation bar
// Published under the GNU GPL

function recent() {
	echo '<h4>Recent posts</h4>';
	
	$query="SELECT * FROM news ORDER BY id DESC LIMIT 5";
	$result=mysql_query($query);
	
	$num=mysql_numrows($result);
	if ($num == 0) {
		echo 'No posts in database';
	} else {
		$i=0;
		while ($i < $num) {
			
			$id=mysql_result($result,$i,"id");
			$title=mysql_result($result,$i,"title");
		
		?>
		<a href="index.php?module=news&article=<?php echo $id ?>"><?php echo $title ?></a><br />
		<?php
			$i++;
		}
	}
}
?>
