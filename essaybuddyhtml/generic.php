﻿<?php
	$errMessage = '';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_POST['Submit'])) {
			$target_file = 'uploads/myfile'; //. basename($_FILES["file"]["name"]);
			$FileType = strtolower(pathinfo(basename($_FILES["file"]["name"]),PATHINFO_EXTENSION));
			if($FileType != "rtf" && $FileType != "txt" && $FileType != "docx" ) {
					$errMessage = "Sorry, only rtf, txt and docx files are allowed.";
			 }
			 else
			 {
				if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file . '.' . $FileType)) {
					header('Location: editor.php?ext='. $FileType);
				} else {
					$errMessage = "Sorry, there was an error uploading your file.";
				}
			 }
		}
	}
?>

<!DOCTYPE HTML>
<!--
	Stellar by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>
			Editor
		</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<h1>Editor</h1>
						<p>Upload a File to Get Started</p>
					</header>

				<!-- Main -->
				<style>
					
					.inputfile + label {
    				font-size: 1.25em;
    				font-weight: 700;
    				color: white;
    				background-color: black;
    				display: inline-block;
					cursor: pointer;
					}

					.inputfile:focus + label,
					.inputfile + label:hover {
    				background-color: red;
					outline: 1px dotted #000;
					outline: -webkit-focus-ring-color auto 5px;
					}
					
					.box {
						height: auto;
						width: 200px;
						height: 80px;
						margin: auto;
					}
					
					.formtype {
						border-radius: 8px;
						border: solid;
						margin-bottom: 2em;
						padding: 1.5em;
						width: auto;
  						border: 2px solid white;
  						padding: 50px;
  						margin: auto;
					}
				</style>
				<div class="formtype" align="center">
				   <div style="color:red"><?php echo $errMessage; ?></div>
					<form action="generic.php" method="post" enctype="multipart/form-data">
						<div class="block">
    						<label class="align-left">Email</label>
    						<input type="email" id="email" name="email" value="Enter Your Email Address" required/>
						</div>
						<br>
						<div class="block">
    						<label class="align-left">Your Writing Level</label>
    						<select id="hear" name="hear" required>
								<option value = "1">Pick and Option</option>
								<option value = "1">Beginner</option>
								<option value = "2">Intermediate</option>
								<option value = "3">Advanced</option>
							</select>
						</div>
						<div class="block">
    						<label class="align-left">How did you hear about us?</label>
    						<select id="hear" name="hear" required>
								<option value = "0">Pick an Option</option>
								<option value = "1">Search Engine</option>
								<option value = "2">Social Media</option>
								<option value = "3">Ads</option>
								<option value = "4">Youtube</option>
								<option value = "5">Flyer</option>
							</select>
						</div>
						<br>
						<div class="align-left" align="center">
							<label for="file">Choose a File</label>
							<input type="file" name="file" id="file" class="inputfile" required/>
						</div>
						<br>
						<div class="block">
    						<input type="submit" name="Submit" value="Start">
						</div>
					</form>
				</div>

				<!-- Footer -->
					<footer id="footer">
						<section>
							<h2>Contact Us</h2>
							<p>We would love to recieve feedback so that we can improve our service and are here to help with any questions and concerns.&nbsp; &nbsp;&nbsp;</p>
							<ul class="actions">
								<li><a href="rate.html" class="button">Contact Us</a></li>
							</ul>
						</section>
						<section>
							<h2>Information</h2>
							<dl class="alt">
								<dt>Address</dt>
								<dd>555 Post St &bull; San Francisco &bull; CA 94102</dd>
								<dt>Phone</dt>
								<dd>(000) 000 &bull; 0000</dd>
								<dt>Email</dt>
								<dd><a href="rohanpatra2003@gmail.com">info@essaybuddy.net</a></dd>
							</dl>
							<ul class="icons">
								<li><a href="#" class="icon brands fa-twitter alt"><span class="label">Twitter</span></a></li>
								<li><a href="#" class="icon brands fa-facebook-f alt"><span class="label">Facebook</span></a></li>
								<li><a href="#" class="icon brands fa-instagram alt"><span class="label">Instagram</span></a></li>
								<li><a href="#" class="icon brands fa-github alt"><span class="label">GitHub</span></a></li>
								<li><a href="#" class="icon brands fa-dribbble alt"><span class="label">Dribbble</span></a></li>
							</ul>
						</section>
						<p class="copyright">&copy; 2019-2022 All Rights Reserved. Essay Buddy Inc. </p>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>