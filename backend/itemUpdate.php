<?php
	require 'dbConnect.php';

	$code = $_POST['code'];
	$id = $_POST['id'];
	$name = $_POST['name'];
	$price=$_POST['price'];
	$discount=$_POST['discount'];
	$description=$_POST['description'];
	$brandid=$_POST['brandid'];
	$subcategoryid=$_POST['subcategoryid'];

	$oldphoto = $_POST['oldphoto'];
	$photo = $_FILES['photo'];

	if ($photo['size']>0) {
			// upload file
		$basepath='../images/items/';
		$fullpath=$basepath.$photo['name'];
		move_uploaded_file($photo['tmp_name'], $fullpath);
	} else {
		$fullpath= $oldphoto;
	}

	$sql = "UPDATE items SET codeno=:value1,name=:value2,photo=:value3,price=:value4,discount=:value5,description=:value6,brand_id=:value7,subcategory_id=:value8,updated_at=CURRENT_TIMESTAMP WHERE id=:value9";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$code);
	$stmt->bindParam(':value2',$name);
	$stmt->bindParam(':value3',$fullpath);
	$stmt->bindParam(':value4',$price);
	$stmt->bindParam(':value5',$discount);
	$stmt->bindParam(':value6',$description);
	$stmt->bindParam(':value7',$brandid);
	$stmt->bindParam(':value8',$subcategoryid);
	$stmt->bindParam(':value9',$id);

	$stmt->execute();

	header('location: item_list.php');
?>