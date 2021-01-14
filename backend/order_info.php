<?php
	require 'backendheader.php';
	require 'dbConnect.php';

	$orderid=$_GET['id'];
	$voucherno=$_GET['voucherno'];
	$userid=$_GET['userid'];

	date_default_timezone_set("Asia/Rangoon");
	$todaydate=date('Y-m-d');

	$sql="SELECT * FROM users where id=:value";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value',$userid);
	$stmt->execute();
	$users=$stmt->fetch(PDO::FETCH_ASSOC);
	$name = $users['name'];
	$phone = $users['phone'];
	$address = $users['address'];
	$email = $users['email'];

	$sql="SELECT * FROM item_order where order_id=:value";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value',$orderid);
	$stmt->execute();
	$itemorders=$stmt->fetchAll(); 
	
	
?>

 <main class="app-content">

      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>A Printable Invoice Format</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fas fa-house-user"></i></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
        </ul>
      </div>


      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> RGO-47</h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right">Date: <?= $todaydate?></h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">From
                  <address><strong>rgo47- Ecommerce Service</strong><br>1/A, Pyay Road, 5.5 Mile<br>Yangon<br>Myanmar<br>Email: rgo47@gmail.com</address>
                </div>

                <div class="col-4">To
                  	<address><strong><?=$name?></strong><br>Address: <?=$address?><br>Phone: <?=$phone?><br>Email: <?=$email?></address>
                </div>

                <div class="col-4"><b>Invoice <?=$voucherno?></b><br><br><b>Order ID:</b> <?=$orderid?><br><b><!-- Payment Due:</b> 2/22/2014<br><b>Account:</b> 968-34567 --></div>
              	</div>


              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Qty</th>
                        <th>Product</th>
                        <th>Serial #</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>

                    	<?php


                    		foreach($itemorders as $itemorder){
                    		
                    		$qty=$itemorder['qty'];
                    		$itemid=$itemorder['item_id'];

                    		$sql="SELECT * FROM items where id=:value";
                    		$stmt=$conn->prepare($sql);
                    		$stmt->bindParam(':value',$itemid);
                    		$stmt->execute();
                    		$items=$stmt->fetch(PDO::FETCH_ASSOC);

                    		$codeno = $items['codeno'];
                    		$name = $items['name'];
                    		$item_price = $items['price'];
                    		$item_discount = $items['discount'];
                    		$description = $items['description'];
                    		if($item_discount==""){
                    			$price=$items['price'];
                    		}
                    		else{
                    			$price=$items['discount'];
                    		}
           
                    
                    	?>

                      <tr>
                        <td><?=$qty?></td>
                        <td><?=$name?></td>
                        <td><?=$codeno?></td>
                        <td><?=$description?></td>
                        <td><?=$price?></td>
                      </tr>
                       <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </main>
 



<?php
	require 'backendfooter.php';
?>