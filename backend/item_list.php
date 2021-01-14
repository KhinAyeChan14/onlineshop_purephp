 <?php
require 'backendheader.php';
require 'dbConnect.php';

$sql="SELECT items.*,subcategories.id as sid,subcategories.name as sname,brands.id as bid,brands.name as bname 
FROM items
LEFT JOIN subcategories
ON items.subcategory_id = subcategories.id
LEFT JOIN brands
ON items.brand_id=brands.id

ORDER BY id DESC";

$stmt=$conn->prepare($sql);
$stmt->execute();

$items=$stmt->fetchAll();
?>

<main class="app-content">
    <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Items </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="item_new.php" class="btn btn-outline-primary">
                        <i class="icofont-plus"></i>
                    </a>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                          <th>#</th>       
                                          <th>Code Number</th>
                                          <th>Name</th>
                                          <th>Price</th>
                                          <th>Discount</th>
                                          <th>Brand Name</th>
                                          <th>Subcategory</th>
                                          <th>Description</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $i=1;
                                            foreach ($items as $item){

                                                $id=$item['id'];
                                                $codeno=$item['codeno'];
                                                $photo=$item['photo'];
                                                $name=$item['name'];     
                                                $price=$item['price'];
                                                $discount=$item['discount'];
                                                $brand=$item['bname'];
                                                $subcategory=$item['sname'];
                                                $description=$item['description'];
                                        ?>
                                            
                                        <tr>
                                            <td> <?= $i++; ?></td>
                                            <td> <?= $codeno; ?></td>
                                            <td> <img src="<?= $photo ?>" width="70" height="70">
                                                <p><?= $name; ?></p></td>
                                            <td> <?= $price; ?></td>
                                            <td> <?= $discount; ?></td>
                                            <td><?= $brand; ?></td>
                                            <td> <?= $subcategory; ?></td>
                                            <td> <?= $description; ?></td>


                                            <td class="center">
                                                <a href="item_edit.php?id=<?= $id ?>" class="btn btn-warning mr-3">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>


                                                <form action="itemDelete.php" onsubmit="return confirm('Are you sure want to delete?')" method="POST" class="d-inline-block">
                                                    <input type="hidden" name="id" value="<?= $id ?>">
                                                    <button class="btn btn-outline-danger">
                                                        <i class="icofont-close"></i>
                                                    </button>
                                                </form>

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
        </main>



<?php
require 'backendfooter.php'
?>