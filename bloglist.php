<?php require_once 'includes/head.php'; ?>
	<link rel="stylesheet" type="text/css" href="/styles/columns2.css" />
	<link rel="stylesheet" type="text/css" href="/styles/blog.css" />

	<title>Australia Down Under</title>
</head>
<body>
<div id="body">
	<?php require_once 'includes/banner.php'; ?>
	<h2>Manage Blog Articles<?php print @$_SESSION['userDetails']; ?></h2>

	<div id="main">
		<?php require_once 'includes/navigation.php'; ?>
		<div id="content">
			<div id="contenttext">
			<form method="post" action="editblog.php" id="editblog">
				<p><input type="hidden" name="page" value="" /></p>
				<table>
					<tr><th>Created</th><th>Updated</th><th>Title</th><th>&nbsp;</th><th>&nbsp;</th></tr>
					<tr><td colspane="5">[articles]</td></tr>
				</table>
			</form>
			<p id="paging">[Paging]</p>
			<form method="post" action="editblog.php">
				<p><button type="submit" name="add">Add New Blog Article</button></p>
			</form>
			</div>
		</div>
	</div>
	<?php require_once 'includes/footer.php'; ?>
</div>
</body>
</html>
