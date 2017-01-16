	<?php
		require_once 'includes/db.php';
		require_once 'includes/class.thumbnails.php';

		$title=$description='';
		$errors='';

		define('IMAGE_LIMIT',2000000); //const IMAGE_LIMIT=2000000

		function addImage($name,$title,$description) {
			global $pdo;
			//add to database
			$sql='INSERT INTO animals(name,src,title,description) VALUES(?,?,?,?)';
			$prepare=$pdo->prepare($sql);
			$data=array($name,$name,$title,$description);
			$prepare->execute($data);

			//read id
			$id=$pdo->lastInsertId();

			//Naming
			$title=strtolower($title); //lower case the name
			$title=str_ireplace(' ', '-', $title); //replace all space with "-",in title
			$ext=strrchr($name,'.'); //str = string, r= reverse, chr=charater, this means get the thing from the name staring with last "."
			$src=sprintf('%06d-%s%s', $id, $title,$ext); //sprint=save, printf=print to string,f means format, sprintf = return a formatted string
			//6 digis with 0 inside, the first %s is title, the second %s is $ext

			$sql='UPDATE animals SET src=? WHERE id=?'; //change src for this id
			$prepare=$pdo->prepare($sql);
			$data=array($src,$id,);
			$prepare->execute($data); // execute = run


			//rename file
			//$name=$FILES['image']['name']; this part will be remove once the naming has done
			//mayby modify name
			rename("images/original/$name","images/original/$src");

			// scale

			$source="images/original/$src";

			$options=array('width'=>320,'height'=>240);
			$destination="images/preview/$src";
			makeThumbnail($source,$destination,$options);

			$options=array('width'=>160,'height'=>120);
			$destination="images/thumbnail/$src";
			makeThumbnail($source,$destination,$options);

			$options=array('width'=>40,'height'=>30);
			$destination="images/minithumb/$src";
			makeThumbnail($source,$destination,$options);
		}

		if(isset($_POST['import'])) {
			$csv=file('assets/animals.csv'); //read file into array of lines
			array_shift($csv); //remove the first row
			foreach ($csv as $line) {   //...,...,... at the first row
				list($name,$title,$description)=str_getcsv($line); //split line as csv; copy into variables
				copy("assets/animals/$name","images/original/$name");
				addImage($name,$title,$description);
			}
		}

		if(isset($_POST['insert'])) { //from form?
			//get data
			$title=trim($_POST['title']);
			$description=trim($_POST['description']);

			//errors
			$errors=array(); //start a new array, this means when array is

			//Image
			switch($_FILES['image']['error']) {
				case 0: //no error
					$types=array('image/gif','image/jpeg','image/pjpeg','image/png','imgae/x-png');
					if(!in_array($_FILES['image']['type'], $types)) $error[]='Wrong Type';
					//if $FILES['image']['type'] not inside $types
					elseif($_FILES['image']['size']>IMAGE_LIMIT) $error[]='File too big';
					break;
				case 1:  // too big for the individual file set
				case 2: // too big for the max file set
						$error[]='File too big';
					break;
				case 4: //Missing
						$error[]='Missing File';
					break;
				default: //all other errors
						$error[]='Problems with upload';
			}

			//keep
			if(!$errors) {
				//prepare Variables
				$name==$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],"images/original/$name");

				addImage($name,$title,$description);

			}

		}
	 ?>

<?php require_once 'includes/head.php'; ?>
	<link rel="stylesheet" type="text/css" href="/styles/columns2.css">
	<link rel="stylesheet" type="text/css" href="/styles/forms.css">
	<title>Australia Down Under</title>
</head>
<body>
<div id="body">
	<?php require_once 'includes/banner.php'; ?>
	<h2>Edit Image Details<?php print @$_SESSION['userDetails']; ?></h2>
	<div id="main">
		<?php require_once 'includes/nav.php'; ?>
		<div id="content">
			<div id="contenttext">
			<form method="post" action="" class="wide" enctype="multipart/form-data">
				<p><input type="hidden" name="page" value="[page]"></p>
				<p><input type="hidden" name="id" value="0"></p>
				<!-- if(id not 0) print image else -->
				<p><label>File<br><input name="image" type="file"></label></p>
				<!-- endif -->


				<p><label>Title<br>
					<input type="text" name="title" value="[title]"></label></p>
				<p><label>Description<br>
					<textarea name="description" cols="60" rows="6">[description]</textarea></label></p>
				<p><!--
					[if edit]
						<button type="submit" name="update">Submit</button>
					[elseif remove]
						<button type="submit" name="delete">Delete Image</button>
					[else]-->
						<button type="submit" name="insert">Add Image</button>
						<button type="submit" name="import">Import</button>
					<!--[endif]-->
			</form>
			<form method="post" action="admin.php" class="adjacent">
				<p><button type="submit" name="cancel">Cancel</button></p>
			</form>
			</div>
		</div>
	</div>
	<?php require_once 'includes/footer.php'; ?>
</div>
</body>
</html>
