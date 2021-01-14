<?php
require 'backendheader.php';
require 'dbConnect.php';

date_default_timezone_set("Asia/Rangoon");
$todaydate=date('Y-m-d');

$orderStatus="Order";
$confirmStatus="Confirm";
$deleteStatus="Delete";

$sql="SELECT * FROM orders WHERE orderdate=:value1 AND status= 
:value2
ORDER BY id DESC";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':value1',$todaydate);
$stmt->bindParam(':value2',$orderStatus);
$stmt->execute();
$pending_orders=$stmt->fetchAll();

$sql="SELECT * FROM orders WHERE orderdate=:value1 AND status= 
:value2
ORDER BY id DESC";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':value1',$todaydate);
$stmt->bindParam(':value2',$confirmStatus);
$stmt->execute();
$confirm_orders=$stmt->fetchAll();

$sql="SELECT * FROM orders WHERE orderdate=:value1 AND status= 
:value2
ORDER BY id DESC";
$stmt=$conn->prepare($sql);
$stmt->bindParam(':value1',$todaydate);
$stmt->bindParam(':value2',$deleteStatus);
$stmt->execute();
$cancel_orders=$stmt->fetchAll();

?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1> <i class="icofont-list"></i>Orders</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <a href="category_new.php" class="btn btn-outline-primary">
                <i class="icofont-plus"></i>
            </a>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Search Order History</h3>
                <div class="tile-body">
                <form class="row">
                    <div class="form-group col-md-5">
                      <label class="control-label">Start Date</label>
                      <input class="form-control" type="date" id="startDate">
                    </div>
                    <div class="form-group col-md-5">
                      <label class="control-label">End Date</label>
                      <input class="form-control" type="date" id="endDate">
                    </div>
                    <div class="form-group col-md-2 align-self-end">
                      <button class="btn btn-primary searchBtn" type="button">Search</button>
                    </div>
                </form>
            </div>
    </div>


      <div class="tile" id="todayorderlistDiv">
        <div class="tile-body">
            <h3 class="tile-title">Today Order List</h3>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-link active" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="true">Order-pending</a>
                    <a class="nav-link" id="nav-confirm-tab" data-toggle="tab" href="#nav-confirm" role="tab" aria-controls="nav-confirm" aria-selected="false">Order-Confirm</a>
                    <a class="nav-link" id="nav-cancel-tab" data-toggle="tab" href="#nav-cancel" role="tab" aria-controls="nav-cancel" aria-selected="false">Order-Cancel</a>
                    <a class="nav-link" id="nav-cancel-tab" data-toggle="tab" href="#nav-cancel" role="tab" aria-controls="nav-cancel" aria-selected="false">Order-P</a>
                </div>
            </nav>

            <div class="tab-content my-3" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Voucherno</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                foreach($pending_orders as $pending_order){
                                    $pending_id=$pending_order['id'];
                                    $pending_voucherno=$pending_order['voucherno'];
                                    $pending_total=$pending_order['total'];
                                    $pending_userid=$pending_order['user_id'];
                                    ?>
                                    <tr>
                                        <td> <?= $i++; ?></td>
                                        <td> <?= $pending_voucherno;?></td>
                                        <td> <?= $pending_total;?></td>
                                        <td>
                                            <a href="order_info.php?id=<?= $pending_id ?>&voucherno=<?= $pending_voucherno ?>&userid=<?= $pending_userid ?>" class="btn btn-outline-success">
                                                <i class="icofont-info"></i>
                                            </a> 
                                            <a href="orderStatus_change.php?id=<?= $pending_id ?>&status=0" class="btn btn-outline-success">
                                                <i class="icofont-ui-check"></i>
                                            </a> 
                                            <a href="orderStatus_change.php?id=<?= $pending_id ?>&status=1" class="btn btn-outline-danger">
                                                <i class="icofont-close"></i>
                                            </a>  
                                        </td>  
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-confirm" role="tabpanel" aria-labelledby="nav-confirm-tab">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered display">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Voucherno</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=1;
                                foreach($confirm_orders as $confirm_order){
                                    $confirm_id=$confirm_order['id'];
                                    $confirm_voucherno=$confirm_order['voucherno'];
                                    $confirm_total=$confirm_order['total'];
                                    $confirm_userid=$confirm_order['user_id'];
                                    ?>
                                    <tr>
                                        <td> <?= $i++; ?></td>
                                        <td> <?= $confirm_voucherno;?></td>
                                        <td> <?= $confirm_total;?></td>
                                        <td>
                                            <a href="order_info.php?id=<?= $confirm_id ?>&voucherno=<?= $confirm_voucherno ?>&userid=<?= $confirm_userid ?>" class="btn btn-outline-success">
                                                <i class="icofont-info"></i>
                                            </a> 
                                            <a href="orderStatus_change.php?id=<?= $confirm_id ?>&status=1" class="btn btn-outline-danger">
                                                <i class="icofont-close"></i>
                                            </a> 
                                        </td>  
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="nav-cancel" role="tabpanel" aria-labelledby="nav-cancel-tab">
                 <div class="table-responsive">
                    <table class="table table-hover table-bordered display">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Voucherno</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=1;
                            foreach($cancel_orders as $cancel_order){
                                $cancel_id=$cancel_order['id'];
                                $cancel_voucherno=$cancel_order['voucherno'];
                                $cancel_total=$cancel_order['total'];
                                $cancel_userid=$cancel_order['user_id'];
                                ?>
                                <tr>
                                    <td> <?= $i++; ?></td>
                                    <td> <?= $cancel_voucherno;?></td>
                                    <td> <?= $cancel_total;?></td>
                                    <td>
                                        <a href="order_info.php?id=<?= $cancel_id ?>&voucherno=<?= $cancel_voucherno ?>&userid=<?= $cancel_userid ?>" class="btn btn-outline-success">
                                            <i class="icofont-info"></i>
                                        </a> 
                                    </td>  
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


    </div>
</div>
</div>
</div> 







</main>



<?php
require 'backendfooter.php'
?>