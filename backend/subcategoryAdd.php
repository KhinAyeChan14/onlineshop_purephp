<?php
	require 'dbConnect.php';

	$name=$_POST['name'];
	// var_dump($name);
	
	$categoryid=$_POST['categoryid'];
	// var_dump($categoryid);
	$sql="INSERT INTO subcategories(name,category_id) VALUES (:value1,:value2)";

	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$name);
	$stmt->bindParam(':value2',$categoryid);
	$stmt->execute();

	header('location: subcategory_list.php');
	?>