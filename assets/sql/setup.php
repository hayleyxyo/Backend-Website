<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

	if(isset($_POST['setup'])) {
		$script=key(@$_POST['setup']).'.sql';

		if($script) {
			define('USER','root');
			define('PASSWORD','');
			$dsn='mysql:host=localhost';

			try {
				$pdo = new PDO($dsn,USER,PASSWORD);
			} catch(PDOException $e) {
				die ($e->getMessage());		//	Exit, displaying the error message
			}
			$pdo->exec('SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE;');
			$pdo->exec('SET SESSION sql_mode = \'ANSI\';');
			$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$script=file_get_contents($script);
			$pdo->exec($script);
		}
	}
?>
<?php
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Australia Down Under: Setup</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />

	<link rel="stylesheet" type="text/css" href="../styles/forms.css" />
	<link rel="stylesheet" type="text/css" href="../styles/columns2.css" />
	<link rel="stylesheet" type="text/css" href="../styles/styles.css" />

	<script type="text/javascript" src="includes/javascript.js"></script>
	
	<style type="text/css">
		ol#setup {
			list-style-type: none;
			padding: 0px;
			margin: 8px 0px;
			color: #4A2A15;
		}
		ol#setup li {
			border: 0px;
			border-bottom: 2px solid white;
			width: 16em;
		}
		ol#setup li ul {
			list-style-type: none;
			padding: 0px;
			margin: 0px;
		}
		ol#setup li {
			font-weight: bold;
		}
		ol#setup li ul li{
			border: none;
		}
		ol#setup button {
			width: 16em;
			font-weight: bold;
			text-align: left;
			background-color: transparent;
			border: 0px;
			color: #A43E16;
			border-left: 2px solid white;
		}
		ol#setup button:hover {
			color: white;
			background-color: #A43E16;
		}
	</style>
</head>
<body>
<div id="body">
	<div id="banner"><h1>Australia</h1></div>
	<div id="main">
		<?php require_once('../includes/navigation.php'); ?>
		<div id="content">
			<form method="post" action="">
			<ol id="setup">
				<li>Database
					<ul><li><button type="submit" name="setup[australia]">Create Database</button></li></ul>
				</li>
				<li>Users
					<ul><li><button type="submit" name="setup[users]">Create Users</button></li>
						<li><button type="submit" name="setup[userdetails]">Create Users View</button></li>
					</ul>
				</li>
				<li>Images
					<ul><li><button type="submit" name="setup[imagescreate]">Create Images Table</button></li>
						<li><button type="submit" name="setup[imagesimport]">Import Images</button></li>
					</ul>
				</li>
				<li>Animals
					<ul><li><button type="submit" name="setup[animalsscreate]">Create Animals Table</button></li>
						<li><button type="submit" name="setup[aminalsimport]">Import Animals</button></li>
					</ul>
				</li>
				<li>Blog
					<ul><li><button type="submit" name="setup[blogcreate]">Create Blog Table</button></li>
						<li><button type="submit" name="setup[blogimport]">Import Blog</button></li>
					</ul>
				</li>
			</ol>
			</form>
		</div>
		<!--div id="photo"><p>hohoho</p></div-->
	</div>
	<div id="footer">Copyright &copy; 101 Courseware</div>
</div>
</body>