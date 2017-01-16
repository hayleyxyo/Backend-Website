<?php
	if(isset($_GET['styles'])) {
		$styles=explode(' ',$_GET['styles']);
		$css=array();
		foreach($styles as $style) {
			if(file_exists("$style.css")) {
				$css[]=file_get_contents("$style.css");
			}
		}
		$css=implode("\r\n",$css);
		header("Content-type: text/css");
		print $css;
	}
?>