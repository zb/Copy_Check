This is check.php, sans Bing API_KEY.

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
	
	define("API_KEY", "");
	
	
	error_reporting(E_ALL);
	ini_set('display_errors','On');
	
	
	if(isset($_POST['checkSubmit'])){ 

	$toBeChecked = $_POST['textInput'];
	
	checkString($toBeChecked);

}
	
	
?>


<p><a name="footnote">* segment is skipped if it contains fewer than <?php echo MIN_WORDS; ?> words.</a></p>
</body>
</html>