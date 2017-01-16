<?php require_once 'includes/head.php'; ?>
	<link rel="stylesheet" type="text/css" href="/styles/columns2.css" />
	<link rel="stylesheet" type="text/css" href="/styles/paging.css" />

	<title>Australia Down Under</title>
	<script type="text/javascript" src="/includes/lb.js"></script>
	<script type="text/javascript">
		window.onload=function() {
			new lb('light','light','fade',true,false);
		}
	</script>
</head>
<body>
<div id="body">
	<?php require_once 'includes/banner.php'; ?>
	<h2>Manage Images<?php print @$_SESSION['userDetails']; ?></h2>

	<div id="main">
		<?php require_once 'includes/navigation.php'; ?>
		<div id="content">
			<div id="contenttext">
			<form method="post" action="editimage.php" id="editblog">
				<p><input type="hidden" name="page" value="[page]" /></p>
				<table>
					<tr><th>ID</th><th>&nbsp;</th><th>Title</th><th>&nbsp;</th><th>&nbsp;</th></tr>
					<p>[images]</p>
				</table>
			</form>
			<p>[Paging]</p>
			<form method="post" action="editimage.php">
				<p><button type="submit" name="add">Add New Image</button></p>
			</form>
			</div>
		</div>
	</div>
	<?php require_once 'includes/footer.php'; ?>
</div>
</body>
</html>
