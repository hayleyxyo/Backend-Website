<?php
	define('DB','australia');
	define('USER','ozadmin');
	define('PASSWORD','Test@123');

	$dsn=sprintf('mysql:dbname=%s;host=localhost',DB);

	try {
		$pdo=new PDO($dsn,USER,PASSWORD);
	}
	catch(PDOError $e) {
		die('Cannot connect to database');
	}
	$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$pdo->exec('SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE;');
	$pdo->exec('SET SESSION sql_mode = \'ANSI\';');

	function pdoParms($string,$data) {
		$indexed=$data==array_values($data);
		foreach($data as $k=>$v) {
			if(is_string($v)) $v="'$v'";
			elseif($v===null) $v='NULL';
			if($indexed) $string=preg_replace('/\?/',$v,$string,1);
			else $string=str_replace(":$k",$v,$string);
		}
		return $string;
	}
