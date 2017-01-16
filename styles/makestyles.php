<?php
	function makeCSS($original,$destination,$data=array()) {
		$original=file_get_contents($original);
		$original=preg_replace('/\/\*.*?\*\//s','',$original);
		$original=eval("return<<<END\n$original\nEND;\n");
		file_put_contents($destination,$original);
	}

	//	Commaon

	$data=array(
		'photoPadding'=>16,
		'contentPadding'=>12,
		'navigationWidth'=>160,
		'height'=>400,
	);

	//	Two Columns

	$data['mainPaddingRight']	=	$data['photoWidth']+2*$data['photoPadding']+8;
	makeCSS('columns2template.css','columns2.css',$data);


	//	Three Columns

	$data['photoWidth']=$data['photoPadding']=0;
	$data['photoWidthAdjusted']	=	$data['photoWidth']-2*$data['contentPadding'];
	$data['mainPaddingRight']	=	$data['photoWidth']+2*$data['photoPadding']+8;
	$data['photoMarginRight']	=	$data['photoWidth']+2*$data['contentPadding']+2*$data['photoPadding'];

	makeCSS('columns2template.css','columns2.css',$data);
?>