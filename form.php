<?php require_once 'includes/head.php'; ?>
	<link rel="stylesheet" type="text/css" href="/styles/styles.php?styles=columns2+forms" />
	<title>Australia Down Under</title>
</head>
<body>
<div id="body">
	<?php require_once 'includes/banner.php'; ?>
	<h2>Contact Us</h2>
	<div id="main">
		<?php require_once 'includes/navigation.php'; ?>
		<div id="content">
			<div id="contenttext">
			<form class="wide" method="post" action="">
				<p><label>Name<br/>
						<input type="text" name="name" value=""/></label></p>
				<p><label>Email Address<br/>
						<input type="text" name="email" value=""/></label></p>
				<p><button name="ok" type="submit">Do it</button></p>
			</form>
			</div>
		</div>
	</div>
	<?php require_once 'includes/footer.php'; ?>
</div>
</body>
</html>
