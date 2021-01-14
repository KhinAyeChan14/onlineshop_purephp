<?php
	require 'dbConnect.php';
	$id = $_POST['id'];
	$name = $_POST['name'];
	$oldphoto = $_POST['oldphoto'];
	$photo = $_FILES['photo'];

	if ($photo['size']>0) {
			// upload file
		$basepath='../images/brands/';
		$fullpath=$basepath.$photo['name'];
		move_uploaded_file($photo['tmp_name'], $fullpath);
	} else {
		$fullpath= $oldphoto;
	}

	$sql = "UPDATE categories SET name=:value1, logo=:value2,updated_at=CURRENT_TIMESTAMP WHERE id=:value3";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$name);
	$stmt->bindParam(':value2',$fullpath);
	$stmt->bindParam(':value3',$id);
	$stmt->execute();

	header('location: category_list.php');
?>