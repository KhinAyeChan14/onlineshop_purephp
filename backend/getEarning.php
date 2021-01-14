<?php
	require 'dbConnect.php';

	// January

	$janFirst=strtotime('first day of January');
	$janLast=strtotime('last day of January');
	$janStart=date('Y-m-d',$janFirst);
	$janEnd=date('Y-m-d',$janLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$janStart);
	$stmt->bindParam(':value2',$janEnd);
	$stmt->execute();
	$janResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($janResult);


	// februrary
	$febFirst=strtotime('first day of february');
	$febLast=strtotime('last day of february');
	$febStart=date('Y-m-d',$febFirst);
	$febEnd=date('Y-m-d',$febLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$febStart);
	$stmt->bindParam(':value2',$febEnd);
	$stmt->execute();
	$febResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($febResult);


	// March
	$marFirst=strtotime('first day of March');
	$marLast=strtotime('last day of March');
	$marStart=date('Y-m-d',$marFirst);
	$marEnd=date('Y-m-d',$marLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$marStart);
	$stmt->bindParam(':value2',$marEnd);
	$stmt->execute();
	$marResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($marResult);


	// April
	$aprFirst=strtotime('first day of April');
	$aprLast=strtotime('last day of April');
	$aprStart=date('Y-m-d',$aprFirst);
	$aprEnd=date('Y-m-d',$aprLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$aprStart);
	$stmt->bindParam(':value2',$aprEnd);
	$stmt->execute();
	$aprResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($aprResult);

	// May
	$mayFirst=strtotime('first day of May');
	$mayLast=strtotime('last day of May');
	$mayStart=date('Y-m-d',$mayFirst);
	$mayEnd=date('Y-m-d',$mayLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$mayStart);
	$stmt->bindParam(':value2',$mayEnd);
	$stmt->execute();
	$mayResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($mayResult);


	// June
	$junFirst=strtotime('first day of June');
	$junLast=strtotime('last day of June');
	$junStart=date('Y-m-d',$junFirst);
	$junEnd=date('Y-m-d',$junLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$junStart);
	$stmt->bindParam(':value2',$junEnd);
	$stmt->execute();
	$junResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($junResult);

	// July
	$julyFirst=strtotime('first day of julyruary');
	$julyLast=strtotime('last day of julyruary');
	$julyStart=date('Y-m-d',$julyFirst);
	$julyEnd=date('Y-m-d',$julyLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$julyStart);
	$stmt->bindParam(':value2',$julyEnd);
	$stmt->execute();
	$julyResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($julyResult);


	// August
	$augFirst=strtotime('first day of August');
	$augLast=strtotime('last day of August');
	$augStart=date('Y-m-d',$augFirst);
	$augEnd=date('Y-m-d',$augLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$augStart);
	$stmt->bindParam(':value2',$augEnd);
	$stmt->execute();
	$augResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($augResult);


	// September
	$sepFirst=strtotime('first day of September');
	$sepLast=strtotime('last day of September');
	$sepStart=date('Y-m-d',$sepFirst);
	$sepEnd=date('Y-m-d',$sepLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$sepStart);
	$stmt->bindParam(':value2',$sepEnd);
	$stmt->execute();
	$sepResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($sepResult);


	// October
	$octFirst=strtotime('first day of October');
	$octLast=strtotime('last day of October');
	$octStart=date('Y-m-d',$octFirst);
	$octEnd=date('Y-m-d',$octLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$octStart);
	$stmt->bindParam(':value2',$octEnd);
	$stmt->execute();
	$octResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($octResult);

	// November
	$novFirst=strtotime('first day of November');
	$novLast=strtotime('last day of November');
	$novStart=date('Y-m-d',$novFirst);
	$novEnd=date('Y-m-d',$novLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$novStart);
	$stmt->bindParam(':value2',$novEnd);
	$stmt->execute();
	$novResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($novResult);


	// December
	$decFirst=strtotime('first day of Decembar');
	$decLast=strtotime('last day of December');
	$decStart=date('Y-m-d',$decFirst);
	$decEnd=date('Y-m-d',$decLast);
	$sql="SELECT COALESCE(SUM(total),0) AS total
			FROM orders WHERE orderdate BETWEEN :value1 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$decStart);
	$stmt->bindParam(':value2',$decEnd);
	$stmt->execute();
	$decResult=$stmt->fetch(PDO::FETCH_ASSOC);
	// var_dump($decResult);


	$total=array($janResult['total'],$febResult['total'],$marResult['total'],$aprResult['total'],$mayResult['total'],$junResult['total'],$julyResult['total'],$augResult['total'],$sepResult['total'],$octResult['total'],$novResult['total'],$decResult['total']);

	echo json_encode($total);

?>

