<?php
// FireBlog Links Module - Adds a set of Links to the navigation bar
// Published under the GNU GPL

function links() {
	echo '<h4>Links</h4>';
	$query="SELECT * FROM links";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	
	$i=0;
	while ($i < $num) {
		$link_name=mysql_result($result,$i,"link_name");
		$link_description=mysql_result($result,$i,"link_description");
		$link_target=mysql_result($result,$i,"link_location");
		
		?>
		<a href="<?php echo $link_target; ?>" title="<?php echo $link_description; ?>"><?php echo $link_name; ?></a><br />
		<?php
		$i++;
	}
}
?>