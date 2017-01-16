<?php require_once 'includes/head.php'; ?>
	<link rel="stylesheet" type="text/css" href="/styles/columns2.css" />
	<link rel="stylesheet" type="text/css" href="/styles/forms.css" />
	<title>Australia Down Under</title>
	<script type="text/javascript" src="/includes/tinymce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
			mode : "exact",
			elements : "article",
			theme : "advanced",
			//	theme_advanced_buttons1 : "bold,italic,hr,|,bullist,numlist,|,cut,copy,paste,|,undo,redo,formatselect,removeformat,|,charmap,code,|,help",
			theme_advanced_buttons1 : "bold,italic,removeformat,hr,|,cut,copy,paste,|,undo,redo,|,formatselect,|,charmap,code,|,help",
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_blockformats : "p,h3,dt,dd",
			plugins : "inlinepopups"
		});
	</script>
</head>
<body>
<div id="body">
	<?php require_once 'includes/banner.php'; ?>
	<h2>Edit Blog Article<?php print @$_SESSION['userDetails']; ?></h2>
	<div id="main">
		<?php require_once 'includes/navigation.php'; ?>
		<div id="content">
			<div id="contenttext">
			<form method="post" action="" class="wide">
				<p><input type="hidden" name="id" value="[id]" /></p>
				<p><label>Title<br/>
					<input type="text" name="title" value="[title]"/></label></p>
				<p><label>Precis<br/>
					<textarea name="precis" cols="60" rows="2">[precis]</textarea></label></p>
				<p><label>Article<br/>
					<textarea id="article" name="article" cols="60" rows="8">[article]</textarea></label></p>
				<p><!-- if edit -->
					<button type="submit" name="update">Submit Changes</button>
				<!-- elseif remove -->
					<button type="submit" name="delete">Delete this Article</button>
				<!-- else -->
					<button type="submit" name="insert">Add Article</button>
				<!-- endif -->
				</p>
			</form>
			<form action="bloglist.php" class="adjacent">
				<p><button type="submit" name="cancel">Cancel</button></p>
			</form>
			</div>
		</div>
	</div>
	<?php require_once 'includes/footer.php'; ?>
</div>
</body>
</html>
