<?php
// FireBlog 0.2 News script - Published under the GNU GPL
// See the file COPYING

function news($theme) {
	include("modules/getcomments.php");
	if (isset($_GET["article"])) {
		$article_id=$_GET["article"];
		$query="SELECT * FROM news WHERE id = '$article_id'";
		$result=mysql_query($query);
		$num=mysql_numrows($result);
		
		if ($num == 0) {
			echo '<div class="entry">No such article!</div>';
		} else {
			$id=mysql_result($result,0,"id");
			$title=mysql_result($result,0,"title");
			$details=mysql_result($result,0,"details");
			$article=mysql_result($result,0,"short_article");
			$extended_article=mysql_result($result,0,"extended_article");
				
			?>
			<div class="entry">
			<h1><a href="index.php?module=news&article=<?php echo $id ?>" class="h1"><?php echo $title ?></a></h1>
			<?php echo $article; ?><br />
			<?php
			if ($extended_article <> "") {
				echo "<br />$extended_article";
			}
			?>
			<hr>
			<span class="posttime"><?php echo $details; ?></span><br />
			<?php include("modules/comments.php"); comments($id, $title) ?>
			</div>
			<?php
		}
	} else {
		$query="SELECT * FROM news ORDER BY id DESC LIMIT 5";
		$result=mysql_query($query);
		
		$num=mysql_numrows($result);
		if ($num == 0) {
			echo '<div class="entry">No posts in database</div>';
		} else {
			$i=0;
			while ($i < $num) {
				
				$id=mysql_result($result,$i,"id");
				$title=mysql_result($result,$i,"title");
				$details=mysql_result($result,$i,"details");
				$article=mysql_result($result,$i,"short_article");
				$extended_article=mysql_result($result,$i,"extended_article");
			
				?>
				<div class="entry">
				<h1><a href="index.php?module=news&article=<?php echo $id ?>" class="h1"><?php echo $title ?></a></h1>
				<span class="posttime"><?php echo $details; ?></span><br />
				<?php echo $article; ?><br />
				<?php
				if ($extended_article <> "") {
					?>
					<br /><a href="index.php?module=news&article=<?php echo $id ?>">Read More >></a>
					<?php
				}
				?>
				<hr>
				<span class="rightalign"><?php getcomments($id) ?></span><br />
				</div>
				<?php
				$i++;
			}
		}
	}
}
?>