<?php
// FireBlog smiley parser - Parse smilies from a given string.
// See the file COPYING

function parseSmiley($string) {
	// Here you can add more smiley definitions if you want
	$smilies=array(":)",":D",":P",":(",";)",":lol:",":roll:",":/",":evil:",":twisted:",":o","8)",":shock:",":?",":x",":oops:",":cry:");
	$replace=array("<img src=\"images/smilies/icon_smile.gif\" />","<img src=\"images/smilies/icon_biggrin.gif\" />","<img src=\"images/smilies/icon_razz.gif\" />","<img src=\"images/smilies/icon_sad.gif\" />","<img src=\"images/smilies/icon_wink.gif\" />","<img src=\"images/smilies/icon_lol.gif\" />","<img src=\"images/smilies/icon_rolleyes.gif\" />","<img src=\"images/smilies/icon_neutral.gif\" />","<img src=\"images/smilies/icon_evil.gif\" />","<img src=\"images/smilies/icon_twisted.gif\" />","<img src=\"images/smilies/icon_surprised.gif\" />","<img src=\"images/smilies/icon_cool.gif\" />","<img src=\"images/smilies/icon_eek.gif\" />","<img src=\"images/smilies/icon_confused.gif","<img src=\"images/smilies/icon_mad.gif\" />","<img src=\"images/smilies/icon_redface.gif\" />","<img src=\"images/smilies/icon_cry.gif\" />");
	//$newstring = str_replace($smilies, "<img src=\"images/smilies/$replace\" />", $string);
	$newstring = str_replace($smilies, $replace, $string);
	return $newstring;
}
?>