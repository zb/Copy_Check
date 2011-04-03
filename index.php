<html>

<head>
	
	<title>Form Submission</title>
	
</head>

<body>
	
	<form id = "checkForm" name = "checkForm" method = "post" action = "check.php">
		
		<label><h3>Check Text</h3></label>
		
	
		
		
		<textarea rows="30" cols="50" name = "textInput">Paste here.</textarea><br />
		
		
	<input type = "submit" name = "checkSubmit" id = "checkSubmit" value = "submit">
	</form>
	
	<label><h3>Check File</h3></label>
	<form enctype="multipart/form-data" action="check.php" method="POST">
 	 Please choose a file: <input name="uploadedfile" type="file" /><br />
    <input type="submit" name = "uploadSubmit" value="Upload" />
    </form>
	
	
	
</body>

</html>