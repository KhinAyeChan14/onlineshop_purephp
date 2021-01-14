 <?php
require 'backendheader.php';
require 'dbConnect.php';

$sql="SELECT subcategories.*,categories.id as cid,categories.name as cname 
FROM subcategories 
LEFT JOIN categories
ON subcategories.category_id = categories.id
ORDER BY id DESC";

$stmt=$conn->prepare($sql);
$stmt->execute();

$subcategories=$stmt->fetchAll();
?>

<main class="app-content">
    <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Sub-category </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="subcategory_new.php" class="btn btn-outline-primary">
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
                                          <th>Name</th>
                                          <th>Category</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            $i=1;
                                            foreach ($subcategories as $subcategory){

                                                $id=$subcategory['id'];
                                                $name=$subcategory['name'];
                                                $cid=$subcategory['category_id'];
                                                $cname=$subcategory['cname'];
                                        ?>
                                            
                                        <tr>
                                            <td> <?= $i++; ?></td>
                                            <td> <?= $name; ?></td>
                                            <td> <?= $cname; ?></td>

                                            <td>
                                                 <a href="subcategory_edit.php?id=<?= $id ?>" class="btn btn-warning mr-3">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>   

                                                <form action="subcategoryDelete.php" onsubmit="return confirm('Are you sure want to delete?')" method="POST" class="d-inline-block">
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