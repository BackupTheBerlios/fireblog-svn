<?php
// FireBlog 1.0 Navigation Bar class.
// Copyright (C) Alex Smith 2005

class NavBar {

	public $in_section = 0;
	
	function section_begin($header) {
		
		if ($this->in_section == 0) {
			
			echo '<b>' . $header . '</b><br /><br />';
			$this->in_section = 1;
			
		} else {
			
			echo '<b>Error!</b> Already in a navigation section. Please end the current section before creating a new one';
			die;
			
		}
		
	}
	
	function section_end() {
		
		if ($this->in_section == 1) {
			
			echo '<br />';
			$this->in_section = 0;
			
		} else {
			
			echo '<b>Error!</b> What is the point in calling section_end when you have not created a new section?';
			die;
			
		}
		
	}
	
	function create_link($label,$url,$desc) {
		
		if ($this->in_section == 1) {
			
			echo '<div class="navstart">> <a href="' . $url . '" title="' . $desc . '">' . $label . '</a></div>';
			
		} else {
			
			echo '<b>Error!</b> You can\'t create a link without making a section! Use section_begin to make a section first.';
			die;
			
		}
		
	}
	
	function create_homepage_link($label) {
		
		if ($this->in_section == 1) {
			
			echo '<div class="navstart">> <a href="index.php" title="Homepage">' . $label . '</a></div>';
			
		} else {
			
			echo '<b>Error!</b> You can\'t create a link without making a section! Use section_begin to make a section first.';
			die;
			
		}
		
	}
	
	function create_page_link($label,$page_id,$desc) {
		
		if ($this->in_section == 1) {
			
			echo '<div class="navstart">> <a href="index.php?module=page&page=' . $page_id . '" title="' . $desc . '">' . $label . '</a></div>';
			
		} else {
			
			echo '<b>Error!</b> You can\'t create a link without making a section! Use section_begin to make a section first.';
			die;
			
		}
		
	}
	
	function create_banner_link($img,$link,$desc) {
		
		if ($this->in_section == 1) {
			
			echo '<a href="' . $link . '" title="' . $desc . '"><img src="' . $img . '" /></a><br />';
			
		} else {
			
			echo '<b>Error!</b> You can\'t create a banner link without making a section! Use section_begin to make a section first.';
			die;
			
		}
		
	}
	
	function create_ad_block($ad_code) {
		
		if ($this->in_section == 1) {
			
			echo '<div align="center">' . $ad_code . '</div>';
			
		} else {
			
			echo '<b>Error!</b> You can\'t create an ad banner without making a section! Use section_begin to make a section first.';
			die;
			
		}
		
	}
	
	function create_module_link($label,$module,$desc) {
		
		if ($this->in_section == 1) {
			
			echo '<div class="navstart">> <a href="index.php?module=' . $module . '" title="' . $desc . '">' . $label . '</a></div>';
			
		} else {
			
			echo '<b>Error!</b> You can\'t create a link without making a section! Use section_begin to make a section first.';
			die;
			
		}
		
	}

}
?>