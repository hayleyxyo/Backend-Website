<?php require_once 'includes/head.php'; ?>
	<link rel="stylesheet" type="text/css" href="/styles/columns2.css" />
	<link rel="stylesheet" type="text/css" href="/styles/forms.css" />
	<title>Australia Down Under: Administration</title>
</head>
<body>
<div id="body">
	<?php require_once 'includes/banner.php'; ?>
	<h2>Administration [User Name]</h2>
	<div id="main">
		<?php require_once 'includes/navigation.php'; ?>
		<div id="content">
			<div id="contenttext">
			<!-- if not logged in -->
				<form method="post" action="" class="wide">
					<p>[Error Message]</p>
					<p><label>Email Address:<br/><input type="text" name="email" /></label></p>
					<p><label>Password:<br/>
						<input type="password" name="passwd" id="passwd" /></label><br/>
						<label><input type="checkbox" id="plainpasswd" /> Plain Text</label></p>
					<p><button type="submit" name="login">Login</button></p>
				</form>
			<!-- else -->
				<!-- the firs link can be removed later -->
				<p><a href="uploadimage.php">Upload Images</a><br/>
					<a href="imagelist.php">Manage Images</a></p>
				<p><a href="bloglist.php">Manage Blog</a></p>
				<form method="post" action="">
					<button type="submit" name="logout">Logout</button>
				</form>
			<!-- endif -->
			</div>
		</div>
	</div>
	<?php require_once 'includes/footer.php'; ?>
</div>
</body>
</html>
