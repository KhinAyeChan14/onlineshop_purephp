<?php
	require 'dbConnect.php';

	$code=$_POST['code'];
	$name=$_POST['name'];

	$photo=$_FILES['photo'];
	// upload file
	$basepath='../images/items/';
	$fullpath=$basepath.$photo['name'];
	move_uploaded_file($photo['tmp_name'], $fullpath);

	// var_dump($fullpath);

	$unitprice=$_POST['unitprice'];
	$discount=$_POST['discount'];
	$description=$_POST['description'];

	
	$subcategoryid=$_POST['subcategoryid'];
	$brandid=$_POST['brandid'];

	$sql="INSERT INTO items(codeno,name,photo,price,discount,description,brand_id,subcategory_id) VALUES (:value1,:value2,:value3,:value4,:value5,:value6,:value7,:value8)";

	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$code);
	$stmt->bindParam(':value2',$name);
	$stmt->bindParam(':value3',$fullpath);
	$stmt->bindParam(':value4',$unitprice);
	$stmt->bindParam(':value5',$discount);
	$stmt->bindParam(':value6',$description);
	$stmt->bindParam(':value7',$brandid);
	$stmt->bindParam(':value8',$subcategoryid);

	$stmt->execute();



	header('location:item_list.php');
	?>