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

	echo('<p><a name="footnote">* segment is skipped if it contains fewer than <?php echo MIN_WORDS; ?> words.</a></p>
	</body>
	</html>');

	}

	if(isset($_POST['uploadSubmit'])){ 

	//$toBeChecked = $_POST['textInput'];	

	// Where the file is going to be placed 
	$target_path = "files/";

	/* Add the original filename to our target path.  
	Result is "uploads/filename.extension" */
	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	    echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
	    " has been uploaded";
	} else{
	    echo "There was an error uploading the file, please try again!";
	}

	}


?>