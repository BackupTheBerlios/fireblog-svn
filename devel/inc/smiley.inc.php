<?php
// FireBlog 1.0 SmileyParser
// Copyright (C) Alex Smith 2005

function parseSmilies($string) {
	
	// Here you can add more smiley definitions if you want
	$smilies=array(":)",":D",":P",":(",";)",":lol:",":roll:",":evil:",":twisted:",":o","8)",":shock:",":?",":x",":oops:",":cry:");
	$replace=array("<img src=\"images/smilies/icon_smile.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_biggrin.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_razz.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_sad.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_wink.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_lol.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_rolleyes.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_evil.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_twisted.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_surprised.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_cool.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_eek.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_confused.gif alt=\"smile\" />","<img src=\"images/smilies/icon_mad.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_redface.gif\" alt=\"smile\" />","<img src=\"images/smilies/icon_cry.gif\" alt=\"smile\" />");
	$newstring = str_replace($smilies, $replace, $string);
	return $newstring;
	
}
?>