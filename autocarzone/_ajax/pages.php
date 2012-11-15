<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$pages = array(); 
echo '<div id="eachPages">';
if(isset($_GET)) {
	$pages = $p->getPages(); $i = 0;
	foreach($pages as $page) {
		echo '<button name="home" id="eachPage'.$i.'" onclick="editePage(this.id, this.className)" class="'.$page->id.'">';
		echo '<p class="center">';
		echo $page->title;
		echo '</p>';
		echo '<p class="otherText">';
		echo '<span id="'.$page->id.$page->title.'" class="grayText">Page type: ' . $p->getPageType($page->type) . '</span>';
		if($page->modified == 0) {  
			echo '<span id="'.$page->title.'" class="redText">';
			echo 'Never edited';
			echo '</span>';
		} else {
			echo '<span class="greenText">';
			echo 'Already edited';
			echo '</span>';
		}
		echo '</p>';
		echo '</button>';
		$i++;
	}
}
echo '</div>';
?>