<?php
	require_once 'includes/db.php';
	$limit=3;

	function pager($current,$total) {
		$pager=array();
		$pager[]=	$current==1 		? '<span>&laquo;</span>' 		: '<a href="?page=1">&laquo;</a>';
		$pager[]=	$current==1 		? '<span>&lsaquo;</span>'		: '<a href="?page='.($current-1).'">&lsaquo;</a>';
		$pager[]=	$current==$total	? '<span>&rsaquo;</span>'		: '<a href="?page='.($current+1).'">&rsaquo;</a>';
		$pager[]=	$current==$total	? '<span>&raquo;</span>'		: '<a href="?page='.$total.'">&raquo;</a>';
		$pager=implode('',$pager);
		$pager="<p>Page $current of $total</p><p id=\"paging\">$pager</p>";
		return $pager;
	}

	$sql='SELECT count (*) FROM animals';
	$pages=ceil($pdo->query($sql)->fetchcolumn()/$limit); //ceil=round up

	$page=intval(@$_GET['page']) or $page=$_COOKIE['page']  or $page=1; //page=sth, @=ignore if missing
	// if($page<1) $page=1; can be replaced by next line
	$page=max(1,$page);

	//if($page>$pages) $page=$pages; 一下replace这里
	$page=min($page,$pages);



	setcookie('page',$page,time()+7*24*3600);



	$offset=($page-1)*$limit;

	$sql="SELECT id,title,src FROM animals LIMIT $limit OFFSET $offset";

	//$results=$pdo->query($sql);
	$images=array();
	$img='<img src="/images/thumbnail/%s" alt="%s" width="160" height="120">';
	foreach($pdo->query($sql) as $row) {
		$images[]=sprintf($img,$row['src'],$row['title']);
	}
	$images=implode('',$images);
?>
 <?php require_once 'includes/head.php'; ?>
	<link rel="stylesheet" type="text/css" href="/styles/columns2.css">
	<link rel="stylesheet" type="text/css" href="/styles/gallery.css">
	<link rel="stylesheet" type="text/css" href="/styles/paging.css">

	<title>Australia Down Under</title>
<style type="text/css">
</style>
</head>
<body>
<div id="body">
	<?php require_once 'includes/banner.php'; ?>
	<h2>Australian Fauna</h2>
	<div id="main">
		<?php require_once 'includes/nav.php'; ?>
		<div id="content">
			<div id="contenttext">
				<div id="thumbnails">
					<p><?php print $images ?></p>
					<?php print pager($page,$pages);  ?>

				</div>
				<div id="mainimage">
					<h3>[title]</h3>
					<p>[image]</p>
					<div class="caption">[description]></div>
				</div>
			</div>
		</div>
	</div>
	<?php require_once 'includes/footer.php'; ?>
</div>
</body>
</html>
