<?php session_start();

if(array_key_exists('action',$_POST)) {
	if($_POST['action'] == 'create_folder') {
		//$folder = new Box_Client_Folder();
		//$folder->attr('name', $_POST['folder_name']);
		//$folder->attr('parent_id', 0);
		//$folder->attr('share', false);
		//echo $box_net->create($folder);
	}
	else if($_POST['action'] == 'upload_file') {
		//$file = new Box_Client_File($_FILES['file']['tmp_name'], $_FILES['file']['name']);
		//$file->attr('folder_id', 0);
		//echo $box_net->upload($file)."check";
		echo $_FILES['file']['name'];
		$tmpfile = "\\tmp\\".$_FILES['file']['name'];
	}
}

?>
<html>
	<head>
		<title>Upload Test</title>
	</head>
	<body>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<input type="hidden" name="action" value="create_folder">
		<label>Folder name: </label><input type="text" name="folder_name"> <button type="submit">Create</button>
	</form>
	<hr>
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="upload_file">
		<label>Select File: </label><input type="file" name="file"> 
		<button type="submit">Upload</button>
	</form>
	</body>
</html>