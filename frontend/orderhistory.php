<?php
	require 'php/frontendheader.php';

	require 'php/dbConnect.php';

	$userid=$_SESSION['login_user']['id'];
	$sql='SELECT * FROM orders WHERE user_id=:value1 ORDER BY orderdate DESC';
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$userid);
	$stmt->execute();
	$orders=$stmt->fetchAll();

?>


<!-- Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Your Order History </h1>
  		</div>
	</div>

	<div class="container">
		<div class="row">
			<?php
				foreach($orders as $order){

					$id=$order['id'];
					$orderdate=$order['orderdate'];
					$voucherno=$order['voucherno'];
					$total=$order['total'];
					$note=$order['note'];
					$status=$order['status'];


					$sql='SELECT * FROM item_order WHERE order_id=:value2';
					$stmt=$conn->prepare($sql);
					$stmt->bindParam(':value2',$id);
					$stmt->execute();
					$itemorders=$stmt->fetch(PDO::FETCH_ASSOC);
					
					// foreach($itemorders as $itemorder){

					$itemid=$itemorders['item_id'];
					$sql='SELECT * FROM items WHERE id=:value3';
					$stmt=$conn->prepare($sql);
					$stmt->bindParam(':value3',$itemid);
					$stmt->execute();
					$items=$stmt->fetch(PDO::FETCH_ASSOC);

					$item_name=$items['name'];
					$item_photo=$items['photo'];
					$item_discount=$items['discount'];
					$item_price=$items['price'];
					if($item_discount==""){
						$price=$item_price;
					}
					else{
						$price=$item_discount;
					}

			?>

			<div class="col-lg-4 col-md-6 col-sm-12 col-12 p-4">
				<div class="card">
				  	<div class="card-body">
				    	<h5 class="card-title"><?= $voucherno ?></h5>
				    	<h6 class="card-subtitle mb-2 text-muted"><?= $orderdate?></h6>

				    	<p class="text-white card-text float-right">
				    		<?php if($status=="Order"){
				    			?>
				    			<span class="badge rounded-pill bg-warning"><?= $status?></span>

				    		<?php }else if($status=="Delete"){
				    			?>
				    			<span class="badge rounded-pill bg-danger"><?= $status?></span>

				    		<?php }else{
				    			?>
				    			<span class="badge rounded-pill bg-success"><?= $status?></span>
				    			<?php 
				    		}
				    		?>

				    	</p>
				    	
				    		<button type="button" class="btn btn-ouline-white btn-sm" data-toggle="modal" data-target="#myModal<?=$id?>">Detail</button>

				    		<!-- Modal -->
				    		<div class="modal fade" id="myModal<?=$id?>" role="dialog">
				    			<div class="modal-dialog">

				    				<!-- Modal content-->
				    				<div class="modal-content">
				    					<!-- <div class="modal-header">
				    						<button type="button" class="close" data-dismiss="modal">&times;</button>
				    						<h4 class="modal-title">Modal Header</h4>
				    					</div> -->
				    					<div class="modal-body">
				    						<p>This item has been <?=$status ?>.</p>
				    						<center><img src="<?= $item_photo ?>" class="img-fluid"></center>
				    						<p><?php echo $item_name ?></p><span><?php echo $price.'Ks' ?></span>
				    					</div>
				    					<div class="modal-footer">
				    						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				    					</div>
				    				</div>

	    						</div>
				    		</div> 
				  	</div>
				</div>
			</div>
			
		<?php } ?>

	</div>



<?php
	require 'php/frontendfooter.php';
?>