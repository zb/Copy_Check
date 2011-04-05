<html>
<head>
<style type="text/css">
.green {background-color: green;}
.red {background-color: red;}
.yellow {background-color: yellow;}
</style>
</head>
<body>
<?php

	include 'checkFunction.php';

	define ("MIN_WORDS", 10);	

	define ("MAX_WORDS", 22);

	define("API_KEY", "EA99040534216D7ACB9402357F9F65FA592BD780");


	error_reporting(E_ALL);
	ini_set('display_errors','On');


	if(isset($_POST['checkSubmit'])){ 

	$toBeChecked = $_POST['textInput'];

	checkString($toBeChecked);

	echo('<p><a name="footnote">* segment is skipped if it contains fewer than ' . MIN_WORDS . ' words.</a></p>
	</body>
	</html>');

	}




?>