<?php
	require 'dbConnect.php';

	$id=$_POST['id'];
	// var_dump($id);
	$sql="DELETE FROM categories WHERE id=:value1";

	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$id);
	$stmt->execute();

	header('location:category_list.php');
?>