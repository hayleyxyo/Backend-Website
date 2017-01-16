<?php
	$name=$email=$subject=$message='';
	$errors='';
	$thnakyou=false;

	if(isset($_POST['send'])) { //from form?
		//get data
		$name=trim($_POST['name']);
		$email=trim($_POST['email']);
		$subject=trim($_POST['subject']);
		$message=trim($_POST['message']);

		//errors
		$errors=array(); //start a new array, this means when array is

		if(!$name) $errors[]='Missing Name';   //$array[] = push ,, pushing Missing name to the array.
	  // or if (empty(name)) $errors[]='Missing Name';
	  	elseif(preg_match('/\r|\n/',$name)) $errors[]='Invalid Name';

	  	if(!$email) $errors[]='Missing Email Address';
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[]='Invalid Email Address';

		if(!$subject) $errors[]='Missing Subject';
		elseif(preg_match('/\r|\n/',$subject)) $errors[]='Invalid Subject';

		// send message or report errors
		if(!$errors) {

			$to='hayleyxyo.zhang@gmail.com';
			$to='mark@comparity.net';
			$from="$name<$email>"; // hayley zhang <hayleyzhang@gmail.com>
			$headers="From: $from\r\nCc: $from";
			//send the message
			mail($to,$subject,$message,$headers);
			$thankyou=true;
		}
		else $errors=implode('<br>',$errors);
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
	<h2>Contact Us</h2>
	<div id="main">
		<?php require_once 'includes/nav.php'; ?>
		<div id="content">
			<div id="contenttext">

<?php if(!$thankyou): ?>
			<form class="wide" id="feedback" method="post" action="">
				<p class="error"><?php print $errors; ?></p>
				<p><label for="name">Name:</label><br>
					<input name="name" id="name" type="text" value="<?php print $name; ?>">
				</p>
				<p><label for="email">Email:</label><br>
					<input name="email" id="email" type="text" value="<?php print $email; ?>">
				</p>
				<p><label for="subject">Subject:</label><br>
					<input name="subject" id="subject" type="text" value="<?php print $subject; ?>">
				</p>
				<p><label for="message">Message:</label>
					<textarea name="message" id="message"><?php print $message; ?></textarea>
				<p><button type="submit" name="send">Send Message</button></p>
			</form>
<?php else: ?>
				<p>Thank You $ Bye Bye</p>
<?php endif; ?>
			</div>
		</div>
	</div>
	<?php require_once 'includes/footer.php'; ?>
</div>
</body>
</html>
