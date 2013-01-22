<?php


if (isset($_FILES['image'])) {
	$errors = array();
	$allowed_ext = array('jpg', 'jpeg', 'png', 'gif');	
	$file_name = $_FILES['image']['name'];
	$file_ext = strtolower(end(explode('.', $file_name)));
	$file_size = $_FILES['image']['size'];
	$file_tmp = $_FILES['image']['tmp_name'];
	
	if (in_array($file_ext, $allowed_ext) === false){
		$errors[] = 'Extension not allowed';
	}
	
	if ($file_size > 1097152) {
		$errors[] = 'File must be 2MB';
	}
	
	if (empty($errors)) {
		//upload here
		
		$host = "localhost";
		$user = "root";
		$pass = "";
		$db = "basicsite";
		
		mysql_connect("$host", "$user", "$pass")or die("Connot connect");
		mysql_select_db("$db")or die("connot select db");
		
		$name = $_POST['text'];
		$img = $file_name;
		mysql_query("INSERT INTO tbl_uploadfiles 
		(name, img) VALUES('$name', '$img' ) ") 
		or die(mysql_error());  
		
		echo "Success";
		
	} else {
		foreach($errors as $error){
			echo $error, '<br />';
		}
	}
		
}




?>


<form method="post" action="" enctype="multipart/form-data">
	<input type="text" name="text" /><br />
	<input type="file" name="image" /><br />
	<input type="submit" value="Upload" />
</form>