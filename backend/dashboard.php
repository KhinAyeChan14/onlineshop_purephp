<?php
	require 'backendheader.php';
	require 'dbConnect.php';

	date_default_timezone_set("Asia/Rangoon");
	$todaydate=date('Y-m-d');

	// Order
	$sql="SELECT count(id) as orderTotal FROM orders WHERE orderdate=:value1";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value1',$todaydate);
	$stmt->execute();
	$orderCount=$stmt->fetch(PDO::FETCH_ASSOC);

	// Customers
	$roleid=2;
	$sql="SELECT count(users.id) as customerTotal FROM users 
		INNER JOIN model_has_roles
		ON users.id=model_has_roles.user_id
		WHERE model_has_roles.role_id=:value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value2',$roleid);
	$stmt->execute();
	$customerCount=$stmt->fetch(PDO::FETCH_ASSOC);

	// Brands
	$sql="SELECT count(id) as brandTotal FROM brands";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$brandCount=$stmt->fetch(PDO::FETCH_ASSOC);

	// Items
	$sql="SELECT count(id) as itemTotal FROM items";
	$stmt=$conn->prepare($sql);
	$stmt->execute();
	$itemCount=$stmt->fetch(PDO::FETCH_ASSOC);


?>
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
          <p>A free and open source Bootstrap 4 admin template</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="widget-small primary coloured-icon"><i class="icon icofont-prestashop"></i>
            <div class="info">
              <h4>Today Order</h4>
              <p><b><?= $orderCount['orderTotal']?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class="icon icofont-ui-user-group"></i>
            <div class="info">
              <h4>Customers</h4>
              <p><b><?= $customerCount['customerTotal']?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small warning coloured-icon"><i class="icon icofont-badge"></i>
            <div class="info">
              <h4>Brands</h4>
              <p><b><?= $brandCount['brandTotal']?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon icofont-box"></i>
            <div class="info">
              <h4>Items</h4>
              <p><b><?= $itemCount['itemTotal']?></b></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Monthly Sales</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
            </div>
          </div>
        </div>
        <!-- <div class="col-md-4">
          <div class="tile">
            <h3 class="tile-title">Support Requests</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
            </div>
          </div>
        </div> -->
      </div>
    </main>


<?php
	require 'backendfooter.php';
?>

<script type="text/javascript" src="js/plugins/chart.js"></script>
    <script type="text/javascript">
     	
      $.ajax({
      	method:"POST",
      	url:"getEarning.php",
      	success:function(response){
      		var earningResult=JSON.parse(response);
      		var data = {
      			labels: ["January", "February", "March", "April", "May","June","July","Auguest","September","October","November","December"],
      			datasets: [
      			{
      				label: "My First dataset",
      				fillColor: "rgba(220,220,220,0.2)",
      				strokeColor: "rgba(220,220,220,1)",
      				pointColor: "rgba(220,220,220,1)",
      				pointStrokeColor: "#fff",
      				pointHighlightFill: "#fff",
      				pointHighlightStroke: "rgba(220,220,220,1)",
      				data: [earningResult[0], earningResult[1], earningResult[2], earningResult[3], earningResult[4],earningResult[5],earningResult[6],earningResult[7],earningResult[8],earningResult[9],earningResult[10],earningResult[11]]
      		}
      	]
      };
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
}
});
    </script>