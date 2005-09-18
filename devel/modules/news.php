<?php
// FireBlog 1.0 news module
// Copyright (C) Alex Smith 2005

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
		$details=mysql_result($result,$i,"details");
		$article=mysql_result($result,$i,"short_article");
		$extended_article=mysql_result($result,$i,"extended_article");
	
		?>
		<h1><a href="index.php?module=news&article=<?php echo $id ?>" class="h1"><?php echo $title ?></a></h1>
		<span class="posttime"><?php echo $details; ?></span><br />
		<?php echo $article; ?><br />
		<?php
		if ($extended_article <> "") {
			?>
			<br /><a href="index.php?module=news&article=<?php echo $id ?>">Read More ></a>
			<?php
		}
		?>
		<hr>
		<span class="rightalign">Why should there be comments?</span><br />
		</div>
		<?php
		$i++;
	}
}
?>