<?php
	require 'dbConnect.php';
	$id = $_POST['id'];
	$cid = $_POST['categoryid'];
	$name = $_POST['name'];

	$sql = "UPDATE subcategories SET name=:value1,category_id=:value2,updated_at=CURRENT_TIMESTAMP  WHERE id=:value3";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$name);
	$stmt->bindParam(':value2',$cid);
	$stmt->bindParam(':value3',$id);
	$stmt->execute();

	header('location: subcategory_list.php');
?>