<?php
require('rtf2text.php');
require('docx2text.php');

$ext = $_REQUEST['ext'];
$filename = 'uploads/myfile.' . $ext;
$text = '';

if($ext=='rtf')
{
	$text = rtf2text($filename);
}
else if($ext == 'docx')
{
	$text = read_file_docx($filename);
}
else
{
	$text = file_get_contents($filename);
}

unlink($filename)

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
			Editor - Essay Buddy
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
						<h1>Essay Buddy Editor</h1>
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
				<div class="formtype" align="left">
					<div id="heading" contenteditable="true" style="font-size: 18"><strong>Enter a Title (Optional)</strong></div>
					<br>
 					<div id="content" contenteditable="true">
						<?php
							echo $text;
						?>
					 </div>
					<script src="textedit.js"></script>
				</div>
				<br><br>
				<div class="formtype" align="left">
					<div id="heading" contenteditable="false" ><strong>Results</strong></div>
					<br>
 					<div id="content" contenteditable="false">
						<?php
							$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.prepostseo.com/apis/checkPlag');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "key=6a05359452e8188d961019463416e467&data=$text");

$headers = array();
$headers[] = array('Content-Type: application/json', 'Accept: application/json');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
						$json_a = json_decode($result);
						echo "Percentage Plagiarised: ";
						echo $json_a->plagPercent;
						echo "%";
						echo '<br>';
						echo "Percentage Unique: ";
						echo $json_a->uniquePercent;
						echo "%";
						echo '<br>';						
						echo '<br><br>';
						$sources = $json_a->sources;
						echo "Plagiarized Sources:";
						echo '<br><br>';
						foreach($sources as $element)
						{
							$citelink = str_replace(":", "%3A", $element->link);
							$citelink = str_replace("/", "%2F", $element->link);
							$citelink = "http://www.citationmachine.net/mla7/cite-a-website/search?utf8=%E2%9C%93&q=" . $citelink;
							echo "<a href='$element->link' target='_blank'>$element->link</a>";
							echo "        ";
							echo '<br>';
							echo "<a href='$citelink' target='_blank'>Cite This Source</a>";
							echo '<br><br>';
							echo "Percentage Plagarised From This Source: ";
							echo $element->percent;
							echo "%";
							echo '<br><br>';
						}
						echo '<br><br>';
						echo "Detailed Breakdown: ";
						echo '<br>';
						$details = $json_a->details;
						foreach($details as $element)
						{
							echo "Sentence: ";
							echo '<br>';
							echo $element->query;
							echo ".";
							echo '<br>';
							echo "Sentence Unique: ";
							echo $element->unique;
							echo '<br>';
							echo "Plagiarized From: ";
							echo '<br>';
							echo $element->display->url;
							echo '<br>';
							echo "Excerpt From Source: ";
							echo '<br>';
							echo $element->display->des;
							echo '<br><br>';
						}
						

curl_close($ch);

						?>
					 </div>
					<script src="textedit.js"></script>
				</div>
				<br><br>
				<li><a href="rate.html" class="button">Rate Essay Buddy</a></li>

				<!-- Footer -->
					<footer id="footer">
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